<?php
class Auth {
    public static function user(): ?array { return $_SESSION['user'] ?? null; }
    public static function check(): bool { return !empty($_SESSION['user']); }
    public static function login(array $user): void { $_SESSION['user'] = $user; }
    public static function logout(): void { session_destroy(); }
}
