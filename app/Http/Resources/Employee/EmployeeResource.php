<?php

namespace App\Http\Resources\Employee;

use App\util\Util;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
        $data["gender"] =  $this->gender;
        $data["date_of_birth"] = Util::dateCoverter($this->date_of_birth);
        $data["email"] =  $this->email;
        $data["phone"] =  $this->phone;
        $data["salary"] =  $this->salary;
        $data["address"] =  $this->address;
        $data["image_url"] =  $this->image_url;
        $data["position"] =  $this->position_id;
        

        return $data;
    }
}
