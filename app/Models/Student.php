<?php

class Student extends Model
{
    public function all(string $query = ''): array
    {
        if (!empty($query)) {
            $sql = "
                SELECT *
                FROM students
                WHERE first_name LIKE :query
                   OR last_name LIKE :query
                   OR email LIKE :query
                   OR class_name LIKE :query
                ORDER BY id DESC
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':query' => "%{$query}%"
            ]);

            return $stmt->fetchAll();
        }

        $sql = "SELECT * FROM students ORDER BY id DESC";

        return $this->db->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $sql = "SELECT * FROM students WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO students (
                student_code,
                first_name,
                last_name,
                email,
                phone,
                class_name,
                status,
                avatar
            ) VALUES (
                :student_code,
                :first_name,
                :last_name,
                :email,
                :phone,
                :class_name,
                :status,
                :avatar
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':student_code' => $data['student_code'],
            ':first_name'   => $data['first_name'],
            ':last_name'    => $data['last_name'],
            ':email'        => $data['email'],
            ':phone'        => $data['phone'],
            ':class_name'   => $data['class_name'],
            ':status'       => $data['status'],
            ':avatar'       => $data['avatar']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE students
            SET
                student_code = :student_code,
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                phone = :phone,
                class_name = :class_name,
                status = :status,
                avatar = :avatar
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id'           => $id,
            ':student_code' => $data['student_code'],
            ':first_name'   => $data['first_name'],
            ':last_name'    => $data['last_name'],
            ':email'        => $data['email'],
            ':phone'        => $data['phone'],
            ':class_name'   => $data['class_name'],
            ':status'       => $data['status'],
            ':avatar'       => $data['avatar']
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM students WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    public function counts(): array
    {
        return [
            'total' => (int) $this->db
                ->query("SELECT COUNT(*) AS count FROM students")
                ->fetch()['count'],

            'active' => (int) $this->db
                ->query("SELECT COUNT(*) AS count FROM students WHERE status = 'Active'")
                ->fetch()['count'],

            'pending' => (int) $this->db
                ->query("SELECT COUNT(*) AS count FROM students WHERE status = 'Pending'")
                ->fetch()['count'],

            'risk' => (int) $this->db
                ->query("
                    SELECT COUNT(*) AS count
                    FROM students
                    WHERE status = 'At Risk'
                       OR status = 'Suspended'
                ")
                ->fetch()['count']
        ];
    }
}