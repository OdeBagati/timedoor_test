<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $total_author = DB::table('authors')->count();
        $total_category = DB::table('book_categories')->count();

        return [
            //
            'book_name' => fake()->sentence(5),
            'book_category' => fake()->numberBetween(1, $total_category),
            'book_author' => fake()->randomNumber(1, $total_author),
        ];
    }
}
