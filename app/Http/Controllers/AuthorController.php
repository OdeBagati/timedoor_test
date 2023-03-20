<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    //
    public function index()
    {
        $listAuthor = DB::table('ratings')
                    ->join('authors', 'ratings.author_id', '=', 'authors.author_id')
                    ->select('authors.author_name', DB::raw('COUNT(rating_id) as total_rating'))
                    ->groupBy('author_name')
                    ->havingRaw('AVG(rating)>?',[5])
                    ->orderBy('total_rating', 'DESC')
                    ->limit(10)
                    ->get();
        
        return view('author',['listAuthor'=>$listAuthor]);
    }

    public function getAuthor($book_id=0)
    {
        $dataAuthors = DB::table('books')
                        ->join('authors', 'books.book_author', '=', 'authors.author_id')
                        ->select('authors.author_id','authors.author_name')
                        ->where('book_id',$book_id)
                        ->get();

                        // dd($dataAuthors);

        return response()->json($dataAuthors);
    }
}
