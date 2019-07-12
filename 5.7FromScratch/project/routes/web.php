<?php

use Illuminate\Filesystem\Filesystem;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

class Foo {

}

class Example {
    private $foo;

    public function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }

}

Route::get('/', function () {

    dd(app('Example'));

    return view('welcome');
});

Route::resource('projects', 'ProjectsController');

Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
Route::patch('/tasks/{task}', 'ProjectTasksController@update');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
