<?php
class Upload extends Model {
    public function saveMeta(array $d): bool {return $this->db->prepare('INSERT INTO uploads(file_name,file_path,mime_type,size,entity_type,entity_id) VALUES(:file_name,:file_path,:mime_type,:size,:entity_type,:entity_id)')->execute($d);}
}
