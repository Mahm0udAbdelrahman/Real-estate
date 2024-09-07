<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'Category' => $this->category->name,
            'Title' =>$this->title,
            'Content' => $this->content,
            'Image' => $this->image
        ];
    }
}