<?php

namespace App\Http\Resources\Supplier;

use App\util\Util;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data["id"] = $this->id;
        $data["name"] = $this->name;
        $data["phone"] = $this->phone;
        $data["email"] = $this->email;
        $data["social_media"] = $this->social_media;
        $data["description"] = $this->description;
        
        return $data;
    }
}
