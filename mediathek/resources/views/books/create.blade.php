@extends('main')

@section('title', '| Neues Buch eintragen')

@section('content')
<div class="row">
    <div class = "col-md-8 color-md-offset-2" >
        <h1>Neues Buch eintragen</h1>
        <hr>
        
        {!! Form::open(['route' => 'books.store' ,'method'=>'POST', 'files'=>'true']) !!}
        
            {{ Form::label('title', 'Buchtitel: ') }}
            {{ Form::text('title', null, array('class' => 'form-control' , 'required' => '', 'maxlength' => '255')) }}
        
           
            {{ Form::label('author', 'Autor:') }}
            {{ Form::text('author', null, array('class' => 'form-control' , 'required' => '', 'maxlength' => '255'))}}
        
            {{ Form::label('category', 'Kategorie:') }}
            {{ Form::select('category', array('Fantasy' => 'Fantasy', 'Sachbuch' => 'Sachbuch', 'Magazin' => 'Magazin'),null , array('class' => 'form-control','required' => '')) }}
        
            {{ Form::label('description', 'Inhalt: ') }}
            {{ Form::textarea('description', null, array('class' => 'form-control' , 'required' => '')) }}
        
        <!--vn hier urpsrünglichen image selector genommen-->
            
             <!--image upload-->
            <div class="control-group">
                <div class="controls">
                     {{ Form::label('description', 'Buchcover: ') }}
                    {!! Form::file('image') !!}
                    <p class="errors">{!!$errors->first('image')!!}</p>
                    
	               @if(Session::has('error'))
	               <p class="errors">{!! Session::get('error') !!}</p>
	               @endif
                    
                </div>
            </div>
           
       

        
            {{Form::submit('Buch speichern', array('class' => 'btn btn-success btn-lg btn-block')) }}
        
       
        
        {!! Form::close() !!}
    </div>
</div>

@endsection