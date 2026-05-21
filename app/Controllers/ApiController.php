<?php

class ApiController extends Controller
{
    public function stats(): void
    {
        $this->requireAuth();
        header('Content-Type: application/json');

        $data = [
            'students'    => (new Student())->counts(),
            'services'    => (new Service())->counts(),
            'bookings'    => (new Booking())->countActive(),
            'months'      => ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb'],
            'enrollments' => [300, 410, 520, 680, 620, 740],
        ];

        echo json_encode($data);
    }

    public function students(): void
    {
        $this->requireAuth();
        header('Content-Type: application/json');

        $query = $_GET['q'] ?? '';

        echo json_encode((new Student())->all($query));
    }
}