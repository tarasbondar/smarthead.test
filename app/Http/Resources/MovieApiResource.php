<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieApiResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'status' => $this->status,
            'genres' => GenreApiResource::collection($this->genres),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
