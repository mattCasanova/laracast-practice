<?php 

namespace App\Controllers;
use App\Core\App;

class UsersController {
    public function index() {
        $users = App::get('database')->selectAll('names', 'User');
        return view('users', ['users' => $users]);
    }

    public function store() {
        App::get('database')->insert('names', [
            'name' => $_POST['name']
        ]);
        
        return redirect('users');    
    }
}

?>