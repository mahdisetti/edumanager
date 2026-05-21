<?php
class User extends Model {
    public int $id; public string $name; public string $email; public string $role;
    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ?: null;
    }
    public function create(string $name, string $email, string $password, string $role = 'admin'): bool {
        $stmt = $this->db->prepare('INSERT INTO users(name,email,password,role) VALUES(:name,:email,:password,:role)');
        return $stmt->execute(['name'=>$name,'email'=>$email,'password'=>password_hash($password, PASSWORD_DEFAULT),'role'=>$role]);
    }
}
