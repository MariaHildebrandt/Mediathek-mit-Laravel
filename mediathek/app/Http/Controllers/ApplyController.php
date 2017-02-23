<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;


use Validator;
use Redirect;
use Session;

class ApplyController extends Controller 
{
    public function upload() 
    {
        $file = array('image' => Input::file('image'));

        $rules = array(
                'image' => 'required',
                ); 
        
        //mimes:jpeg,bmp,png and for max size max:10000

        $validator = Validator::make($file, $rules);

        if ($validator->fails()) 
        {
            return Redirect::to('upload')->withInput()->withErrors($validator);
        }
        else
        {
            if (Input::file('image')->isValid()) 
            {
                $destinationPath = 'images'; // upload path ist app/public/images

                //for database path:
                /*DB::insert('insert into your_table_name (image_name, path) values (?,?)', array($fileName,$destinationPath));*/

                $extension = Input::file('image')->getClientOriginalExtension(); //dateityp
                $fileName = rand(11111,99999).'.'.$extension; // umbenennen

                Input::file('image')->move($destinationPath, $fileName); 

                Session::flash('success', 'Upload successfully'); 
                return Redirect::to('upload');
            }
            else 
            {
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('upload');
            }
        }
    }
}