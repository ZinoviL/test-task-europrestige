<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParameterRequest;
use App\Http\Requests\UpdateParameterRequest;
use App\Models\Parameter;
use Illuminate\Http\JsonResponse;

class ParameterController extends Controller
{
    /**
     * @param StoreParameterRequest $request
     * @return JsonResponse
     */
    public function store(StoreParameterRequest $request): JsonResponse
    {
        $parameter = new Parameter();
        $parameter->fill($request->validated())->save();
        return new JsonResponse(null, 204);
    }

    /**
     * @param UpdateParameterRequest $request
     * @param Parameter $parameter
     * @return JsonResponse
     */
    public function update(UpdateParameterRequest $request, Parameter $parameter): JsonResponse
    {
        $parameter->fill($request->validated())->save();
        return new JsonResponse(null, 204);
    }

    /**
     * @param Parameter $parameter
     * @return JsonResponse
     */
    public function destroy(Parameter $parameter): JsonResponse
    {
        $parameter->delete();
        return new JsonResponse(null, 204);
    }
}
