<?php
class AuthController extends Controller {
    public function login(): void {
        if ($this->isPost()) {
            $email = trim($_POST['email'] ?? ''); $password = $_POST['password'] ?? '';
            $user = (new User())->findByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                unset($user['password']); Auth::login($user); $this->redirect('dashboard');
            }
            $error = 'Invalid email or password.';
        }
        require __DIR__ . '/../Views/auth/login.php';
    }
    public function logout(): void { Auth::logout(); header('Location: index.php?route=login'); }
}
