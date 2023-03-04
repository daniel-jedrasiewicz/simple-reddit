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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('project.community.title.my_communities') }}</div>

                    <div class="card-body">

                        <div>
{{--                            <a href="{{ route('communities.create') }}" class="btn btn-warning" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">{{ __('Filtrowanie') }}</a>--}}
                            <a href="{{ route('communities.create') }}" class="btn btn-dark">{{ __('project.community.title.add_community') }}</a>
                        </div>
                        <br />
                        <x-alerts.success/>
                        <br />
                        <table class="table table-responsive">
                            <thead class="thead-dark">
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th>{{ __('project.community.columns.name') }}</th>
                                <th>{{ __('project.community.columns.description') }}</th>
                                <th style="width: 20%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($communities as $community)
                                <tr>
                                    <td> {{ $community->id }} </td>
                                    <td> {{ $community->name }} </td>
                                    <td> {{ $community->description}} </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm"
                                           href="{{ route('communities.edit', $community) }}">
                                            <i class="fa-solid fa-pen-to-square"></i> {{ __('global.edit') }}
                                        </a>
                                        <a class="btn btn-success btn-sm"
                                           href="{{ route('communities.show', $community) }}">
                                            <i class="fa-solid fa-circle-info"></i>{{ __('global.details') }}
                                        </a>
                                        <form class="d-inline" method="POST"
                                              action="{{ route('communities.destroy', $community) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="fa-solid fa-trash-can"></i>{{ __('global.delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3">
                                        <h5>{{ __('global.no_results') }}</h5>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
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
