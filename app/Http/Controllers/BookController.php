<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //
    public function index()
    {
        $listBook = DB::table('ratings')
                    ->join('authors', 'ratings.author_id', '=', 'authors.author_id')
                    ->join('books', 'ratings.book_id', '=', 'books.book_id')
                    ->join('book_categories', 'books.book_category', '=', 'book_categories.category_id')
                    ->select('books.book_name', 'authors.author_name', 'book_categories.category_name', DB::raw('AVG(rating) as avg_rating'), DB::raw('COUNT(rating_id) as total_rating'))
                    ->groupBy('book_name')
                    ->orderBy('avg_rating', 'DESC')
                    ->get();
        
        return view('book',['listBook'=>$listBook]);
    }
}
