<?php 


use App\Core\App;

App::bind('config', require 'config.php');

App::bind(
    'database', 
    new QueryBuilder(Connection::make(App::get('config')['database']))
);


function view(string $name, $args = []) {
    extract($args);
    return require "app/views/{$name}.view.php";
}

function redirect(string $path) {
    header("Location: /{$path}");
}

?>
