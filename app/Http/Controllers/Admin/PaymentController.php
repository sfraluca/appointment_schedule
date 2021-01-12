<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use App\Models\Employee;
use App\Models\Employment;
use App\Models\WorkingHour;
use App\Models\WorkingDays;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Validator;
use Input;
use Redirect;
use Illuminate\Support\Arr;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;

class PaymentController extends Controller
{
   
    public function payment(Request $request)
    { 
        // abort_if(Gate::denies('payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
           
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
        // $employments_q = $employments->get();
        // dd($last_month_q);
        $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');
       
        // dd($employments);
        $report_lm = [];
        $totalTime_lm = 0;
        $salary = 0;
        if($request->has('employee')) {
            $currentEmployee = $request->get('employee');
           
            // dd($currentEmployment);
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
        // dd($report_lm);
        return view('admin.payment.payment', compact('report_lm','employees','currentEmployee','salary','month_hours'));
    }
    public function payment_post(Request $request) {
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

            $stripe = Stripe::make('sk_test_51HzJSZAaJ4UqVroF6LhwjQGKTvlcU36AX33YWkf7Tjz9fhc3wNtXOEgdSQLTZ7pumWVhtRhNUy8KgqlMubtk5RZl00M0dJjLfh');
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('exp_month'),
                        'exp_year' => $request->get('exp_year'),
                        'cvc' => $request->get('cvv_no'),
                    ],
                ]);
                if(!isset($token['id'])) {
                    return back()->with('error', 'The Stripe Token was not generated correctly.');
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency'=> 'RON',
                    'amount' => $request->get('amount'),
                    'description' => 'Pay by stripe',
                ]);
                    // dd($charge);
                if($charge['status'] == 'succeeded') {

                    return back()->with('success', 'Your payment proccess successfully done.');
                } else {
                    return back()->with('error', 'Your payment proccess not submited.');
                }
            } catch (Exception $e) {
                return back()->with('error', $e->getMessage());
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return back()->with('error', $e->getMessage());
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return back()->with('error', $e->getMessage());
            }
        }

        return back()->with('error', 'All files are required');

    }
    
}
