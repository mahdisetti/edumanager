<?php $config=require __DIR__.'/../../../config/config.php'; $user=Auth::user(); ?>
<!doctype html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($title ?? $config['app_name']) ?></title><link rel="stylesheet" href="assets/css/style.css"></head>
<body><div class="app">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
