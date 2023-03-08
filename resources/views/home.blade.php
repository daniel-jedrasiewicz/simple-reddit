@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('project.posts.title.most_popular_posts') }}</div>

                    <div class="card-body">
                        @foreach($posts as $post)
                            <div class="row">
                                @livewire('post-votes', ['post' => $post])
                                <div class="col-11">
                                    <a href="{{ route('communities.posts.show', [$post->community, $post]) }}"
                                       style="text-decoration: none">
                                        <h3>{{ $post->title }}</h3>
                                    </a>
                                    <p>{{ $post->created_at->diffForHumans() }}</p>
                                    <p>{{ \Illuminate\Support\Str::words($post->text, 10) }}</p>
                                </div>
                            </div>
                            <hr/>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
