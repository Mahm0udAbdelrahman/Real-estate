<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'id' =>$this->id,
            'Name_Country' =>$this->name,
            'Abbreviation_Country' =>$this->abbreviation,
            'Code_Country' =>$this->code,
            'flag_Country' =>$this->flag,

        ];
    }
}