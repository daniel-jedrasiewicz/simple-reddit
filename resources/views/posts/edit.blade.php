@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $community->name }}: {{ __('project.posts.title.edit_post') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('communities.posts.update', [$community, $post]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('project.posts.fields.title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{ $post->title }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-form-label text-md-end">{{ __('project.posts.fields.text') }}</label>
                            <div class="col-md-6">
                                <textarea rows="10" id="text" class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}"
                                          name="text">{{ $post->text }}</textarea>
                                @error('text')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="url" class="col-md-4 col-form-label text-md-end">{{ __('project.posts.fields.url') }}</label>
                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" name="url" value="{{ $post->url }}">
                                @error('url')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('project.posts.fields.image') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end"></label>
                            <div class="col-md-6">
                                @if($post->image)
                                    <img src="{{ $post->image->getFullUrl('thumb_300_200') }}"
                                         alt="{{ $post->name }}"/>
                                    <br><br>
                                @else
                                    <img src="https://via.placeholder.com/300x200.png?text=300x200">
                                    <br><br>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">{{ __('global.save') }}</button>
                                <a href="{{ route('communities.posts.show', [$community, $post]) }}" class="btn btn-light">{{ __('global.cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

