<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'is_admin' => $this->isAdmin(),
            'companies' => $this->companies,
        ];



    }
}
