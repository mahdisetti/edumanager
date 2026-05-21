<?php

class Upload extends Model
{
    public function saveMeta(array $data): bool
    {
        $sql = "
            INSERT INTO uploads (
                file_name,
                file_path,
                mime_type,
                size,
                entity_type,
                entity_id
            ) VALUES (
                :file_name,
                :file_path,
                :mime_type,
                :size,
                :entity_type,
                :entity_id
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':file_name'   => $data['file_name'],
            ':file_path'   => $data['file_path'],
            ':mime_type'   => $data['mime_type'],
            ':size'        => $data['size'],
            ':entity_type' => $data['entity_type'],
            ':entity_id'   => $data['entity_id']
        ]);
    }
}