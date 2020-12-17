<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEmploymentRequest;
use App\Http\Requests\StoreEmploymentRequest;
use App\Http\Requests\UpdateEmploymentRequest;
use App\Models\Employment;
use App\Models\Employee;
use App\Entities\RegisterEmployment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmploymentsController extends Controller
{
    protected $employments;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RegisterEmployment $employments)
    {
        $this->employments = $employments;
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('employment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // if ($request->ajax()) {
        //     $query = Employment::with(['employee', 'created_by'])->select(sprintf('%s.*', (new Employment)->table));
        //     $table = Datatables::of($query);

        //     $table->addColumn('placeholder', '&nbsp;');
        //     $table->addColumn('actions', '&nbsp;');

        //     $table->editColumn('actions', function ($row) {
        //         $viewGate      = 'employment_show';
        //         $editGate      = 'employment_edit';
        //         $deleteGate    = 'employment_delete';
        //         $crudRoutePart = 'employments';

        //         return view('partials.datatablesActions', compact(
        //             'viewGate',
        //             'editGate',
        //             'deleteGate',
        //             'crudRoutePart',
        //             'row'
        //         ));
        //     });

        //     $table->editColumn('id', function ($row) {
        //         return $row->id ? $row->id : "";
        //     });
        //     $table->addColumn('employee_first_name', function ($row) {
        //         return $row->employee ? $row->employee->first_name : '';
        //     });

        //     $table->editColumn('employee.last_name', function ($row) {
        //         return $row->employee ? (is_string($row->employee) ? $row->employee : $row->employee->last_name) : '';
        //     });
        //     $table->rawColumns(['actions', 'placeholder', 'employee']);
           
        //     return $table->make(true);
        // }
        $employments = Employment::all();

        return view('admin.employments.index', compact('employments'));
    }

    public function create()
    {
        abort_if(Gate::denies('employment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.employments.create', compact('employees'));
    }

    public function store(Request $request)
    { 
        $request->validate([
            'employee_id' => 'required',
            'hour' => 'required',
            'money' =>'required'
            ]);
            // dd($request->all());
        $employment = $this->employments->registerEmployment($request->all());
        
        return redirect()->route('admin.employments.index');
    }

    public function edit(employment $employment)
    {
        abort_if(Gate::denies('employment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employment->load( 'employee', 'created_by');

        return view('admin.employments.edit', compact( 'employees', 'employment'));
    }

    public function update(UpdateemploymentRequest $request, employment $employment)
    {
        $employment->update($request->all());

        return redirect()->route('admin.employments.index');
    }

    public function show(employment $employment)
    {
        abort_if(Gate::denies('employment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employment->load('employee', 'created_by');

        return view('admin.employments.show', compact('employment'));
    }

    public function destroy(employment $employment)
    {
        abort_if(Gate::denies('employment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employment->delete();

        return back();
    }

    public function massDestroy(MassDestroyemploymentRequest $request)
    {
        Employment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
