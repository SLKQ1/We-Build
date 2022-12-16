<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        Log::info('trying to validate rules'); 
        return [
            'title' => 'required|max:50',
            'description' => 'required|min:50',
            'team_size' => 'required|max:10',
            'due' => 'nullable|date|after:today'
        ];
    }
}