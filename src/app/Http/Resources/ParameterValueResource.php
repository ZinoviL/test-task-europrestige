<?php

namespace App\Http\Resources;

use App\Models\ParameterValue;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property ParameterValue $resource
 */
class ParameterValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'value' => $this->resource->value,
            'parameter' => ParameterResource::make($this->resource->parameter)
        ];
    }
}
