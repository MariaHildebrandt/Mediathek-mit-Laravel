@extends('main')

@section('title', '| Home')

@section('stylesheets')
    <link rel = "stylesheets"´type = "text/css" href = "style.css" >
@endsection


@section('content')
    <div id="wrap">
		<div id="main" class="container clear-top">
			<div class= "row">
				<div class="col-md-10 col-md-offset-1">
				
					<div class="page-header">
						<h2 class="h2" style="text-align:center; color: #A9A9A9;">Neueste Bücher</h2> 
					</div>
					
				</div>
            </div><!--Ende row -->
			
			<!--
			-- neueste Bücher
			-->
            <div class= "row" style="padding-top:30px">
				<div class="col-md-10">
                    
                    <div class= "row">
                         @foreach($books as $book)
                        <div class="col-md-2 book">
                            <h6>{{ $book->title}}</h6>
                            <h6>{{ $book->author}}</h6>
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
                            
                            <a href="{{ url('books/'.$book->id)}}" class="btn btn-primary">show book details</a>

                               
					
                        </div>
                        @endforeach
                    </div>
                    
                </div><!--Ende col-10 -->
				
				<div class="col-md-2">
                   
					{{ Html::linkRoute('books.index', 'Alle B&uuml;cher anzeigen', array(), ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                    {{ Html::linkRoute('books.list', 'Liste anzeigen', array(), ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
				</div>
			</div><!-- Ende div row Bücher -->
			
			
			<!--
			-- neueste Filme
			-->
			<div class= "row" style="padding-top:30px">
				<div class="col-md-10">
				    <div class= "row">
                         @foreach($films as $film)
                        <div class="col-md-2 film">
                            <h6>{{ $film->title}}</h6>
                            <h6>{{ $film->director}}</h6>
                            <a href="{{ url('books/'.$book->id)}}" class="btn btn-primary">show film details</a>
                            Bild <br>
                        </div>
                        @endforeach 
                    </div>
								 
			
					
				</div>
                <div class="col-md-2">
                {{ Html::linkRoute('books.index', 'Alle Filme anzeigen', array(), ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
					
				</div>
            </div><!-- Ende div row Filme -->
				
			
		</div> <!--Ende div container -->
	</div> <!--Ende div wrap -->
@endsection
 
@section('scripts')
    <script src="js/scripts.js"></script>
@endsection