@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $post->title }}</div>

                    <div class="card-body">
                        @if($post->url != "")
                            <div class="mb-2">
                                <a href="{{ $post->url }}" target="_blank">{{ $post->url }}</a>
                            </div>
                        @endif
                        {{ $post->text }}

                        @auth
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
            </div>
        </div>
    </div>
@endsection

