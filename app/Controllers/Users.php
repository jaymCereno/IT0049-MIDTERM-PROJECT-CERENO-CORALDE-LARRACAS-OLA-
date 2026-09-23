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

            $avatar = $this->request->getFile('avatar');

            $avatarName = null;

            if ($avatar && $avatar->isValid()) {

                $avatarName = $avatar->getRandomName();

                $avatar->move(
                    FCPATH . 'uploads/avatars',
                    $avatarName
                );
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