<?php
class Student extends Model {
    public function all(string $q = ''): array {
        if ($q) {
            $stmt = $this->db->prepare('SELECT * FROM students WHERE first_name LIKE :q OR last_name LIKE :q OR email LIKE :q OR class_name LIKE :q ORDER BY id DESC');
            $stmt->execute(['q' => "%$q%"]); return $stmt->fetchAll();
        }
        return $this->db->query('SELECT * FROM students ORDER BY id DESC')->fetchAll();
    }
    public function find(int $id): ?array { $s=$this->db->prepare('SELECT * FROM students WHERE id=:id'); $s->execute(['id'=>$id]); return $s->fetch() ?: null; }
    public function create(array $d): bool {
        $sql='INSERT INTO students(student_code,first_name,last_name,email,phone,class_name,status,avatar) VALUES(:student_code,:first_name,:last_name,:email,:phone,:class_name,:status,:avatar)';
        return $this->db->prepare($sql)->execute($d);
    }
    public function update(int $id, array $d): bool {
        $d['id']=$id;
        $sql='UPDATE students SET student_code=:student_code, first_name=:first_name, last_name=:last_name, email=:email, phone=:phone, class_name=:class_name, status=:status, avatar=:avatar WHERE id=:id';
        return $this->db->prepare($sql)->execute($d);
    }
    public function delete(int $id): bool { return $this->db->prepare('DELETE FROM students WHERE id=:id')->execute(['id'=>$id]); }
    public function counts(): array {
        return [
            'total'=>(int)$this->db->query('SELECT COUNT(*) c FROM students')->fetch()['c'],
            'active'=>(int)$this->db->query("SELECT COUNT(*) c FROM students WHERE status='Active'")->fetch()['c'],
            'pending'=>(int)$this->db->query("SELECT COUNT(*) c FROM students WHERE status='Pending'")->fetch()['c'],
            'risk'=>(int)$this->db->query("SELECT COUNT(*) c FROM students WHERE status='At Risk' OR status='Suspended'")->fetch()['c']
        ];
    }
}
