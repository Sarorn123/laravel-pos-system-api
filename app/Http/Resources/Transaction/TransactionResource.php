<?php

namespace App\Http\Resources\Transaction;

use App\util\Util;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
        $data["product_id"] = $this->product_id;
        $data["product_name"] = $this->getProduct ? $this->getProduct->name : "";
        $data["customer_id"] = $this->customer_id;
        $data["customer_name"] = $this->getCustomer ? $this->getCustomer->name : "";
        $data["date"] = Util::dateCoverter($this->date);
        $data["quantity"] = $this->quantity;
        $data["price"] = $this->price;
        $data["discount"] = $this->discount;
        $data["status"] = $this->status;
        $data["transaction_number"] = $this->transaction_number;
        $data["description"] = $this->description;
        
        return $data;
    }
}
