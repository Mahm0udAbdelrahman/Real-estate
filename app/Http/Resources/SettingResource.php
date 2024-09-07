<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'words guide' => $this->words_guide,
            'logo' => $this->logo,
            'favicon' => $this->favicon,
            'phone' => $this->phone,
            'email' => $this->email,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'about' => $this->about,
            'privacy' => $this->privacy,
            'terms' => $this->terms,

        ];
    }
}