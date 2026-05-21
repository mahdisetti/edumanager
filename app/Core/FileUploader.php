<?php

class FileUploader
{
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/png',
        'image/jpg',
        'application/pdf',
    ];

    public static function upload(string $field, string $entityType, int $entityId = 0): ?string
    {
        if (empty($_FILES[$field]['name'])) {
            return null;
        }

        $config = require __DIR__ . '/../../config/config.php';
        $file = $_FILES[$field];

        if (!self::isValidFile($file, $config['max_upload_size'])) {
            return null;
        }

        $mime = mime_content_type($file['tmp_name']);

        if (!in_array($mime, self::ALLOWED_MIME_TYPES, true)) {
            return null;
        }

        $safe = self::generateFilename($file['name'], $entityType);
        $target = $config['upload_dir'] . $safe;

        if (!move_uploaded_file($file['tmp_name'], $target)) {
            return null;
        }

        self::saveMeta($file, $safe, $mime, $entityType, $entityId);

        return $safe;
    }

    private static function isValidFile(array $file, int $maxSize): bool
    {
        return $file['error'] === UPLOAD_ERR_OK
            && $file['size'] <= $maxSize;
    }

    private static function generateFilename(string $originalName, string $entityType): string
    {
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        return uniqid($entityType . '_', true) . '.' . $ext;
    }

    private static function saveMeta(array $file, string $safeName, string $mime, string $entityType, int $entityId): void
    {
        try {
            (new Upload())->saveMeta([
                'file_name'   => $file['name'],
                'file_path'   => $safeName,
                'mime_type'   => $mime,
                'size'        => $file['size'],
                'entity_type' => $entityType,
                'entity_id'   => $entityId,
            ]);
        } catch (Throwable) {
            // Silently ignore meta save failures
        }
    }
}