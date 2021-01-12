<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Employment;
use App\Models\Employee;
use App\Models\User;
use DB;
use App\Models\WorkingHour;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
class HomeController
{
    
    public function profile () {
        // $employee = Employee::all();
        $user_auth = Auth::user();
        
        $users = User::select('id','employee_id')
        ->where('id','=', $user_auth->id)
        ->get();
      
        foreach($users as $employee) {
            $employees = DB::table('employees')
            ->where('employees.id','=', $employee->employee_id)
            ->leftJoin('employment','employees.id','=','employment.employee_id')
            ->get();
        

        $current_year = WorkingHour::with('employee')
                    ->select(['id','employee_id',
                    \DB::raw("DATE_FORMAT(date,'%Y') as year"),
                    \DB::raw("TIMEDIFF(finish_time, start_time) as hours")])
                    ->whereBetween('date', [
                                Carbon::now()->startOfYear(),
                                Carbon::now()->endOfYear(),
                            ])
                    ->where('working_hours.employee_id','=', $employee->employee_id)
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
                                Carbon::now()->startOfYear()->subYear(1),
                                Carbon::now()->endOfMonth()->subYear(1),
                            ])
                    ->where('working_hours.employee_id','=', $employee->employee_id)
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
                    ->where('working_hours.employee_id','=', $employee->employee_id)
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
                    ->where('working_hours.employee_id','=', $employee->employee_id)
                    ->groupBy('id') 
                    ->groupBy('hours') 
                    ->groupBy('employee_id')
                    ->groupBy('month')
                    ->orderBy('month','desc');
                // if ($request->has('employee')) {
                //         $current_month->where('employee_id', $request->employee);
                //         $last_month->where('employee_id', $request->employee);
        
                //         $last_year->where('employee_id', $request->employee);
                //         $current_year->where('employee_id', $request->employee);
                        
                // }
                $current_month_q = $current_month->get();
                $last_month_q = $last_month->get();
                $current_year_q = $current_year->get();
                $last_year_q = $last_year->get();
                $report_cy = [];
                $report_ly = [];
                $report_cm = [];
                $report_lm = [];
                $totalTime_cm = 0;
                $totalTime_lm = 0;
                $totalTime_cy = 0;
                $totalTime_ly = 0;
                
                foreach($current_year_q as $item_cy) {
               
                    $totalTime_cy = $totalTime_cy + strtotime("1970-01-01 $item_cy->hours UTC");
                    $totalHours_cy = gmdate("H:i:s", $totalTime_cy); 
                    //  dd($totalHours_cy);
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
        }
        return view('user.profile', compact('employees','report_cy','report_ly','report_cm','report_lm'));
    }
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Clients',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Client',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings1['total_number'] = 0;

        if (class_exists($settings1['model'])) {
            $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                if (isset($settings1['filter_days'])) {
                    return $query->where(
                        $settings1['filter_field'],
                        '>=',
                        now()->subDays($settings1['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings1['filter_period'])) {
                    switch ($settings1['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings1['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
        }

        $settings2 = [
            'chart_title'           => 'Projects',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Project',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings2['total_number'] = 0;

        if (class_exists($settings2['model'])) {
            $settings2['total_number'] = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
                if (isset($settings2['filter_days'])) {
                    return $query->where(
                        $settings2['filter_field'],
                        '>=',
                        now()->subDays($settings2['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings2['filter_period'])) {
                    switch ($settings2['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings2['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings2['aggregate_function'] ?? 'count'}($settings2['aggregate_field'] ?? '*');
        }

        $settings3 = [
            'chart_title'           => 'Users',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\User',
            'group_by_field'        => 'email_verified_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings3['total_number'] = 0;

        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where(
                        $settings3['filter_field'],
                        '>=',
                        now()->subDays($settings3['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings3['filter_period'])) {
                    switch ($settings3['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings3['aggregate_function'] ?? 'count'}($settings3['aggregate_field'] ?? '*');
        }

        $settings4 = [
            'chart_title'           => 'Employees',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Employee',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
        ];

        $settings4['total_number'] = 0;

        if (class_exists($settings4['model'])) {
            $settings4['total_number'] = $settings4['model']::when(isset($settings4['filter_field']), function ($query) use ($settings4) {
                if (isset($settings4['filter_days'])) {
                    return $query->where(
                        $settings4['filter_field'],
                        '>=',
                        now()->subDays($settings4['filter_days'])->format('Y-m-d')
                    );
                } else if (isset($settings4['filter_period'])) {
                    switch ($settings4['filter_period']) {
                        case 'week':
                            $start  = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month':
                            $start = date('Y-m') . '-01';
                            break;
                        case 'year':
                            $start  = date('Y') . '-01-01';
                            break;
                    }

                    if (isset($start)) {
                        return $query->where($settings4['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings4['aggregate_function'] ?? 'count'}($settings4['aggregate_field'] ?? '*');
        }

        $settings5 = [
            'chart_title'           => 'Working Hour',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\WorkingHour',
            'group_by_field'        => 'date',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'Y-m-d',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
        ];

        $chart5 = new LaravelChart($settings5);

        $settings6 = [
            'chart_title'           => 'Appointment',
            'chart_type'            => 'pie',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Appointment',
            'group_by_field'        => 'start_time',
            'group_by_period'       => 'week',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
        ];

        $chart6 = new LaravelChart($settings6);

        return view('home', compact('settings1', 'settings2', 'settings3', 'settings4', 'chart5', 'chart6'));
    }


}
