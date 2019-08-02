@extends('layouts.app')

@section('content')

    <div class="flex items-center mb-3">
        <a href="/projects/create">New Proejct</a>
    </div>


    <div>
        @forelse ($projects as $project)
            <div class="bg-white">
                <h3>{{ $project->title }}</h3>

                <div>{{ $project->description }}</div>

            </div>
        
        @empty
            <div>No Projects Yet.</div>
        @endforelse
    </div>
@endsection
