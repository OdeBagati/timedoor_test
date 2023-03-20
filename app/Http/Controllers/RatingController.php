<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Rating;

class RatingController extends Controller
{
    //
    public function index()
    {
        $listRating = DB::table('ratings')
            ->join('authors', 'ratings.author_id', '=', 'authors.author_id')
            ->join('books', 'ratings.book_id', '=', 'books.book_id')
            ->select('*')
            ->limit(100)
            ->get();

    return view('rating',['listRating'=>$listRating]);
    }

    public function create()
    {
        $dataBook= DB::table('books')->get();
        $dataAuthor = DB::table('authors')->get();

        return view('input_rating',['dataBook'=>$dataBook, 'dataAuthor'=>$dataAuthor]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required',
            'book_id' => 'required',
        ]);

        Rating::create($request->all());

        return redirect()->route('home')->with('success','Rating added successfully');
    }
}