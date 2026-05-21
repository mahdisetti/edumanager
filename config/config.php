<?php
return [
    'app_name' => 'EduManager',
    'base_url' => 'http://localhost/edumanager/public',
    'db' => [
        'host' => '127.0.0.1',
        'name' => 'edumanager_db',
        'user' => 'root',
        'pass' => '',
        'charset' => 'utf8mb4'
    ],
    'upload_dir' => __DIR__ . '/../public/uploads/',
    'max_upload_size' => 10 * 1024 * 1024
];
