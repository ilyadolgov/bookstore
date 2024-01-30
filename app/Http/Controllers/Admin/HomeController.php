<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;

class HomeController extends Controller
{
    public function index() {

        $books_count = Book::all()->count();
        $users_count = User::all()->count();
        return view('admin.home.index', ['books_count'=> $books_count], ['users_count'=>$users_count]);
    }
}
