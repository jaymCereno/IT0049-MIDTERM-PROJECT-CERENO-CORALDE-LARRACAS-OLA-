<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $data['users'] = $userModel->findAll();

        return view('users/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'username' => 'required|min_length[3]|max_length[50]',
                'full_name' => 'required|min_length[2]|max_length[100]',
                'password' => 'required|min_length[8]|max_length[255]'
            ];

            $messages = [
                'username' => [
                    'required' => 'Username is required.',
                    'min_length' => 'Username must be at least 3 characters.',
                    'max_length' => 'Username cannot exceed 50 characters.'
                ],
                'full_name' => [
                    'required' => 'Full name is required.',
                    'min_length' => 'Full name must be at least 2 characters.',
                    'max_length' => 'Full name cannot exceed 100 characters.'
                ],
                'password' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 8 characters.',
                    'max_length' => 'Password cannot exceed 255 characters.'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                return view('users/create', [
                    'validation' => $this->validator
                ]);
            }

            $avatar = $this->request->getFile('avatar');
            $avatarName = null;

            if ($avatar && $avatar->isValid()) {
                $avatarName = $avatar->getRandomName();
                $avatar->move(FCPATH . 'uploads/avatars', $avatarName);
            }

            $userModel = new UserModel();

            $userModel->save([
                'username' => $this->request->getPost('username'),
                'full_name' => $this->request->getPost('full_name'),
                'password' => password_hash(
                    $this->request->getPost('password'),
                    PASSWORD_DEFAULT
                ),
                'avatar' => $avatarName,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->to('/users');
        }

        return view('users/create');
    }

    public function edit($id)
    {
        $userModel = new UserModel();

        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'username' => 'required|min_length[3]|max_length[50]',
                'full_name' => 'required|min_length[2]|max_length[100]'
            ];

            $messages = [
                'username' => [
                    'required' => 'Username is required.',
                    'min_length' => 'Username must be at least 3 characters.',
                    'max_length' => 'Username cannot exceed 50 characters.'
                ],
                'full_name' => [
                    'required' => 'Full name is required.',
                    'min_length' => 'Full name must be at least 2 characters.',
                    'max_length' => 'Full name cannot exceed 100 characters.'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                return view('users/edit', [
                    'validation' => $this->validator,
                    'user' => $userModel->find($id)
                ]);
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'full_name' => $this->request->getPost('full_name')
            ];

            $avatar = $this->request->getFile('avatar');

            if ($avatar && $avatar->isValid()) {
                $avatarName = $avatar->getRandomName();

                $avatar->move(
                    FCPATH . 'uploads/avatars',
                    $avatarName
                );

                $data['avatar'] = $avatarName;
            }

            $userModel->update($id, $data);

            return redirect()->to('/users');
        }

        $data['user'] = $userModel->find($id);

        return view('users/edit', $data);
    }

    public function delete($id)
    {
        $userModel = new UserModel();

        $userModel->delete($id);

        return redirect()->to('/users');
    }
}