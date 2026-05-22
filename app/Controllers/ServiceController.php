<?php

class ServiceController extends Controller
{
    private Service $model;

    public function __construct()
    {
        $this->model = new Service();
    }

    public function index(): void
    {
        $this->requireAuth();

        $q = $_GET['q'] ?? '';

        $this->view('services/index', [
            'title'    => 'Services',
            'active'   => 'services',
            'services' => $this->model->all($q),
            'counts'   => $this->model->counts(),
            'q'        => $q
        ]);
    }

    public function store(): void
    {
        $this->requireAuth();

        if (!$this->isPost()) {
            $this->redirect('services');
        }

        $image = FileUploader::upload('image', 'service', 0);

        $this->model->create($this->serviceData($image));

        $this->redirect('services');
    }

    public function update(): void
    {
        $this->requireAuth();

        $id = (int) ($_POST['id'] ?? 0);
        $old = $this->model->find($id);
        $image = $old['image'] ?? null;

        if (!empty($_FILES['image']['name'])) {
            $image = FileUploader::upload('image', 'service', $id);
        }

        $this->model->update($id, $this->serviceData($image));

        $this->redirect('services');
    }

    public function delete(): void
    {
        $this->requireAuth();

        $this->model->delete((int) ($_GET['id'] ?? 0));

        $this->redirect('services');
    }

    private function serviceData(?string $image): array
    {
        return [
            'service_code' => $_POST['service_code'] ?: ('EDU-' . rand(100, 999)),
            'name'         => trim($_POST['name'] ?? ''),
            'category'     => $_POST['category'] ?? 'Academic',
            'price'        => (float) ($_POST['price'] ?? 0),
            'description'  => trim($_POST['description'] ?? ''),
            'status'       => $_POST['status'] ?? 'Active',
            'image'        => $image
        ];
    }
}