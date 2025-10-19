<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'User';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'Id' => $this->id,
            'Name' => $this->name,
            'Email' => $this->email,
            'Mobile' => $this->mobile,
            'Roles' => $this->roles,
            'posts' => PostResource::collection($this->whenLoaded('posts'))
        ];
    }
}
