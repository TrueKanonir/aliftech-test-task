<?php

namespace App\Http\Resources\Api\v1;

use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    #[ArrayShape([
        'id' => "int",
        'name' => "string",
        'contacts' => "\Illuminate\Http\Resources\Json\AnonymousResourceCollection"
    ])]
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'contacts' => ApiContactResource::collection($this->whenLoaded('contacts')),
        ];
    }
}
