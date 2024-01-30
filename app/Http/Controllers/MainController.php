<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class MainController extends Controller
{

    /**Вывод всех данных из базы данных */
    public function index()
    {
        $books = Book::orderBy('name')
            ->paginate(15);

        $genre = Book::select('genre')
            ->groupBy('genre')
            ->get();

        return view('mainpage.homepage', compact('books', 'genre'));
    }

    /** Поиск книг в базе данных */
    public function search(Request $request)
    {
        $searchname = $request->searchname;
        $books = Book::where('name', 'LIKE', "%{$searchname}%")->orderBy('name')->paginate(10);

        $genre = Book::select('genre')
            ->groupBy('genre')
            ->get();

        return view('mainpage.homepage', compact('books', 'genre'));
    }

    /** Поиск книг в по жанру в БД */
    public function searchgenre(Request $request)
    {
        /** Получение имени жанра методом GET */
        $genre=$request->genre;
        
        $books = Book::where('genre', 'LIKE', "%{$genre}%")->orderBy('genre')->paginate(10);

        $genre = Book::select('genre')
            ->groupBy('genre')
            ->get();

        return view('mainpage.homepage', compact('books', 'genre'));
    }

}
