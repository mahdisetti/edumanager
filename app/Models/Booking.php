<?php
class Booking extends Model {
    public function all(): array {return $this->db->query('SELECT b.*, CONCAT(s.first_name," ",s.last_name) student_name, sv.name service_name FROM bookings b JOIN students s ON s.id=b.student_id JOIN services sv ON sv.id=b.service_id ORDER BY b.id DESC')->fetchAll();}
    public function create(array $d): bool {return $this->db->prepare('INSERT INTO bookings(student_id,service_id,booking_date,status,comment) VALUES(:student_id,:service_id,:booking_date,:status,:comment)')->execute($d);}
    public function updateStatus(int $id,string $status): bool {return $this->db->prepare('UPDATE bookings SET status=:status WHERE id=:id')->execute(['id'=>$id,'status'=>$status]);}
    public function delete(int $id): bool {return $this->db->prepare('DELETE FROM bookings WHERE id=:id')->execute(['id'=>$id]);}
    public function countActive(): int {return (int)$this->db->query("SELECT COUNT(*) c FROM bookings WHERE status IN ('Pending','Confirmed')")->fetch()['c'];}
}
