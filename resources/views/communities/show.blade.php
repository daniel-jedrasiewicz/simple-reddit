@extends('layouts.app')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px);
        }

        .votes {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $community->name }}</div>

                    <div class="card-body">
                        <a href="{{ route('communities.posts.create', $community) }}"
                           class="btn btn-dark">{{ __('project.community.title.add_post') }}</a>
                        <br/><br/>
                        @forelse($posts as $post)
                            <div class="row">
                                @livewire('post-votes', ['post' => $post])
                                <div class="col-11">
                                    <a href="{{ route('communities.posts.show', [$community, $post]) }}"
                                       style="text-decoration: none">
                                        <h3>{{ $post->title }}</h3>
                                    </a>
                                    <p>{{ \Illuminate\Support\Str::words($post->text, 10) }}</p>
                                </div>
                            </div>
                            <hr/>
                        @empty
                            <h5>{{ __('global.no_results') }}</h5>
                        @endforelse
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
