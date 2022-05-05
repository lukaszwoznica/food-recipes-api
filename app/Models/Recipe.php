<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    use HasFactory;

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(RecipeCategory::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
