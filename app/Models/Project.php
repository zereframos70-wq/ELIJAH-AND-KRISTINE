<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'portfolio',
        'title',
        'description',
        'tech_stack',
        'project_url',
        'repository_url',
        'image_path',
        'completed_at',
        'display_order',
        'project_note',
    ];

    protected $appends = ['image_url'];

    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
            'completed_at' => 'date',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image_path) {
            return null;
        }

        return Str::startsWith($this->image_path, '/')
            ? $this->image_path
            : Storage::disk('public')->url($this->image_path);
    }
}
