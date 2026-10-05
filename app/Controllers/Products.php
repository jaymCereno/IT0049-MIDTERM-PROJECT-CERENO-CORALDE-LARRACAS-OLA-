<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();

        $data['products'] = $productModel->findAll();

        return view('products/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'name' => 'required|min_length[2]|max_length[100]',
                'price' => 'required|numeric|greater_than[0]',
                'stock_quantity' => 'required|integer|greater_than_equal_to[0]'
            ];

            $messages = [
                'name' => [
                    'required' => 'Product name is required.',
                    'min_length' => 'Product name must be at least 2 characters.',
                    'max_length' => 'Product name cannot exceed 100 characters.'
                ],
                'price' => [
                    'required' => 'Price is required.',
                    'numeric' => 'Price must be a number.',
                    'greater_than' => 'Price must be greater than 0.'
                ],
                'stock_quantity' => [
                    'required' => 'Stock quantity is required.',
                    'integer' => 'Stock quantity must be a whole number.',
                    'greater_than_equal_to' => 'Stock quantity cannot be negative.'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                return view('products/create', [
                    'validation' => $this->validator
                ]);
            }

            $image = $this->request->getFile('image');

            $imageName = null;

            if ($image && $image->isValid()) {
                $imageName = $image->getRandomName();

                $image->move(
                    FCPATH . 'uploads/products',
                    $imageName
                );
            }

            $productModel = new ProductModel();

            $productModel->save([
                'name' => $this->request->getPost('name'),
                'price' => $this->request->getPost('price'),
                'stock_quantity' => $this->request->getPost('stock_quantity'),
                'image' => $imageName,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->to('/products');
        }

        return view('products/create');
    }

    public function edit($id)
    {
        $productModel = new ProductModel();

        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'name' => 'required|min_length[2]|max_length[100]',
                'price' => 'required|numeric|greater_than[0]',
                'stock_quantity' => 'required|integer|greater_than_equal_to[0]'
            ];

            $messages = [
                'name' => [
                    'required' => 'Product name is required.',
                    'min_length' => 'Product name must be at least 2 characters.',
                    'max_length' => 'Product name cannot exceed 100 characters.'
                ],
                'price' => [
                    'required' => 'Price is required.',
                    'numeric' => 'Price must be a number.',
                    'greater_than' => 'Price must be greater than 0.'
                ],
                'stock_quantity' => [
                    'required' => 'Stock quantity is required.',
                    'integer' => 'Stock quantity must be a whole number.',
                    'greater_than_equal_to' => 'Stock quantity cannot be negative.'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                return view('products/edit', [
                    'validation' => $this->validator,
                    'product' => $productModel->find($id)
                ]);
            }

            $image = $this->request->getFile('image');

            $data = [
                'name' => $this->request->getPost('name'),
                'price' => $this->request->getPost('price'),
                'stock_quantity' => $this->request->getPost('stock_quantity')
            ];

            if ($image && $image->isValid()) {
                $imageName = $image->getRandomName();

                $image->move(
                    FCPATH . 'uploads/products',
                    $imageName
                );

                $data['image'] = $imageName;
            }

            $productModel->update($id, $data);

            return redirect()->to('/products');
        }

        $data['product'] = $productModel->find($id);

        return view('products/edit', $data);
    }

    public function delete($id)
    {
        $productModel = new ProductModel();

        $productModel->delete($id);

        return redirect()->to('/products');
    }
}