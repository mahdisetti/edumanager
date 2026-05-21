<?php
class DashboardController extends Controller {
    public function index(): void {
        $this->requireAuth();
        $studentModel = new Student(); $serviceModel = new Service(); $bookingModel = new Booking();
        $this->view('dashboard/index', [
            'title'=>'Dashboard', 'active'=>'dashboard',
            'studentCounts'=>$studentModel->counts(), 'serviceCounts'=>$serviceModel->counts(),
            'activeBookings'=>$bookingModel->countActive(), 'services'=>$serviceModel->all(),
            'activities'=>(new Comment())->latest()
        ]);
    }
}
