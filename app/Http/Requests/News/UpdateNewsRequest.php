<?php

namespace App\Http\Requests\News;

use App\DTO\News\UpdateNewsDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date']
        ];
    }

    public function getDTO(): UpdateNewsDTO
    {
        return new UpdateNewsDTO(
            $this->get('title'),
            $this->get('content'),
            $this->get('published_at')
        );
    }
}
