<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum RecipeDifficultyLevel: int
{
    case VeryEasy = 0;
    case Easy = 1;
    case Moderate = 2;
    case Challenging = 3;
    case Difficult = 4;
    case VeryDifficult = 5;

    public static function getGraphQLTypeArray(): array
    {
        $casesArray = [];
        foreach (self::cases() as $case) {
            $casesArray[strtoupper(Str::snake($case->name))] = ['value' => $case];
        }

        return $casesArray;
    }
}
