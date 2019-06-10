<?php 

return [
    'database' => [
        'name' => 'globe_bank',
        'user' => 'webuser',
        'password' => 'password',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ] 

];


?>