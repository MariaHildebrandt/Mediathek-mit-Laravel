<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\Book;
use App\Image;
use Session;
use Validator;
use Redirect;

class BookController extends Controller
{
    public function index()
    {
        //$books = Book::all();
        $books = Book::orderBy('id', 'desc')->paginate(15); 
        return view('books.index')->withBooks($books); 
    }
    

    public function create()
    {
       return view('books.create');
    }

    public function store(Request $request)
    { 
        
        /*image uplaod*/
        $file = array('image' => Input::file('image'));
        $rules = array(
                'image' => 'required',
                ); 
        
        $validator = Validator::make($file, $rules);
        
        if ($validator->fails()) 
        {
            return redirect()->route('books.show', $book->id)->withErrors($validator);
        }
        else
        {
            if (Input::file('image')->isValid()) 
            {
                $destinationPath = 'images'; // upload path ist app/public/images

                $extension = Input::file('image')->getClientOriginalExtension(); //dateityp
                $fileName = rand(11111,99999).'.'.$extension; // umbenennen
                
                //upload in ddestination
                Input::file('image')->move($destinationPath, $fileName); 

                $today =date('y-m-d h:i:s');
                $image_id = DB::table('images')->insertGetId(
                    array('filename' => $fileName, 
                          'path' => $destinationPath,
                         'created_at' => $today
                ));
            }
            else 
            {
                Session::flash('error', 'uploaded file is not valid');
                //return Redirect::to('upload');
            }
        }

            
        $this->validate($request, array(
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'category' => 'required|max:255',
            'description' => 'required',
            'image_id' => 'image|max:5000'
        ));
   
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->category = $request->category;
        $book->description = $request->description;
        //$book->image_id = $request->image_id;
        $book->image_id = $image_id;
        
        $book->save();
        
        Session::flash('success', 'Buch gespeichert!');
        
        return redirect()->route('books.show' ,[ $book->id]);
    }


    public function show($id)
    {
        $book = Book::find($id);
        return view('books.show')->withBook($book); 
    }


    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit')->withBook($book);
    }


    public function update(Request $request, $id)
    { 
        $book = Book::find($id);
        $old_image_id = $book->image_id;
        
        //Filename des bildes das vor dem update angezeigt wurde
        $old_image = DB::table('images')->where('image_id', $old_image_id)->get(array('filename'));
        $array = json_decode($old_image, true);
        $old_filename= $array[0]["filename"];
        
        
         /*image uplaod*/
        
        if (Input::hasFile('image'))
        {
            $file = array('image' => Input::file('image'));
            $rules = array( 'image' => 'image|sometimes|required' ); 
            $validator = Validator::make($file, $rules);
        
            if ($validator->fails()) 
            {
                return redirect()->route('books.edit', $book->id)->withErrors($validator);
            }
            else
            {
                if (Input::file('image')->isValid()) 
                {
                    $destinationPath = 'images'; // upload path ist app/public/images
                    
                    //altes bild aus storage löschen
                    File::delete($destinationPath.'/'.$old_filename);
                    
                    //neues Bild in storage speichern
                    $extension = Input::file('image')->getClientOriginalExtension(); //dateityp
                    $fileName = rand(11111,99999).'.'.$extension; // umbenennen
                    Input::file('image')->move($destinationPath, $fileName); //upload in destination
                    
                    //neuen Datenabnkeintrag machen
                    $new_image_id = DB::table('images')->insertGetId( array('filename' => $fileName, 
                                                                                'path' => $destinationPath,
                                                                          'created_at' => date('y-m-d h:i:s') ));
                    //für Eintrag in books Tabelle:
                    $image_id = $new_image_id;
                }
                else 
                {
                    Session::flash('error', 'Datei ist nicht gültig');
                    return redirect()->route('books.show', $book->id);
                }
            }

        }
        else
        {
            //wenn kein neues bild hochgeladen wurde/nehme altes bild
             $image_id = $book->image_id;
        }
       
        
        $this->validate($request, array(
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'category' => 'required|max:255',
            'description' => 'required',
            'image_id' => 'sometimes|required'
        ));
       
        //save data to db
        $book = Book::find($id); 
        $book->title = $request->title;
        $book->author = $request->author;
        $book->category = $request->category;
        $book->description = $request->description;
        $book->image_id = $image_id;
        
        $book->save();
       
        Session::flash('success', 'Buch gespeichert.');
       
        return redirect()->route('books.show', $book->id);
    }


    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        Session::flash('success' , 'Buch gelöscht');
        return redirect()->route('books.index');
    }
}
