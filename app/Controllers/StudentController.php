<?php
class StudentController extends Controller {
    private Student $model;
    public function __construct(){ $this->model = new Student(); }
    public function index(): void { $this->requireAuth(); $q=$_GET['q']??''; $this->view('students/index',['title'=>'Students','active'=>'students','students'=>$this->model->all($q),'counts'=>$this->model->counts(),'q'=>$q]); }
    public function store(): void { $this->requireAuth(); if(!$this->isPost()) $this->redirect('students'); $avatar = $this->upload('avatar','student',0); $data=$this->studentData($avatar); $this->model->create($data); $this->redirect('students'); }
    public function update(): void { $this->requireAuth(); $id=(int)($_POST['id']??0); $old=$this->model->find($id); $avatar=$old['avatar']??null; if(!empty($_FILES['avatar']['name'])) $avatar=$this->upload('avatar','student',$id); $this->model->update($id,$this->studentData($avatar)); $this->redirect('students'); }
    public function delete(): void { $this->requireAuth(); $this->model->delete((int)($_GET['id']??0)); $this->redirect('students'); }
    private function studentData(?string $avatar): array { return ['student_code'=>$_POST['student_code']?:('ST-'.rand(1000,9999)),'first_name'=>trim($_POST['first_name']??''),'last_name'=>trim($_POST['last_name']??''),'email'=>trim($_POST['email']??''),'phone'=>trim($_POST['phone']??''),'class_name'=>trim($_POST['class_name']??''),'status'=>$_POST['status']??'Active','avatar'=>$avatar]; }
    private function upload(string $field,string $entity,int $id): ?string { return FileUploader::upload($field,$entity,$id); }
}
