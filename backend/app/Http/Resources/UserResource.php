<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'position' => $this->position,
            'salary' => $this->salary,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'is_owner' => $this->is_owner,
            'companies' => $this->companies,
        ];



    }
}
