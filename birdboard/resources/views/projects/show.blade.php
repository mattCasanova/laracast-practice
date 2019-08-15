@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-3">
        <div class="flex justify-between w-full items-end">
            <h2 class="text-grey text-sm font-normal">My Projects</h2>
            <a class="button" href="/projects/create">New Proejct</a>
        </div>
    </header>

    <main>
        <div class="flex">
            <div>
                <h2 class="text-grey text-sm font-normal">Tasks</h2>
                {{-- tasks --}}

                <h2 class="text-grey text-sm font-normal">General Notes</h2>
                
                {{-- General Notes --}}
                <div class="card">Lorem ipsum.</div>
            </div>

            <div>
                <div class="card">
                    <h1>{{ $project->title}}</h1>
                    <div>{{ $project->description }}</div>
                    <a href="/projects">Go Back</a>
                </div>
            </div>
        </div>
    </main>
@endsection
