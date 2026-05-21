<?php
class Service extends Model {
    public function all(string $q=''): array {
        if($q){$s=$this->db->prepare('SELECT * FROM services WHERE name LIKE :q OR category LIKE :q ORDER BY id DESC');$s->execute(['q'=>"%$q%"]);return $s->fetchAll();}
        return $this->db->query('SELECT * FROM services ORDER BY id DESC')->fetchAll();
    }
    public function find(int $id): ?array { $s=$this->db->prepare('SELECT * FROM services WHERE id=:id');$s->execute(['id'=>$id]);return $s->fetch() ?: null; }
    public function create(array $d): bool {
        return $this->db->prepare('INSERT INTO services(service_code,name,category,price,description,status,image) VALUES(:service_code,:name,:category,:price,:description,:status,:image)')->execute($d);
    }
    public function update(int $id,array $d): bool {$d['id']=$id;return $this->db->prepare('UPDATE services SET service_code=:service_code,name=:name,category=:category,price=:price,description=:description,status=:status,image=:image WHERE id=:id')->execute($d);}
    public function delete(int $id): bool {return $this->db->prepare('DELETE FROM services WHERE id=:id')->execute(['id'=>$id]);}
    public function counts(): array {return ['total'=>(int)$this->db->query('SELECT COUNT(*) c FROM services')->fetch()['c'],'active'=>(int)$this->db->query("SELECT COUNT(*) c FROM services WHERE status='Active'")->fetch()['c'],'pending'=>(int)$this->db->query("SELECT COUNT(*) c FROM services WHERE status='Pending'")->fetch()['c']];}
}
