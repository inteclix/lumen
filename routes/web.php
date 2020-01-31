<?php


$router->get('/', function () {
    return response()->json([
        'app' => 'school',
        'description' => 'school system'
    ]);
});
