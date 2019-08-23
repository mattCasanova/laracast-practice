@extends('layouts.app')

@section('content')
    @include('projects.form', [
        'project' => new App\Project(), 
        'title' => 'Create Your Project',
        'action' => '/projects',
        'method' => 'POST',
        'buttonText' => "Create Project"
    ])
@endsection