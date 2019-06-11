<!DOCTYPE html>

<html>
    <head>
        <title></title>
    </head>

    <body>
        <h1>Projects</h1>

        @foreach ($projects as $project)
            
            <h2>Title: {{$project->title}}</h2>
            <p>Description: {{$project->description}}</p>
       
            
        @endforeach

    </body>


</html>