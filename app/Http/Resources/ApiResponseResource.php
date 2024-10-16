<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'Operation Successful',
            'data'    => $this->resource,
        ];
    }
    public function withResponse($request, $response)
    {
        $response->setStatusCode(200);
    }
}
