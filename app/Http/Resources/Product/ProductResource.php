<?php

namespace App\Http\Resources\Product;

use App\util\Util;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
        $data["in_stock_price"] =  $this->in_stock_price;
        $data["sell_price"] =  $this->sell_price;
        $data["in_stock"] =  $this->in_stock;
        $data["discount"] =  $this->discount;
        $data["category_id"] =  $this->category_id;
        $data["supplier_id"] =  $this->supplier_id;
        $data["in_stock_date"] = Util::dateCoverter($this->in_stock_date);
        $data["out_stock_date"] = Util::dateCoverter($this->out_stock_date);
        $data["description"] =  $this->description;

        return $data;
    }
}
