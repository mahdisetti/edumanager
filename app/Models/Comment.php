<?php

class Comment extends Model
{
    /**
     * Get latest comments with student name
     */
    public function latest(): array
    {
        $sql = "
            SELECT
                c.*,
                CONCAT(s.first_name, ' ', s.last_name) AS student_name
            FROM comments c
            JOIN students s ON s.id = c.student_id
            ORDER BY c.id DESC
            LIMIT 8
        ";

        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Create a new comment
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO comments (
                student_id,
                content,
                type
            ) VALUES (
                :student_id,
                :content,
                :type
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':student_id' => $data['student_id'],
            ':content'    => $data['content'],
            ':type'       => $data['type']
        ]);
    }
}