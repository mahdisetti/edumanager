<?php

class Booking extends Model
{
    /**
     * Get all bookings with student and service info
     */
    public function all(): array
    {
        $sql = "
            SELECT
                b.*,
                CONCAT(s.first_name, ' ', s.last_name) AS student_name,
                sv.name AS service_name
            FROM bookings b
            JOIN students s ON s.id = b.student_id
            JOIN services sv ON sv.id = b.service_id
            ORDER BY b.id DESC
        ";

        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Create a new booking
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO bookings (
                student_id,
                service_id,
                booking_date,
                status,
                comment
            ) VALUES (
                :student_id,
                :service_id,
                :booking_date,
                :status,
                :comment
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':student_id'   => $data['student_id'],
            ':service_id'   => $data['service_id'],
            ':booking_date' => $data['booking_date'],
            ':status'       => $data['status'],
            ':comment'      => $data['comment'] ?? null
        ]);
    }

    /**
     * Update booking status
     */
    public function updateStatus(int $id, string $status): bool
    {
        $sql = "
            UPDATE bookings
            SET status = :status
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id'     => $id,
            ':status'  => $status
        ]);
    }

    /**
     * Delete booking
     */
    public function delete(int $id): bool
    {
        $sql = "
            DELETE FROM bookings
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    /**
     * Count active bookings
     */
    public function countActive(): int
    {
        $sql = "
            SELECT COUNT(*) AS c
            FROM bookings
            WHERE status IN ('Pending', 'Confirmed')
        ";

        return (int) $this->db->query($sql)->fetch()['c'];
    }
}