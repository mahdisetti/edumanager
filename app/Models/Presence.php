<?php

class Presence extends Model
{
    /**
     * Get all presence records with student full name
     */
    public function all(): array
    {
        $sql = "
            SELECT
                p.*,
                CONCAT(s.first_name, ' ', s.last_name) AS student_name
            FROM presences p
            JOIN students s ON s.id = p.student_id
            ORDER BY p.presence_date DESC
        ";

        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Create a new presence record
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO presences (
                student_id,
                presence_date,
                status,
                note
            ) VALUES (
                :student_id,
                :presence_date,
                :status,
                :note
            )
        ";

        return $this->db->prepare($sql)->execute([
            ':student_id'     => $data['student_id'],
            ':presence_date'   => $data['presence_date'],
            ':status'         => $data['status'],
            ':note'           => $data['note']
        ]);
    }

    /**
     * Delete a presence record by ID
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM presences
            WHERE id = :id
        ");

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}