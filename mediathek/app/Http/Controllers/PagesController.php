<?php

namespace App\Http\Controllers;
use App\Book; //damit er Post:: benutzen kann obwohl er im pagesController arbeitet
use App\Film;
use Illuminate\Http\Request;

class PagesController extends Controller
{
   
    public function getIndex()
    { 
        $books = Book::orderBy('created_at' , 'desc')->limit(6)->get(); 
        $films = Film::orderBy('created_at' , 'desc')->limit(6)->get(); 
        return view('pages.welcome')->withBooks($books)->withFilms($films);
    }
    
     public function getList()
    {
        //$posts = Post::all(); ginge auch, aber will wollen sie geordnet:
        $books = Book::orderBy('id', 'desc')->paginate(10); 
        return view('books.list')->withBooks($books); 
    }
    

}
