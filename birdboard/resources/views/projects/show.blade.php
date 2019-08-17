@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-3">
        <div class="flex justify-between w-full items-end">

            <p class="text-grey text-sm font-normal">
                <a href="/projects" class="text-grey text-sm font-normal no-underline">My Projects</a> / {{ $project->title }}
            </p>

            <a class="button" href="/projects/create">New Proejct</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">

            <div class="lg:w-3/4 px-3  mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>
                    
                    {{-- tasks --}}
                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">{{ $task->body }}</div>
                    @endforeach

                </div>

                <div>
                    {{-- General Notes --}}
                    <h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>
                    <textarea class="card w-full" style="min-height: 200px">Lorem ipsum.</textarea>
                </div>
      
            </div>

            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>

        </div>
    </main>
@endsection