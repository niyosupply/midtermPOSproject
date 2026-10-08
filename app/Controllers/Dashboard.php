<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\UserModel;
use App\Models\SaleModel;

class Dashboard extends BaseController
{
    protected $productModel;
    protected $customerModel;
    protected $userModel;
    protected $saleModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->customerModel = new CustomerModel();
        $this->userModel = new UserModel();
        $this->saleModel = new SaleModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',

            'productCount' => $this->productModel->countAllResults(),

            'customerCount' => $this->customerModel->countAllResults(),

            'staffCount' => $this->userModel->countAllResults(),

            'salesCount' => $this->saleModel->countAllResults(),

            'todaySales' => $this->saleModel
                ->where(
                    'created_at >=',
                    date('Y-m-d 00:00:00')
                )
                ->where(
                    'created_at <=',
                    date('Y-m-d 23:59:59')
                )
                ->countAllResults(),
        ];

        return view('dashboard/index', $data);
    }
}