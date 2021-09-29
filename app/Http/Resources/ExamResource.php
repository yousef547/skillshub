<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_en' => $this->name('en'),
            'name_ar' => $this->name('ar'),
            'img' => asset("uploads/$this->img"),
            'questions'=> QuestionsResource::collection($this->whenLoaded('questions'))
        ];
    }
}
