<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterPersonResource extends JsonResource
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
            'ID' => $this->id,
            'First_Name'           => $this->first_name,
            'Last_name'            => $this->last_name,
            'Email'                => $this->email,
            'Phone'                => $this->phone,
            'Gender'               => $this->gender,
            'Age'                  => $this->age,
            'Image'                => $this->image,
           

        ];
    }
}