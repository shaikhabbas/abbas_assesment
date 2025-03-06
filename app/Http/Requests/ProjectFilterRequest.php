<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'filters' => 'sometimes|array',
            'filters.name' => 'sometimes|string',
            'filters.status' => 'sometimes|string',
            'filters.*' => 'sometimes|string', 
        ];
    }
}
