<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TyresServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'client' => $this->client,
            'date' => $this->date_of_service
        ];
    }
}
