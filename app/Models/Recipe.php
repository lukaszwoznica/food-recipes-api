<?php

namespace App\Models;

use App\Enums\RecipeDifficultyLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'preparation_time',
        'difficulty_level',
        'servings',
        'method',
        'author_id'
    ];

    protected $casts = [
        'difficulty_level' => RecipeDifficultyLevel::class
    ];

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('measure')->withTimestamps();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(RecipeCategory::class, 'category_recipe')->withTimestamps();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
