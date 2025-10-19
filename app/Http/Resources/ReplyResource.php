<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Id' => $this->id,
            'reply' => $this->reply,
            'Comment Id' => $this->comment_id,
            'User' => UserResource::make($this->whenLoaded('user'))
        ];
    }
}
