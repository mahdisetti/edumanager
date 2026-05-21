<?php

class User extends Model
{
    public int $id;
    public string $name;
    public string $email;
    public string $role;

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?array
    {
        $sql = "
            SELECT *
            FROM users
            WHERE email = :email
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch() ?: null;
    }

    /**
     * Create a new user
     */
    public function create(
        string $name,
        string $email,
        string $password,
        string $role = 'admin'
    ): bool {
        $sql = "
            INSERT INTO users (
                name,
                email,
                password,
                role
            ) VALUES (
                :name,
                :email,
                :password,
                :role
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':role'     => $role
        ]);
    }
}