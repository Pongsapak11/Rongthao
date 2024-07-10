<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{

    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    public function Index()
    {
        return $this->respond($this->model->findAll());
    }

    public function Show($id = null)
    {
        return $this->respond($this->model->findAll($id));
    }

    public function Create()
    {
        $data = $this->request->getPost();

        $validation = service('validation');
        $validation->setRules(
            array(
                'username' => 'required|min_length[5]',
                'password' => 'required|min_length[5]',
                'name' => 'required|min_length[5]',
                'email' => 'required|valid_email',

            )
        );
        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }

        $data['role'] = 'user';
        if ($this->model->insert($data)) {
            return $this->respondCreated(array('message' => 'User updated successfully.'));
        }
        return $this->failServerError('Failed to update user.');
    }

    public function Modify()
    {
        $data = $this->request->getRawInput();

        $validation = service('validation');
        $validation->setRules(
            array(
                'username' => 'required|min_length[5]',
                'password' => 'required|min_length[5]',
                'name' => 'required|min_length[5]',
                'email' => 'required|valid_email',
            )
        );
        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }
        if ($this->model->find($data['user_id'])) {
            if ($this->model->update($data['user_id'], $data)) {
                return $this->respond(array('message' => 'User updated successfully.'));
            }
            return $this->failServerError('Failed to update user.');
        }
        return $this->failNotFound('User not found.');
    }
    public function Delete($id = null)
    {
        if ($this->model->find($id)) {
            if ($this->model->delete($id)) {
                return $this->respondDeleted(['message' => 'User deleted successfully.']);
            }
            return $this->failServerError('Failed to delete user.');
        }
        return $this->failNotFound('User not found.');
    }


}


?>