@extends('layout')

@section('content')    
<h1 class="title">Create New Project</h1>

<form method="POST" action="/projects" style="margin-bottom: 1em">
    @csrf
    <div class="field">
        <label class="lable" for="title">Title</label>

        <div class="control">
            <input type="text" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" name="title" placeholder="Title" required>
        </div>
    </div>

    <div class="field">
        <label class="lable" for="description">Description</label>

        <div class="control">
            <textarea name="description" class="textarea {{ $errors->has('title') ? 'is-danger' : '' }}" required></textarea>
        </div>
    </div>

    <div class="field">
    
        <div class="control">
            <button type="submit" class="button is-link">Create Project</button>
        </div>
    </div>

    @if ($errors->any())
        <div class="notification is-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
@endsection