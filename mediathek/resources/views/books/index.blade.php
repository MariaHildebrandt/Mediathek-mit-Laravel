@extends('main')
@section('title', '| All Posts')

@section('content')

            
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h2 class="h2">Alle Bücher</h2> 
            <a href = "{{ route('books.create')}}" class = "btn btn-m btn-primary">Neues Buch eintragen</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @foreach ($books as $book) 
            <div class="col-md-2">    
                <p>{{$book->title}}</p>
                <p>{{$book->author}}</p>		
                 
                <?php
                $book_image_id = $book->image_id;
                $image = DB::table('images')->where('image_id',$book_image_id )->get(array('filename'));
                $array = json_decode($image, true);
                $filename= $array[0]["filename"];

                    $img = "images/". $filename;
                ?>
                    <a href="{{url('books/'.$book->id)}}">
                        {{Html::image($img, $alt="image", $attributes = array('width'=>'90%', 'height'=>'90%')) }}
                    </a>
            
                
           <!--buch bild soll als link angezeigt werden-->
                <a href="{{ url('books/'.$book->id)}}"> buch anzeigen</a>
                
                <!--------modal test --------------------->
                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm
                                             " data-toggle="modal" data-target="#myModal">
                  Launch demo modal
                </button>
                
                <!-- Modal -->
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Modal title</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-4 col-md-offset-4">Inhalt</div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                
                <!--------modal test Ende ----------------->
            </div> 
        @endforeach
    </div>
</div> 
                
<div class="row">
    <div class="col-md-12">
        <div class ="text-center">
            {!! $books->links() !!}
        </div> <!--Pagination-->   
    </div> 
</div> 





@stop