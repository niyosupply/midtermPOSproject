<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SaleModel;

class Staff extends BaseController
{
    protected $userModel;
    protected $saleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->saleModel = new SaleModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Staff',
            'staff' => $this->userModel
                ->orderBy('id', 'DESC')
                ->findAll(),
        ];

        return view('staff/index', $data);
    }

    public function create()
    {
        return view('staff/create');
    }

    public function store()
    {
        $rules = [
            'username' => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
            'password' => 'required|min_length[6]|max_length[255]',
            'avatar' => [
                'label' => 'Avatar',
                'rules' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]|max_size[avatar,2048]',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $avatar = $this->request->getFile('avatar');
        $avatarName = null;

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $avatarName = $avatar->getRandomName();

            $avatar->move(
                FCPATH . 'uploads/avatars',
                $avatarName
            );
        }

        $this->userModel->insert([
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'avatar' => $avatarName,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/staff')
            ->with('success', 'Staff account added successfully.');
    }

    public function edit($id)
    {
        $staff = $this->userModel->find($id);

        if (!$staff) {
            return redirect()->to('/staff')
                ->with('error', 'Staff account not found.');
        }

        return view('staff/edit', [
            'staff' => $staff,
        ]);
    }

    public function update($id)
    {
        $staff = $this->userModel->find($id);

        if (!$staff) {
            return redirect()->to('/staff')
                ->with('error', 'Staff account not found.');
        }

        $rules = [
            'username' => "required|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[100]',
            'password' => 'permit_empty|min_length[6]|max_length[255]',
            'avatar' => [
                'label' => 'Avatar',
                'rules' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]|max_size[avatar,2048]',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        $password = $this->request->getPost('password');

        if (!empty($password)) {
            $data['password'] = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
        }

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $avatarName = $avatar->getRandomName();

            $avatar->move(
                FCPATH . 'uploads/avatars',
                $avatarName
            );

            $data['avatar'] = $avatarName;
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/staff')
            ->with('success', 'Staff account updated successfully.');
    }

    public function delete($id)
    {
        $staff = $this->userModel->find($id);

        if (!$staff) {
            return redirect()->to('/staff')
                ->with('error', 'Staff account not found.');
        }

        /*
         * Prevent a staff account from being deleted if
         * the staff member has existing sales records.
         */
        $saleExists = $this->saleModel
            ->where('sold_by', $id)
            ->first();

        if ($saleExists) {
            return redirect()->to('/staff')
                ->with(
                    'error',
                    'This staff account cannot be deleted because it has existing sales records.'
                );
        }

        /*
         * Delete the avatar file from the server
         * before deleting the staff account.
         */
        if (!empty($staff['avatar'])) {
            $avatarPath = FCPATH . 'uploads/avatars/' . $staff['avatar'];

            if (is_file($avatarPath)) {
                unlink($avatarPath);
            }
        }

        $this->userModel->delete($id);

        return redirect()->to('/staff')
            ->with('success', 'Staff account deleted successfully.');
    }
}