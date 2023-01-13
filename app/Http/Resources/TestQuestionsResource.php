<?php

namespace App\Http\Resources;

use App\Models\QuestionBank;
use Illuminate\Http\Resources\Json\JsonResource;

class TestQuestionsResource extends JsonResource
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
            "id" => $this->question["id"],
            "question" => $this->question["question"],
            "options" => $this->question["options"],
            "type" => $this->question["type"] == QuestionBank::TYPE_CHEMISTRY ? "Chemistry" : "Physics",
        ];
    }
}
