<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkingHourRequest;
use App\Http\Requests\StoreWorkingHourRequest;
use App\Http\Requests\UpdateWorkingHourRequest;
use App\Models\Employee;
use App\Models\Project;
use App\Models\User;
use App\Models\WorkingHour;
use Illuminate\Support\Facades\DB;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WorkingHourController extends Controller
{



    public function raport(Request $request, Carbon $date)
    {
        abort_if(Gate::denies('working_hour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
            $current_year = WorkingHour::with('employee')
                    ->select(['id','employee_id',
                    \DB::raw("DATE_FORMAT(date,'%Y') as year"),
                    \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                    ->whereBetween('date', [
                                Carbon::now()->startOfYear(),
                                Carbon::now()->endOfYear(),
                            ])
                    ->groupBy('id') 
                    ->groupBy('hours') 
                    ->groupBy('employee_id')
                    ->groupBy('year')
                    ->orderBy('year','desc');
            $last_year = WorkingHour::with('employee')
                    ->select(['id','employee_id',
                    \DB::raw("DATE_FORMAT(date,'%Y') as year"),
                    \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                    ->whereBetween('date', [
                                Carbon::now()->startOfYear()->subYear(),
                                Carbon::now()->endOfYear()->subYear(),
                            ])
                    ->groupBy('id') 
                    ->groupBy('hours') 
                    ->groupBy('employee_id')
                    ->groupBy('year')
                    ->orderBy('year','desc');
        
            $current_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth(),
                            Carbon::now()->endOfMonth(),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');


            $last_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
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
                
            $last_2_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(2),
                            Carbon::now()->endOfMonth()->subMonth(2),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
            $last_3_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(3),
                            Carbon::now()->endOfMonth()->subMonth(3),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
            $last_4_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(4),
                            Carbon::now()->endOfMonth()->subMonth(4),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
            $last_5_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(5),
                            Carbon::now()->endOfMonth()->subMonth(5),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
            $last_6_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(6),
                            Carbon::now()->endOfMonth()->subMonth(6),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
            $last_7_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(7),
                            Carbon::now()->endOfMonth()->subMonth(7),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
            $last_8_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(8),
                            Carbon::now()->endOfMonth()->subMonth(8),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
            $last_9_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(9),
                            Carbon::now()->endOfMonth()->subMonth(9),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
            $last_10_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(10),
                            Carbon::now()->endOfMonth()->subMonth(10),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
            $last_11_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(11),
                            Carbon::now()->endOfMonth()->subMonth(11),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
            $last_12_month = WorkingHour::with('employee')
                ->select(['id','employee_id',
                \DB::raw("DATE_FORMAT(date,'%Y-%M') as month"),
                \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                ->whereBetween('date', [
                            Carbon::now()->startOfMonth()->subMonth(12),
                            Carbon::now()->endOfMonth()->subMonth(12),
                        ])
                ->groupBy('id') 
                ->groupBy('hours') 
                ->groupBy('employee_id')
                ->groupBy('month')
                ->orderBy('month','desc');
                
            if ($request->has('employee')) {
                $current_month->where('employee_id', $request->employee);
                $last_month->where('employee_id', $request->employee);
                $last_2_month->where('employee_id', $request->employee);
                $last_3_month->where('employee_id', $request->employee);
                $last_4_month->where('employee_id', $request->employee);
                $last_5_month->where('employee_id', $request->employee);
                $last_6_month->where('employee_id', $request->employee);
                $last_7_month->where('employee_id', $request->employee);
                $last_8_month->where('employee_id', $request->employee);
                $last_9_month->where('employee_id', $request->employee);
                $last_10_month->where('employee_id', $request->employee);
                $last_11_month->where('employee_id', $request->employee);
                $last_12_month->where('employee_id', $request->employee);

                $last_year->where('employee_id', $request->employee);
                $current_year->where('employee_id', $request->employee);
                
            }
            $current_month_q = $current_month->get();
            $last_month_q = $last_month->get();
            $last_2_month_q = $last_2_month->get();
            $last_3_month_q = $last_3_month->get();
            $last_4_month_q = $last_4_month->get();
            $last_5_month_q = $last_5_month->get();
            $last_6_month_q = $last_6_month->get();
            $last_7_month_q = $last_7_month->get();
            $last_8_month_q = $last_8_month->get();
            $last_9_month_q = $last_9_month->get();
            $last_10_month_q = $last_10_month->get();
            $last_11_month_q = $last_11_month->get();
            $last_12_month_q = $last_12_month->get();

            $current_year_q = $current_year->get();
            $last_year_q = $last_year->get();

            $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');
            $report_cy = [];
            $report_ly = [];

            $report_cm = [];
            $report_lm = [];
            $report_l2m = [];
            $report_l3m = [];
            $report_l4m = [];
            $report_l5m = [];
            $report_l6m = [];
            $report_l7m = [];
            $report_l8m = [];
            $report_l9m = [];
            $report_l10m = [];
            $report_l11m = [];
            $report_l12m = [];
            $totalTime_cm = 0;
            $totalTime_lm = 0;
            $totalTime_l2m = 0;
            $totalTime_l3m = 0;
            $totalTime_l4m = 0;
            $totalTime_l5m = 0;
            $totalTime_l6m = 0;
            $totalTime_l7m = 0;
            $totalTime_l8m = 0;
            $totalTime_l9m = 0;
            $totalTime_l10m = 0;
            $totalTime_l11m = 0;
            $totalTime_l12m = 0;

            $totalTime_cy = 0;
            $totalTime_ly = 0;

            //get the employee from the select and structure the table
            if($request->has('employee')) {
            $currentEmployee = $request->get('employee');
            
            //foreach de sum
            foreach($current_year_q as $item_cy) {
               
                $totalTime_cy = $totalTime_cy + strtotime("1970-01-01 $item_cy->hours UTC");
                $totalHours_cy = gmdate("H:i:s", $totalTime_cy); 
               
                
                $report_cy[$item_cy->month] = [
                    'hours'=> $totalHours_cy,
                ];
            }
            foreach($last_year_q as $item_ly) {
                
                $totalTime_ly = $totalTime_cm + strtotime("1970-01-01 $item_ly->hours UTC");
                $totalHours_ly = gmdate("H:i:s", $totalTime_ly); 
                $report_ly[$item_ly->month] = [
                    'hours'=> $totalHours_ly,
                ];
            }


            foreach($current_month_q as $item_cm) {
                    $totalTime_cm = $totalTime_cm + strtotime("1970-01-01 $item_cm->hours UTC");
                    $totalHours_cm = gmdate("H:i:s", $totalTime_cm); 
                    $report_cm[$item_cm->month] = [
                        'hours'=> $totalHours_cm,
                    ];
                }
            foreach($last_month_q as $item_lm) {
                
                $totalTime_lm = $totalTime_lm + strtotime("1970-01-01 $item_lm->hours UTC");
                $totalHours_lm = gmdate("H:i:s", $totalTime_lm); 
                $report_lm[$item_lm->month] = [
                    'hours'=> $totalHours_lm,
                ];
            }  
            foreach($last_2_month_q as $item_l2m) {
                $totalTime_l2m = $totalTime_l2m + strtotime("1970-01-01 $item_l2m->hours UTC");
                $totalHours_l2m = gmdate("H:i:s", $totalTime_l2m); 
                $report_l2m[$item_l2m->month] = [
                    'hours'=> $totalHours_l2m,
                ];
            }  
            foreach($last_3_month_q as $item_l3m) {
                $totalTime_l3m = $totalTime_l3m + strtotime("1970-01-01 $item_l3m->hours UTC");
                $totalHours_l3m = gmdate("H:i:s", $totalTime_l3m); 
                $report_l3m[$item_l3m->month] = [
                    'hours'=> $totalHours_l3m,
                ];
            }  
            foreach($last_4_month_q as $item_l4m) {
                $totalTime_l4m = $totalTime_l4m + strtotime("1970-01-01 $item_l4m->hours UTC");
                $totalHours_l4m = gmdate("H:i:s", $totalTime_l4m); 
                $report_l4m[$item_l4m->month] = [
                    'hours'=> $totalHours_l4m,
                ];
            }  
            foreach($last_5_month_q as $item_l5m) {
                $totalTime_l5m = $totalTime_l5m + strtotime("1970-01-01 $item_l5m->hours UTC");
                $totalHours_l5m = gmdate("H:i:s", $totalTime_l5m); 
                $report_l5m[$item_l5m->month] = [
                    'hours'=> $totalHours_l5m,
                ];
            }  
            foreach($last_6_month_q as $item_l6m) {
                $totalTime_l6m = $totalTime_l6m + strtotime("1970-01-01 $item_l6m->hours UTC");
                $totalHours_l6m = gmdate("H:i:s", $totalTime_l6m); 
                $report_l6m[$item_l6m->month] = [
                    'hours'=> $totalHours_l6m,
                ];
            }  
            foreach($last_7_month_q as $item_l7m) {
                $totalTime_l7m = $totalTime_l7m + strtotime("1970-01-01 $item_l7m->hours UTC");
                $totalHours_l7m = gmdate("H:i:s", $totalTime_l7m); 
                $report_l7m[$item_l7m->month] = [
                    'hours'=> $totalHours_l7m,
                ];
            }  
            foreach($last_8_month_q as $item_lm) {
                $totalTime_l8m = $totalTime_l8m + strtotime("1970-01-01 $item_l8m->hours UTC");
                $totalHours_l8m = gmdate("H:i:s", $totalTime_l8m); 
                $report_l8m[$item_l8m->month] = [
                    'hours'=> $totalHours_l8m,
                ];
            }
            foreach($last_9_month_q as $item_l9m) {
                $totalTime_l9m = $totalTime_l9m + strtotime("1970-01-01 $item_l9m->hours UTC");
                $totalHours_l9m = gmdate("H:i:s", $totalTime_l9m); 
                $report_l9m[$item_l9m->month] = [
                    'hours'=> $totalHours_l9m,
                ];
            }
            foreach($last_10_month_q as $item_l10m) {
                $totalTime_l10m = $totalTime_l10m + strtotime("1970-01-01 $item_l10m->hours UTC");
                $totalHours_l10m = gmdate("H:i:s", $totalTime_l10m); 
                $report_l10m[$item_l10m->month] = [
                    'hours'=> $totalHours_l10m,
                ];
            }
            foreach($last_11_month_q as $item_l11m) {
                $totalTime_l11m = $totalTime_l11m + strtotime("1970-01-01 $item_l11m->hours UTC");
                $totalHours_l11m = gmdate("H:i:s", $totalTime_l11m); 
                $report_l11m[$item_l11m->month] = [
                    'hours'=> $totalHours_l11m,
                ];
            }
            foreach($last_12_month_q as $item_l12m) {
                $totalTime_l12m = $totalTime_l12m + strtotime("1970-01-01 $item_l12m->hours UTC");
                $totalHours_l12m = gmdate("H:i:s", $totalTime_l12m); 
                $report_l12m[$item_l12m->month] = [
                    'hours'=> $totalHours_l12m,
                ];
            }  

            } else {
                $currentEmployee = '';
            } 

        return view('admin.workingHours.raport',compact('report_cy','report_ly','report_cm','report_lm','report_l2m','report_l3m','report_l4m','report_l5m','report_l6m','report_l7m','report_l8m','report_l9m','report_l9m','report_l10m','report_l10m','report_l11m','report_l12m','employees','currentEmployee'));
    }
    public function index(Request $request)
    {
        abort_if(Gate::denies('working_hour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
     
            $table = WorkingHour::all();

            $q = WorkingHour::with('employee')
                ->orderBy('id','asc');
            if ($request->has('employee')) {
                $q->where('employee_id', $request->employee);
                $working_hours = $q->get();
            } else {
                $working_hours = [];
            }

            $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');
         
            if($request->has('employee')) {
                $currentEmployee = $request->get('employee');

            } else {
                $currentEmployee = '';
            }

        return view('admin.workingHours.index',compact('working_hours','employees','currentEmployee'));
      
    }

    public function create()
    {
        abort_if(Gate::denies('working_hour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workingHours.create', compact('employees', 'projects'));
    }

    public function user_create()
    {
        abort_if(Gate::denies('working_hour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_auth = Auth::user();
        
        $employees = User::select('id','employee_id','name')
        ->where('id','=', $user_auth->id)
        ->select('id','name')
        ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        // dd($users);
        // $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('user.profil.create', compact('employees', 'projects'));
    }

    public function store(StoreWorkingHourRequest $request)
    {
        $workingHour = WorkingHour::create($request->all());

        return redirect()->route('admin.working-hours.index');
    }

    public function user_store(StoreWorkingHourRequest $request)
    {
        $workingHour = WorkingHour::create($request->all());

        return redirect()->route('admin.profile');
    }

    public function edit(WorkingHour $workingHour)
    {
        abort_if(Gate::denies('working_hour_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workingHour->load('employee', 'project', 'created_by');

        return view('admin.workingHours.edit', compact('employees', 'projects', 'workingHour'));
    }

    public function user_edit(WorkingHour $workingHour)
    {
        abort_if(Gate::denies('working_hour_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workingHour->load('employee', 'project', 'created_by');

        return view('user.profil.edit', compact('employees', 'projects', 'workingHour'));
    }

    public function update(UpdateWorkingHourRequest $request, WorkingHour $workingHour)
    {
        $workingHour->update($request->all());

        return redirect()->route('admin.working-hours.index');
    }

    public function user_update(UpdateWorkingHourRequest $request, WorkingHour $workingHour)
    {
        $workingHour->update($request->all());
        dd( $workingHour);
        return redirect()->route('admin.profile');
    }

    public function show(WorkingHour $workingHour)
    {
        abort_if(Gate::denies('working_hour_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workingHour->load('employee', 'project', 'created_by');

        return view('admin.workingHours.show', compact('workingHour'));
    }

    public function destroy(WorkingHour $workingHour)
    {
        abort_if(Gate::denies('working_hour_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workingHour->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkingHourRequest $request)
    {
        WorkingHour::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
