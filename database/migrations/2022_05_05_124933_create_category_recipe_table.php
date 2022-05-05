<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('category_recipe', function (Blueprint $table) {
            $table->foreignId('recipe_category_id')
                ->constrained('recipe_categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('recipe_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['recipe_category_id', 'recipe_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('category_recipe');
    }
};
