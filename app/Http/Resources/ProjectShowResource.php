<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectShowResource extends JsonResource
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
            'id'=>$this->id,
            'Name_Project' =>$this->title,
            'Description_Project' =>$this->content,
            'Logo' =>$this->logo,
            'Image' =>$this->image,
            'Date' =>$this->date,
            'Rate' =>$this->rate!=null?$this->rate:"0",
        ];
    }
}
