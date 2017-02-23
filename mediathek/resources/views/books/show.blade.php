<?php use Illuminate\Support\Facades\DB; ?>
@extends('main')

@section('title', '| Buch')

@section('content')

<div class ="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1 class="h2">Buchdetails:  </h1>		
        </div>  
    </div>
</div>

<div class="row"><!--row :Buch-Details-->
    <div class="col-sm-8">
        {{ Html::linkRoute('books.index', 'Alle Bücher anzeigen ', array(), ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}

		<!--Tabelle für Buchdetails--->
				
		<table class="table table-inverse">
            <thead>
				<tr>
				    <th>Buchtitel</th>
				    <th>{{$book->title}}</th>
                </tr>
            </thead>
            
            <tbody>
				<tr>
				    <th scope="row">Autor</th>
				    <td>{{$book->author}}</td>
				</tr>
				<tr>
				    <th scope="row">Kategorie</th>
				    <td>{{$book->category}} </td>
				</tr>
				<tr>
				    <th scope="row">Beschreibung</th>
				    <td>{{$book->description}}</td>
				</tr>
						
            </tbody>
        </table>
        
        <!--Ende der Tabelle-->
        <hr>
        
    </div><!--ende col 8-->
    
    <div class="col-md-4"> 
        <div class = "well">
            <?php
                $book_image_id = $book->image_id;
                $image = DB::table('images')->where('image_id',$book_image_id )->get(array('filename'));
                $array = json_decode($image, true);
                $filename= $array[0]["filename"];

                $img = "images/". $filename;
            ?>
            {{Html::image($img, $alt="image", $attributes = array('width'=>'90%', 'height'=>'90%')) }}
            
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
    
</div><!-- ende div row :Buch-Details--> 
    
<div class="row">
    <div class="col-md-4">
        {!! Html::linkRoute('books.edit', 'Edit', array($book->id), array('class' => 'btn btn-primary btn-block')) !!}
    </div><!-- ende col 4 --> 
        
    <div class="col-md-4">
        {!! Form::open(['route' => ['books.destroy', $book->id], 'method' => 'DELETE']) !!}

        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

        
    </div><!-- ende col 4 -->
        {!! Form::close() !!}
     <div class="col-md-4"></div><!-- ende col 4 : offset-->
   
</div><!-- ende row --> 
					
					
					
				
				
				
 



		

				

				

@endsection