<?php

abstract class Model
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    protected function paginate(
        string $sql,
        array $params = [],
        int $limit = 10,
        int $offset = 0
    ): array {
        $stmt = $this->db->prepare($sql . ' LIMIT :limit OFFSET :offset');

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}