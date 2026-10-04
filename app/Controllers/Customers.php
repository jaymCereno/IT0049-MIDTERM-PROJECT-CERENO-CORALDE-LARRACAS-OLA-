<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();

        $data['customers'] = $customerModel->findAll();

        return view('customers/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'full_name' => 'required|min_length[2]|max_length[100]',
                'email' => 'required|valid_email|max_length[100]',
                'phone' => 'required|max_length[20]'
            ];

            $messages = [
                'full_name' => [
                    'required' => 'Customer name is required.',
                    'min_length' => 'Customer name must be at least 2 characters.',
                    'max_length' => 'Customer name cannot exceed 100 characters.'
                ],
                'email' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length' => 'Email cannot exceed 100 characters.'
                ],
                'phone' => [
                    'required' => 'Phone number is required.',
                    'max_length' => 'Phone number cannot exceed 20 characters.'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                return view('customers/create', [
                    'validation' => $this->validator
                ]);
            }

            $customerModel = new CustomerModel();

            $customerModel->save([
                'full_name' => $this->request->getPost('full_name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->to('/customers');
        }

        return view('customers/create');
    }

    public function edit($id)
    {
        $customerModel = new CustomerModel();

        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'full_name' => 'required|min_length[2]|max_length[100]',
                'email' => 'required|valid_email|max_length[100]',
                'phone' => 'required|max_length[20]'
            ];

            $messages = [
                'full_name' => [
                    'required' => 'Customer name is required.',
                    'min_length' => 'Customer name must be at least 2 characters.',
                    'max_length' => 'Customer name cannot exceed 100 characters.'
                ],
                'email' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length' => 'Email cannot exceed 100 characters.'
                ],
                'phone' => [
                    'required' => 'Phone number is required.',
                    'max_length' => 'Phone number cannot exceed 20 characters.'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                return view('customers/edit', [
                    'validation' => $this->validator,
                    'customer' => $customerModel->find($id)
                ]);
            }

            $customerModel->update($id, [
                'full_name' => $this->request->getPost('full_name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone')
            ]);

            return redirect()->to('/customers');
        }

        $data['customer'] = $customerModel->find($id);

        return view('customers/edit', $data);
    }

    public function delete($id)
    {
        $customerModel = new CustomerModel();

        $customerModel->delete($id);

        return redirect()->to('/customers');
    }
}