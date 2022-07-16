<?php

namespace App\Http\Resources\Customer;

use App\util\Util;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
        $data["name"] =  $this->name;
        $data["email"] =  $this->email;
        $data["phone"] =  $this->phone;
        $data["gender"] =  $this->gender;

        return $data;
    }
}
