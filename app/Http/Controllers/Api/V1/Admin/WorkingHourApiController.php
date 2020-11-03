<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkingHourRequest;
use App\Http\Requests\UpdateWorkingHourRequest;
use App\Http\Resources\Admin\WorkingHourResource;
use App\Models\WorkingHour;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkingHourApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('working_hour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkingHourResource(WorkingHour::with(['employee', 'project', 'created_by'])->get());
    }

    public function store(StoreWorkingHourRequest $request)
    {
        $workingHour = WorkingHour::create($request->all());

        return (new WorkingHourResource($workingHour))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(WorkingHour $workingHour)
    {
        abort_if(Gate::denies('working_hour_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkingHourResource($workingHour->load(['employee', 'project', 'created_by']));
    }

    public function update(UpdateWorkingHourRequest $request, WorkingHour $workingHour)
    {
        $workingHour->update($request->all());

        return (new WorkingHourResource($workingHour))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(WorkingHour $workingHour)
    {
        abort_if(Gate::denies('working_hour_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workingHour->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
