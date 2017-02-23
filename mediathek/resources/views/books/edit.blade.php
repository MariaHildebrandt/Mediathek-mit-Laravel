@extends('main')
@section('title' , '| Edit Blog Post')
@section('content')
<div class ="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1 class="h2">Buch editieren  </h1>		
        </div>  
    </div>
</div>

<div class = "row">
    
   
    {!! Form::model($book , ['route' =>  ['books.update', $book->id ], 'method' => 'PUT', 'files'=>'true']) !!}
    <div class = "col-md-8">
        		
        {{ Html::linkRoute('books.index', 'Alle Bücher anzeigen ', array(), ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}	
        
		<div class="form-group">
            {{Form::label('title', 'Buchtitel: ') }}
            {{Form::text('title', null, array('class' => 'form-control' , 'required' => '', 'maxlength' => '255')) }}
        
           
            {{ Form::label('author', 'Autor') }}
            {{ Form::text('author', null, array('class' => 'form-control' , 'required' => '', 'maxlength' => '255'))}}
        
            {{ Form::label('category', 'Kategorie') }}
            {{ Form::select('category',array('Fantasy' => 'Fantasy', 'Sachbuch' => 'Sachbuch', 'Magazin' => 'Magazin'),null , array('class' => 'form-control')) }}
        
            {{Form::label('description', 'Inhalt: ') }}
            {{Form::textarea('description', null, array('class' => 'form-control' , 'required' => '')) }}
        
            {{ Form::label('description', 'Neues Buchcover hochladen: ') }}
            {!! Form::file('image') !!}
                <p class="errors">{!!$errors->first('image')!!}</p>
                    
	           @if(Session::has('error'))
	               <p class="errors">{!! Session::get('error') !!}</p>
	           @endif
            
        </div>

    </div><!--Ende von col-8-->
        
       
     
    <div class="col-md-4"> 
        <div class = "well">
           <?php
                $book_image_id = $book->image_id;
                $image = DB::table('images')->where('image_id',$book_image_id )->get(array('filename'));
                $array = json_decode($image, true);
                $filename= $array[0]["filename"];

                $img = "images/". $filename;
               
            ?>
            {{Html::image($img, $alt="image", $attributes = array('width'=>'100%', 'height'=>'100%')) }}
            
            <dl class="dl-horizontal">
				<label>Created At:</label>
				<p>{{ date('M j, Y h:ia', strtotime($book->created_at)) }}</p>
            </dl>

            <dl class="dl-horizontal">
				<label>Last Updated:</label>
				<p>{{ date('M j, Y h:ia', strtotime($book->updated_at)) }}</p>
            </dl>				
        </div><!-- ende well -->
    </div><!--ende col 4-->
       
</div> <!--Ende von row-->



<div class="row">
    <div class="col-md-4">
         {{ Html::linkRoute('books.show', 'Cancel', array($book->id), array('class' => 'btn btn-danger btn-block'))}} 
    </div><!-- ende col 4 --> 
        
    <div class="col-md-4">
        {{Form::submit('Save Changes', ['class' => 'btn btn-success btn-block'])}}
        {!! Form::close()!!}
    </div>
    
    <div class="col-md-4"></div><!-- ende col 4 : offset-->
</div><!-- ende row --> 

@stop