<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class DeliverablePutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'original_name' => 'nullable|string|max:255',
            'task_id' => 'nullable|integer',
            'status' => 'required|in:0,1,2,3'
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->status !== null) {
            $this->merge([
                'status' => intval((trim($this->status))),
            ]);
        }
    }
}
