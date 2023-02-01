<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionBankResource extends JsonResource
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
            "id" => $this->id,
            "question" => $this->question,
            "answerId" => $this->answer,
            "answer" => $this->getAnswer(),
            "options" => $this->options,
            "type" => $this->getTypeName(),
            "typeCode" => $this->type
        ];
    }
}
