@extends('main')
@section('title', '| All Posts')

@section('content')

    <div class = "row">
        <div class = "col-md-10">
            <h1>Alle Bücher</h1>
        </div>
        <div class = "col-md-2">
            <a href = "{{ route('books.create')}}" class = "btn btn-l btn-block btn-primary btn-h1-spacing">Neues Buch eintragen</a>
        </div>
        <div class = "col-md-12">
            <hr>
            <!--spacing between all posts and copyritgh-->
        </div>
    </div><!--end of row-->

    <div class = "row">
        <div class = "col-md-10">
            <table class = "table">
                <thead>
                    <!--headlines-->
                    <th>#</th>
                    <th>Buchtitel</th>
                    <th>Autor</th>
                    <th>Kategorie</th>
                    <th>Inhalt</th>
                    <th><!--columns for buttons--></th>
                </thead>
                <tbody>
                    <!--Lopp for all objects-->
                    @foreach ($books as $book) <!--übergeben in index.blade.php-->
                        <tr>
                            <!-- $posts wurden durch PostsController übergeben-->
                            <th>{{$book->id}}</th>
                            <td>{{$book->title}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->category}}</td>
                            <td>{{substr($book->description, 0,50)}}
                                {{strlen($book->description) > 50 ? "..." : ""}}</td> <!--wenn body länger als 50 characters dann ein ... ans ende hängen-->
                            <td>{{date('d.m.Y - h:i', strtotime($book->created_at))}}</td>
                            <td><a href = "{{route('books.show', $book->id)}}" class = "btn btn-default btn-sm">View</a><a href = "{{route('books.edit', $book->id)}}" class = "btn btn-default btn-sm">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class ="text-center">
                {!! $books->links() !!}
            </div> <!--Pagination-->
        </div>
     </div>

@stop