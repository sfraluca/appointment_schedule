<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkingHourRequest;
use App\Http\Requests\StoreWorkingHourRequest;
use App\Http\Requests\UpdateWorkingHourRequest;
use App\Models\Employee;
use App\Models\Project;
use App\Models\WorkingHour;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkingHourController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('working_hour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorkingHour::with(['employee', 'project', 'created_by'])->select(sprintf('%s.*', (new WorkingHour)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'working_hour_show';
                $editGate      = 'working_hour_edit';
                $deleteGate    = 'working_hour_delete';
                $crudRoutePart = 'working-hours';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('employee_first_name', function ($row) {
                return $row->employee ? $row->employee->first_name : '';
            });

            $table->editColumn('employee.last_name', function ($row) {
                return $row->employee ? (is_string($row->employee) ? $row->employee : $row->employee->last_name) : '';
            });

            $table->editColumn('start_time', function ($row) {
                return $row->start_time ? $row->start_time : "";
            });
            $table->editColumn('finish_time', function ($row) {
                return $row->finish_time ? $row->finish_time : "";
            });
            $table->addColumn('project_name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'employee', 'project']);

            return $table->make(true);
        }

        return view('admin.workingHours.index');
    }

    public function create()
    {
        abort_if(Gate::denies('working_hour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workingHours.create', compact('employees', 'projects'));
    }

    public function store(StoreWorkingHourRequest $request)
    {
        $workingHour = WorkingHour::create($request->all());

        return redirect()->route('admin.working-hours.index');
    }

    public function edit(WorkingHour $workingHour)
    {
        abort_if(Gate::denies('working_hour_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workingHour->load('employee', 'project', 'created_by');

        return view('admin.workingHours.edit', compact('employees', 'projects', 'workingHour'));
    }

    public function update(UpdateWorkingHourRequest $request, WorkingHour $workingHour)
    {
        $workingHour->update($request->all());

        return redirect()->route('admin.working-hours.index');
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
