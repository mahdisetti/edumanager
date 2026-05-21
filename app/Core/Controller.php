<?php

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/layouts/sidebar.php';
        require __DIR__ . '/../Views/' . $view . '.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    protected function redirect(string $route): void
    {
        header('Location: index.php?route=' . $route);
        exit;
    }

    protected function requireAuth(): void
    {
        if (empty($_SESSION['user'])) {
            header('Location: index.php?route=login');
            exit;
        }
    }

    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}