<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
            'first_name' => $this->first_name, 
            'surname' => $this->surname, 
            'middle_name' => $this->middle_name, 
            'birthday' => $this->birthday, 
            'state' => $this->state, 
            'lga' => $this->lga, 
            'address' => $this->address, 
            'email' => $this->email, 
            'phone' => $this->phone, 
            'department' => $this->department, 
            'cell' => $this->cell,
        ];
    }
}
