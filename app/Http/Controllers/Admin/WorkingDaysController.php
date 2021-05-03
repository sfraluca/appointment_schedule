<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkingDays;
use App\Models\Employee;
use App\Http\Requests\StoreWorkingDaysRequest;
use Validator;
use App\Entities\RegisterWorkingDays;
use DB;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkingDaysController extends Controller
{
    protected $working_days;
    public function __construct(RegisterWorkingDays $working_days)
    {
        $this->working_days = $working_days;
    }
    public function index()
    {
        $working_days = DB::table('working_days')
        ->join('employees','working_days.employee_id','=','employees.id')
        ->select('working_days.*','employees.first_name','employees.last_name')
        ->get();
        
        return view('admin.working_days.index', compact('working_days'));
    }

    public function create()
    {
        $employees = Employee::all()->pluck('first_name', 'id');
        return view('admin.working_days.create', compact('employees'));
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'month' => 'required',
            'days' => 'required',
            'employee_id' => 'required',
        ]);
        $working_days = $this->working_days->registerWorkingDays($request->all());

        return redirect()->route('admin.working_days.index', [$working_days->id]);
    }
    public function edit($id)
    {

        $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workingsDays = WorkingDays::find($id);

        return view('admin.working_days.edit', compact('employees', 'workingsDays'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required',
            'days' => 'required',
            'month' => 'required',
            ]); 

        $workingsDays = WorkingDays::find($id);

        $workingsDays->employee_id = $request->input('employee_id');
        $workingsDays->month = $request->input('month');
        $workingsDays->days = $request->input('days');

        $workingsDays->save();

        return redirect()->route('admin.working_days.index', [$workingsDays->id]);
    }

    public function show($id)
    {

        $workingsDays = WorkingDays::find($id);
      
        return view('admin.working_days.show', compact('workingsDays'));
    }

    public function destroy($id)
    {
        $workingsDays = WorkingDays::find($id);
        $workingsDays->delete();

        return redirect()->route('admin.working_days.index');
    }

    // public function massDestroy(MassDestroyUserRequest $request)
    // {
    //     User::whereIn('id', request('ids'))->delete();

    //     return response(null, Response::HTTP_NO_CONTENT);
    // }
}
