<?php
class ApiController extends Controller {
    public function stats(): void {
        $this->requireAuth(); header('Content-Type: application/json');
        echo json_encode(['students'=>(new Student())->counts(),'services'=>(new Service())->counts(),'bookings'=>(new Booking())->countActive(),'months'=>['Sep','Oct','Nov','Dec','Jan','Feb'],'enrollments'=>[300,410,520,680,620,740]]);
    }
    public function students(): void { $this->requireAuth(); header('Content-Type: application/json'); echo json_encode((new Student())->all($_GET['q']??'')); }
}
