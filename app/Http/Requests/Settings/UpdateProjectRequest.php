<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $project = $this->route('project');

        return [
            'portfolio' => ['required', Rule::in(['fabia', 'ramos', 'both'])],
            'title' => [
                'required',
                'string',
                'max:120',
                Rule::unique('projects', 'title')
                    ->where(fn ($query) => $query->where('portfolio', $this->input('portfolio')))
                    ->ignore($project),
            ],
            'description' => ['required', 'string', 'min:20', 'max:2000'],
            'tech_stack' => ['required', 'array', 'min:1', 'max:10'],
            'tech_stack.*' => ['required', 'string', 'max:40'],
            'project_url' => ['nullable', 'url:http,https', 'max:2048'],
            'repository_url' => ['nullable', 'url:http,https', 'max:2048'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'completed_at' => ['nullable', 'date', 'before_or_equal:today'],
            'display_order' => ['required', 'integer', 'between:0,9999'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this->input('tech_stack'))) {
            $this->merge([
                'tech_stack' => array_values(array_filter(
                    array_map('trim', explode(',', $this->input('tech_stack'))),
                    fn (string $tag): bool => $tag !== '',
                )),
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'title.unique' => 'A project with this title already exists for the selected portfolio.',
            'description.min' => 'Please provide a description of at least 20 characters.',
            'image.image' => 'The project image must be a valid image file.',
        ];
    }
}
