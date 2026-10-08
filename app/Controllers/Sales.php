<?php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\UserModel;

class Sales extends BaseController
{
    protected $saleModel;
    protected $productModel;
    protected $customerModel;
    protected $userModel;

    public function __construct()
    {
        $this->saleModel = new SaleModel();
        $this->productModel = new ProductModel();
        $this->customerModel = new CustomerModel();
        $this->userModel = new UserModel();
    }

    public function create()
    {
        $data = [
            'title' => 'Record Sale',

            'products' => $this->productModel
                ->where('stock_quantity >', 0)
                ->orderBy('name', 'ASC')
                ->findAll(),

            'customers' => $this->customerModel
                ->orderBy('full_name', 'ASC')
                ->findAll(),
        ];

        return view('sales/create', $data);
    }

    public function store()
    {
        $rules = [
            'product_id' => 'required|integer',
            'customer_id' => 'permit_empty|integer',
            'quantity' => 'required|integer|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $productId = $this->request->getPost('product_id');
        $customerId = $this->request->getPost('customer_id');
        $quantity = (int) $this->request->getPost('quantity');

        $product = $this->productModel->find($productId);

        if (!$product) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Product not found.');
        }

        if ($quantity > $product['stock_quantity']) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Insufficient stock. Available stock: ' .
                    $product['stock_quantity']
                );
        }

        if (!empty($customerId)) {
            $customer = $this->customerModel->find($customerId);

            if (!$customer) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Customer not found.');
            }
        } else {
            $customerId = null;
        }

        $totalPrice = $product['price'] * $quantity;

        $db = \Config\Database::connect();

        $db->transStart();

        $this->saleModel->insert([
            'product_id' => $productId,
            'customer_id' => $customerId,
            'sold_by' => session()->get('user_id'),
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $newStock = $product['stock_quantity'] - $quantity;

        $this->productModel->update($productId, [
            'stock_quantity' => $newStock,
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'The sale could not be recorded. Please try again.'
                );
        }

        return redirect()->to('/sales/create')
            ->with(
                'success',
                'Sale recorded successfully. Total: ₱' .
                number_format($totalPrice, 2)
            );
    }

    public function history()
    {
        $sales = $this->saleModel
            ->select(
                'sales.id,
                sales.quantity,
                sales.total_price,
                sales.created_at,
                products.name AS product_name,
                customers.full_name AS customer_name,
                users.full_name AS staff_name'
            )
            ->join(
                'products',
                'products.id = sales.product_id',
                'left'
            )
            ->join(
                'customers',
                'customers.id = sales.customer_id',
                'left'
            )
            ->join(
                'users',
                'users.id = sales.sold_by',
                'left'
            )
            ->orderBy('sales.id', 'DESC')
            ->findAll();

        return view('sales/history', [
            'title' => 'Sales History',
            'sales' => $sales,
        ]);
    }
}