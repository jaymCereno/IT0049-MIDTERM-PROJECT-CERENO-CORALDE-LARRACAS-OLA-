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