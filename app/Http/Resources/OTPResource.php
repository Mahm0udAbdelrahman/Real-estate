<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OTPResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'Mobile' =>$this->mobile,
            'OTP' =>$this->code,
            // 'Country Name' =>$this->country()->name,
            // 'Country Abbreviation' =>$this->country()->abbreviation,
        ];
    }
}