<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    protected $model = Rating::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $total_author = DB::table('authors')->count();
        // $total_book = DB::table('books')->count();

        return [
            //
            'book_id' => fake()->numberBetween(1, 10000),
            'author_id' => fake()->numberBetween(1, 100),
            'rating' => fake()->numberBetween(1, 10),
        ];
    }
}
