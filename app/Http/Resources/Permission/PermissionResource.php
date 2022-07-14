<?php

namespace App\Http\Resources\Permission;

use App\Models\Permission\Permission;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
        $data["name"] =  str_replace(' ', '', $this->name);
        $data["url"] =  str_replace(' ', '', $this->url);
        $data['children'] = PermissionResource::collection(Permission::getAllChildrenbyParentId($this->id));

        return $data;
    }
}
