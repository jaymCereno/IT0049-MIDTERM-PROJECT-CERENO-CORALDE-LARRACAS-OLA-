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