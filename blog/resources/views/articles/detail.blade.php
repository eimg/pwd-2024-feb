@extends("layouts.app")
@section("content")
    <div class="container" style="max-width:800px">

        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        <div class="card mb-2 border-primary">
            <div class="card-body">
                <h3 class="h3 card-title">{{ $article->title }}</h3>
                <div>
                    <b class="text-success">{{ $article->user->name }}</b>,

                    <small class="text-muted">
                        <b>Category:</b> {{ $article->category->name }},
                        {{ $article->created_at->diffForHumans() }}
                    </small>
                </div>
                <div style="font-size: 1.1em">
                    {{ $article->body }}
                </div>
                @auth
                    @can('delete-article', $article)
                        <div class="mt-2">
                            <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-sm btn-outline-danger">Delete</a>

                            <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        </div>
                    @endcan
                @endauth
            </div>
        </div>

        <ul class="list-group mt-4 mb-2">
            <li class="list-group-item active">
                Comments ({{ count($article->comments) }})
            </li>
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    @auth
                        @can('delete-comment', $comment)
                            <a href="{{ url("/comments/delete/$comment->id") }}"    class="btn-close float-end"></a>
                        @endcan
                    @endauth

                    <b class="text-success">{{ $comment->user->name }}</b> - 
                    {{ $comment->content }}
                </li>
            @endforeach
        </ul>
        @auth
            <form action="{{ url("/comments/add") }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control mb-2"></textarea>
                <button class="btn btn-secondary">Add Comment</button>
            </form>
        @endauth
    </div>
@endsection