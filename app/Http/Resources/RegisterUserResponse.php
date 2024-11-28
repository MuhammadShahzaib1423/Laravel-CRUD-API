<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterUserResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'response' => [
                'message' => 'User registered successfully',
                'status' => 200,
            ],
            'data' => [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->Phone,
                'status' => $this->Status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'id' => $this->id,
            ],
            
        ];
    }
}
