<?php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\UserModel;

class Sales extends BaseController
{
    public function index()
{
    $saleModel = new SaleModel();

    $data['sales'] = $saleModel->getSalesHistory();

    return view('sales/index', $data);
}


    public function create()
    {
        $productModel = new ProductModel();
        $customerModel = new CustomerModel();
        $userModel = new UserModel();

        if ($this->request->getMethod() === 'POST') {

            $productId = $this->request->getPost('product_id');
            $customerId = $this->request->getPost('customer_id');
            $soldBy = $this->request->getPost('sold_by');
            $quantity = (int) $this->request->getPost('quantity');

            // Validate quantity
            if ($quantity <= 0) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Quantity must be greater than 0.');
            }

            // Check if product exists
            $product = $productModel->find($productId);

            if (!$product) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Selected product does not exist.');
            }

            // Check if staff/user exists
            $user = $userModel->find($soldBy);

            if (!$user) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Selected staff member does not exist.');
            }

            // Check optional customer
            if (!empty($customerId)) {
                $customer = $customerModel->find($customerId);

                if (!$customer) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Selected customer does not exist.');
                }
            } else {
                $customerId = null;
            }

            // Check available stock
            if ($quantity > $product['stock_quantity']) {
                return redirect()->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Not enough stock. Available stock: ' .
                        $product['stock_quantity']
                    );
            }

            // Calculate total price
            $totalPrice = $product['price'] * $quantity;

            $db = \Config\Database::connect();

            // Start database transaction
            $db->transStart();

            // Deduct stock
            $productModel->update(
                $productId,
                [
                    'stock_quantity' =>
                        $product['stock_quantity'] - $quantity
                ]
            );

            // Save sale
            $saleModel = new SaleModel();

            $saleModel->insert([
                'product_id' => $productId,
                'customer_id' => $customerId,
                'sold_by' => $soldBy,
                'quantity' => $quantity,
                'total_price' => $totalPrice,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Complete transaction
            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Sale could not be recorded.');
            }

            return redirect()->to('/sales/create')
                ->with(
                    'success',
                    'Sale recorded successfully. Total: ₱' .
                    number_format($totalPrice, 2)
                );
        }

        $data['products'] = $productModel->findAll();
        $data['customers'] = $customerModel->findAll();
        $data['users'] = $userModel->findAll();

        return view('sales/create', $data);
    }
}