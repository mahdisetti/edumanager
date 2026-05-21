<?php
class Comment extends Model {
    public function latest(): array {return $this->db->query('SELECT c.*, CONCAT(s.first_name," ",s.last_name) student_name FROM comments c JOIN students s ON s.id=c.student_id ORDER BY c.id DESC LIMIT 8')->fetchAll();}
    public function create(array $d): bool {return $this->db->prepare('INSERT INTO comments(student_id,content,type) VALUES(:student_id,:content,:type)')->execute($d);}
}
