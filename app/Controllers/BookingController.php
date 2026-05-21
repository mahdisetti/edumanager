<?php
class BookingController extends Controller {
    public function index(): void { $this->requireAuth(); $this->view('bookings/index',['title'=>'Bookings','active'=>'bookings','bookings'=>(new Booking())->all(),'students'=>(new Student())->all(),'services'=>(new Service())->all()]); }
    public function store(): void { $this->requireAuth(); (new Booking())->create(['student_id'=>(int)$_POST['student_id'],'service_id'=>(int)$_POST['service_id'],'booking_date'=>$_POST['booking_date'],'status'=>$_POST['status']??'Pending','comment'=>trim($_POST['comment']??'')]); $this->redirect('bookings'); }
    public function updateStatus(): void { $this->requireAuth(); (new Booking())->updateStatus((int)$_POST['id'], $_POST['status']); $this->redirect('bookings'); }
    public function delete(): void { $this->requireAuth(); (new Booking())->delete((int)$_GET['id']); $this->redirect('bookings'); }
}
