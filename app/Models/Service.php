<?php

class Service extends Model
{
    /**
     * Get all services
     */
    public function all(string $q = ''): array
    {
        if (!empty($q)) {
            $sql = "
                SELECT *
                FROM services
                WHERE name LIKE :q
                   OR category LIKE :q
                ORDER BY id DESC
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':q' => "%{$q}%"
            ]);

            return $stmt->fetchAll();
        }

        $sql = "
            SELECT *
            FROM services
            ORDER BY id DESC
        ";

        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Find service by ID
     */
    public function find(int $id): ?array
    {
        $sql = "
            SELECT *
            FROM services
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch() ?: null;
    }

    /**
     * Create a new service
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO services (
                service_code,
                name,
                category,
                price,
                description,
                status,
                image
            ) VALUES (
                :service_code,
                :name,
                :category,
                :price,
                :description,
                :status,
                :image
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':service_code' => $data['service_code'],
            ':name'         => $data['name'],
            ':category'     => $data['category'],
            ':price'        => $data['price'],
            ':description'  => $data['description'],
            ':status'       => $data['status'],
            ':image'        => $data['image']
        ]);
    }

    /**
     * Update a service
     */
    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE services
            SET
                service_code = :service_code,
                name = :name,
                category = :category,
                price = :price,
                description = :description,
                status = :status,
                image = :image
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id'           => $id,
            ':service_code' => $data['service_code'],
            ':name'         => $data['name'],
            ':category'     => $data['category'],
            ':price'        => $data['price'],
            ':description'  => $data['description'],
            ':status'       => $data['status'],
            ':image'        => $data['image']
        ]);
    }

    /**
     * Delete a service
     */
    public function delete(int $id): bool
    {
        $sql = "
            DELETE FROM services
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    /**
     * Get service statistics
     */
    public function counts(): array
    {
        $total = $this->db
            ->query("SELECT COUNT(*) AS c FROM services")
            ->fetch()['c'];

        $active = $this->db
            ->query("SELECT COUNT(*) AS c FROM services WHERE status = 'Active'")
            ->fetch()['c'];

        $pending = $this->db
            ->query("SELECT COUNT(*) AS c FROM services WHERE status = 'Pending'")
            ->fetch()['c'];

        return [
            'total'   => (int) $total,
            'active'  => (int) $active,
            'pending' => (int) $pending
        ];
    }
}