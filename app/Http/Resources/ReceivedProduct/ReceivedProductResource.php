<?php

namespace App\Http\Resources\ReceivedProduct;

use Illuminate\Http\Resources\Json\JsonResource;

class ReceivedProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product_id' => $this->product_id,
            'total_amount' => $this->total_amount
        ];
    }
}
