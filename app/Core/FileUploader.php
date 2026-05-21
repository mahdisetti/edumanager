<?php
class FileUploader {
    public static function upload(string $field, string $entityType, int $entityId = 0): ?string {
        if (empty($_FILES[$field]['name'])) return null;
        $config = require __DIR__ . '/../../config/config.php';
        $file = $_FILES[$field];
        if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > $config['max_upload_size']) return null;
        $allowed = ['image/jpeg','image/png','image/jpg','application/pdf'];
        $mime = mime_content_type($file['tmp_name']); if (!in_array($mime,$allowed,true)) return null;
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $safe = uniqid($entityType . '_', true) . '.' . strtolower($ext);
        $target = $config['upload_dir'] . $safe;
        if (!move_uploaded_file($file['tmp_name'], $target)) return null;
        try {(new Upload())->saveMeta(['file_name'=>$file['name'],'file_path'=>$safe,'mime_type'=>$mime,'size'=>$file['size'],'entity_type'=>$entityType,'entity_id'=>$entityId]);} catch(Throwable $e) {}
        return $safe;
    }
}
