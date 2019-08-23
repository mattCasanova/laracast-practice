@extends('layouts.app')

@section('content')
    @include('projects.form', [
        'title' => 'Edit Your Project',
        'action' => $project->path(),
        'method' => 'PATCH',
        'buttonText' => "Update Project"
    ])
@endsection