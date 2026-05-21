<?php
class PresenceController extends Controller {
    public function index(): void { $this->requireAuth(); $this->view('presence/index',['title'=>'Presence','active'=>'presence','presences'=>(new Presence())->all(),'students'=>(new Student())->all()]); }
    public function store(): void { $this->requireAuth(); (new Presence())->create(['student_id'=>(int)$_POST['student_id'],'presence_date'=>$_POST['presence_date'],'status'=>$_POST['status'],'note'=>trim($_POST['note']??'')]); $this->redirect('presence'); }
    public function delete(): void { $this->requireAuth(); (new Presence())->delete((int)$_GET['id']); $this->redirect('presence'); }
}
