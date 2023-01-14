<?php

namespace App\Http\Resources;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'application_date' => $this->created_at,
            'company' => CompanyResource::collection(Company::where('id', $this->company_id)->get()),
            'user' => UserResource::collection(User::where('id', $this->user_id)->get())
        ];
    }
}
