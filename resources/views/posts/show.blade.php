@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ $post->title }}</div>
        <div class="card-body">
            @if($post->image)
                <img src="{{ $post->image->getFullUrl('thumb_600_300') }}"
                     alt="{{ $post->name }}"/>
                <br><br>
            @else
                <img src="https://via.placeholder.com/600x300.png?text=600x300">
                <br><br>
            @endif

            @if($post->url != "")
                <div class="mb-2">
                    <a href="{{ $post->url }}" target="_blank">{{ $post->url }}</a>
                </div>
            @endif

            {{ $post->text }}

            @auth
                <hr/>
                <h3>{{ __('project.posts.columns.comments') }}:</h3>
                @forelse($post->comments as $comment)
                    <b> {{ $comment->user->name }}</b>
                    <br/>
                    {{ $comment->created_at->diffForHumans() }}
                    <p class="mt-2"> {{ $comment->comment }}</p>
                @empty
                    {{ __('project.posts.fields.no_comments') }}
                @endforelse

                <hr/>
                <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                    @csrf
                    {{ __('project.posts.fields.add_comment') }}
                    <br/>
                    <textarea class="form-control" name="comment" rows="5"></textarea>
                    <br/>
                    <button type="submit"
                            class="btn  btn-sm btn-success">{{ __('Dodaj komentarz') }}
                    </button>
                </form>

                @if($post->user_id == auth()->id())
                    <hr/>
                    <a class="btn btn-primary btn-sm"
                       href="{{ route('communities.posts.edit', [$community, $post]) }}">
                        <i class="fa-solid fa-pen-to-square"></i> {{ __('global.edit') }}
                    </a>

                    <form class="d-inline" method="POST"
                          action="{{ route('communities.posts.destroy', [$community, $post]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">
                            <i class="fa-solid fa-trash-can"></i>{{ __('global.delete') }}
                        </button>
                    </form>
                    <a href="{{ route('communities.show', [$community, $post]) }}"
                       class="btn btn-light">{{ __('global.back') }}</a>
                @endif
            @endauth
        </div>
    </div>
@endsection

