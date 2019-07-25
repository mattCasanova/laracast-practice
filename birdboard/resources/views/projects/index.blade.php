<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>


    <body>
        <h1>Birdboard</h1>

        <ul>
            @forelse ($projects as $project)
                <li><a href="/projects/{{ $project->id }}" >{{ $project->title }}</a></li>

            @empty
                <li>No Projects Yet.</li>
            @endforelse
        </ul>

    </body>
</html>
