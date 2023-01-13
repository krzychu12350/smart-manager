<?php

namespace App\Http\Resources;

use App\Models\Application;
use App\Models\Income;
use App\Models\User;
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
            'email' => $this->email,
            'position' => $this->position,
            //'salary' => $this->salary,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'is_owner' => $this->is_owner,
            'companies' => $this->companies  ?? null,
            'salary' => Income::where('user_id', $this->id)->latest()->first()->amount ?? 0,
            'applications' => Application::join('companies', 'companies.id', 'applications.company_id')
                ->where('user_id', $this->id)->get(),
        ];



    }
}
