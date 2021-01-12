<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkingDays;
use App\Models\Employee;
use App\Http\Requests\StoreWorkingDaysRequest;
use Validator;
use App\Entities\RegisterWorkingDays;

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
    public function index(Request $request)
    {
        // dd('dsf');
        $working_days = WorkingDays::all();


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

        return redirect()->route('admin.working_days.index');
    }
}
