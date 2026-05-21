<?php
class Presence extends Model {
    public function all(): array {return $this->db->query('SELECT p.*, CONCAT(s.first_name," ",s.last_name) student_name FROM presences p JOIN students s ON s.id=p.student_id ORDER BY p.presence_date DESC')->fetchAll();}
    public function create(array $d): bool {return $this->db->prepare('INSERT INTO presences(student_id,presence_date,status,note) VALUES(:student_id,:presence_date,:status,:note)')->execute($d);}
    public function delete(int $id): bool {return $this->db->prepare('DELETE FROM presences WHERE id=:id')->execute(['id'=>$id]);}
}
