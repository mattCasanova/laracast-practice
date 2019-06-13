@extends('layout')

@section('content')
    <h1 class="title">Projects</h1>
    <p>
        <a href="/projects/create">Create New Project</a>
        
    </p>
    </br>
    </br>

    <ul class="list">
        @foreach ($projects as $project)
    
            <li>
                <a href="/projects/{{ $project->id }}">
                    {{$project->title}}
                </a>
            </li>    
        @endforeach
    </ul>
@endsection
