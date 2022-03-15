<?php

namespace App\Http\Resources\Api\v1;

use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    #[ArrayShape([
        'id' => "int",
        'type' => "string",
        'contact' => "string"
    ])]
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'type' => $this->resource->type,
            'contact' => $this->resource->contact
        ];
    }
}
