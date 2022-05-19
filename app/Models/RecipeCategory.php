<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RecipeCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'category_recipe')->withTimestamps();
    }

    public function name(): Attribute
    {
        return Attribute::make(
            set: fn($name) => ucfirst($name)
        );
    }
}
