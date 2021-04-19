<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use App\Models\Employee;
use App\Models\Employment;
use App\Models\WorkingHour;
use App\Models\WorkingDays;
use App\Entities\RegisterSalary;
use App\Models\Salaries;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Validator;
use Input;
use Redirect;
use Illuminate\Support\Arr;
use App\Services\Stripe\Customer;
use Stripe\Error\Card;
use Stripe\Charge;
use Stripe\Transfer;
use Stripe\Stripe;
use DB;
use App\Models\User;
use App\Models\Payment;
class PaymentController extends Controller
{
    protected $salary;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RegisterSalary $salary)
    {
        $this->salary = $salary;
    }
    public function payment(Request $request)
    { 
        $last_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(),
                            Carbon::now()->endOfMonth()->subMonth(),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
        
        if ($request->has('employee')) {
            $last_month->where('employee_id', $request->employee);
            $employments = Employment::all()->where('employee_id', $request->employee);
            $working_days = WorkingDays::all()->where('employee_id', $request->employee); 
           
        }
        $last_month_q = $last_month->get();
        $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');
       
        $report_lm = [];
        $totalTime_lm = 0;
        $salary = 0;
        $month_hours = 0;
        $month_days = 0;

        if($request->has('employee')) {
            $currentEmployee = $request->get('employee');
        
               foreach($last_month_q as $item_lm) {
                $working_month = $working_days->where('month','=', $item_lm->month);
                
                
                $totalTime_lm = $totalTime_lm + intval($item_lm->hours);
                $totalHours_lm = gmdate("H", $totalTime_lm); 
                 
                $report_lm[$item_lm->month] = [
                    'hours'=> $totalTime_lm,
                ]; 
               
                foreach($employments as $employee_salary) {
                    
                     $salary = $totalTime_lm * $employee_salary->money;
                     $employments_hour = $employee_salary->hour;
                    
                }
                foreach($working_month as $days) {
                      $month_days = $days->days;
                      
                }
               
                $month_hours = $month_days * $employments_hour;
                
                if($totalTime_lm > $month_hours) {

                    $diff = $totalTime_lm - $month_hours;
                     
                    $bonus = $diff * ($salary*5/100);
                    
                    $salary = $salary + $bonus;
                   
                }
               
            }  
           
        
        } else {
            $currentEmployee = '';
            $month_hours = '';
        } 
     
       
        return view('admin.payment.payment', compact('report_lm','employees','currentEmployee','salary','month_hours'));
    }
    public function salary_save(Request $request)
    { 
        $request->validate([
            'employee_id' => 'required',
            'employee' => 'required',
            'month' => 'required',
            'hours' =>'required',
            'salary' =>'required'
            ]);
         
        $salary = $this->salary->registerSalary($request->all());

        return redirect()->route('admin.stripe_form');

    }

    public function stripe_form() 
    {
        $employees = Salaries::all()->last();
        
        return view('admin.payment.stripe', compact('employees'));
    }

    public function payment_post(Request $request) {
     
        $salary = Salaries::all()->last();
        $employee_account = DB::table('salaries')
        ->leftJoin('employees','salaries.employee_id','=','employees.id')
        ->where('employees.id','=', $salary->employee_id)
        ->orderBy('employees.id', 'asc')->first();
       
        $admin = DB::table('users')
        ->leftJoin('employees','users.employee_id','=','employees.id')
        ->first();
        $customer = User::all()->first();
       
        $payout = $salary->salary;
       
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvv_no' => 'required',
            'amount' => 'required',
        ]);
            
        $input = $request->all();

        if($validator->passes()) {
         
            $input = Arr::except($input, array('_token')); 
            Stripe::setApiKey('sk_test_51HzJSZAaJ4UqVroF6LhwjQGKTvlcU36AX33YWkf7Tjz9fhc3wNtXOEgdSQLTZ7pumWVhtRhNUy8KgqlMubtk5RZl00M0dJjLfh');
         
            $charge = Charge::create([
                'amount' => self::toStripeFormat($salary->salary),
                'currency'=> 'RON',
                'customer' => $admin->stripe_connect_id,
                'description' => 'Pay by stripe',
            ]);
            $transfer = Transfer::create([
                'amount' => self::toStripeFormat($payout),
                'currency' => 'ron',
                'source_transaction' => $charge->id,
                'destination' => 'acct_1I8lgtPEyLJQDTSC'
              ]);
                $payment = new Payment();
                $payment->customer_id = $customer->id;
                $payment->product = $salary->salary;
                $payment->stripe_charge_id = $charge->id;
                $payment->paid_out = $payout;
                $payment->fees_colected = $salary->salary - $payout;
                $payment->save(); 
            
 
        }

        return back()->with('success', 'Payment succeded');

    }
    public static function toStripeFormat(float $amount)
    {
        return $amount * 100;
    }
//     public function payment_post(Request $request) {
//         $validator = Validator::make($request->all(), [
//             'card_no' => 'required',
//             'exp_month' => 'required',
//             'exp_year' => 'required',
//             'cvv_no' => 'required',
//             'amount' => 'required',
//         ]);

//         $input = $request->all();
//         if($validator->passes()) {
//             $input = Arr::except($input, array('_token'));
//  ///Transaction::create($user, $product);
//             $stripe = Stripe::make('sk_test_51HzJSZAaJ4UqVroF6LhwjQGKTvlcU36AX33YWkf7Tjz9fhc3wNtXOEgdSQLTZ7pumWVhtRhNUy8KgqlMubtk5RZl00M0dJjLfh');
//             try {
//                 $token = $stripe->tokens()->create([
//                     'card' => [
//                         'number' => $request->get('card_no'),
//                         'exp_month' => $request->get('exp_month'),
//                         'exp_year' => $request->get('exp_year'),
//                         'cvc' => $request->get('cvv_no'),
//                     ],
//                 ]);
//                 if(!isset($token['id'])) {
//                     return back()->with('error', 'The Stripe Token was not generated correctly.');
//                 }
//                 $charge = $stripe->charges()->create([
//                     'card' => $token['id'],
//                     'currency'=> 'RON',
//                     'amount' => $request->get('amount'),
//                     'description' => 'Pay by stripe',
//                 ]);
//                 //Customer::save($user, $card);
//                     // dd($charge);
//                 if($charge['status'] == 'succeeded') {

//                     return back()->with('success', 'Your payment proccess successfully done.');
//                 } else {
//                     return back()->with('error', 'Your payment proccess not submited.');
//                 }
//             } catch (Exception $e) {
//                 return back()->with('error', $e->getMessage());
//             } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
//                 return back()->with('error', $e->getMessage());
//             } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
//                 return back()->with('error', $e->getMessage());
//             }
//         }

//         return back()->with('error', 'All files are required');

//     }
    
}
