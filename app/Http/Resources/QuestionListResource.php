<?php

namespace App\Http\Resources;

use App\Models\QuestionList;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionListResource extends JsonResource
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
            "title" => $this->title,
            "expire" => $this->expiry_date,
            "mail" => $this->mail_status == QuestionList::MAIL_STATUS_COMPLETE ? "Send" : "Not Send"
        ];
    }
}
