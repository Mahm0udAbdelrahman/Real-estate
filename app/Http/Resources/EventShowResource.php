<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventShowResource extends JsonResource
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
            'Name'  =>  $this->name,
            'Image' => $this->image,
            'Date'  =>  $this->date,
            'Time_TO'  =>  $this->time_to,
            'Time_From'  =>  $this->time_from,
            'Location' => $this->location,
            'Organizer' => $this->admin_id,
            
        ];
    }
}