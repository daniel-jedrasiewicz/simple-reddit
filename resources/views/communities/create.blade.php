@extends('layouts.app')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px);
        }
    </style>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">{{ __('project.community.title.new_community') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('communities.store') }}">
                @csrf

                <div class="row mb-3">
                    <label for="name"
                           class="col-md-4 col-form-label text-md-end">{{ __('project.community.fields.name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for=""
                           class="col-md-4 col-form-label text-md-end">{{ __('project.community.fields.description') }}</label>

                    <div class="col-md-6">
                                <textarea id="description"
                                          class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                          name="description">{{ old('description', '') }}</textarea>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for=""
                           class="col-md-4 col-form-label text-md-end">{{ __('project.community.fields.topics') }}</label>

                    <div class="col-md-6">
                        <select class="select2" name="topics[]" style="width: 100%;" multiple>
                            @foreach($topics as $topic)
                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                            @endforeach
                        </select>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">{{ __('global.save') }}</button>
                        <a href="{{ route('communities.index') }}" class="btn btn-light">{{ __('global.cancel') }}</a>
                    </div>
                </div>
            </form>
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
