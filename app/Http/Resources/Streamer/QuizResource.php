<?php

namespace App\Http\Resources\Streamer;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "title" => $this->title,
            "slug" => $this->slug,
            "time" => $this->time,
            "lang" => $this->lang,
            "questions_number" => $this->questions_number,
            "created_at" => $this->created_at,
        ];
    }
}
