<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule','array<mixed>','string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method == 'PUT') {

            return [
                'title' => ['required'],
                'description' => ['required'],
                'category_id' => ['required', 'exists:categories,id'],
                'tags' => ['nullable', 'array'],
                'tags.*' => ['exists:tags,id'],
            ];
        } else {
            return [
                'title' => ['sometimes', 'required'],
                'description' => ['sometimes', 'required'],
                'category_id' => ['sometimes', 'required', 'exists:categories,id'],
                'tags' => ['sometimes', 'nullable', 'array'],
                'tags.*' => ['sometimes', 'exists:tags,id'],
            ];
        }
    }
}
