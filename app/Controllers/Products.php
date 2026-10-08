<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;

class Products extends BaseController
{
    protected $productModel;
    protected $saleModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->saleModel = new SaleModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Products',
            'products' => $this->productModel
                ->orderBy('id', 'DESC')
                ->findAll(),
        ];

        return view('products/index', $data);
    }

    public function create()
    {
        return view('products/create');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|max_length[100]',
            'price' => 'required|decimal',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
            'image' => [
                'label' => 'Product Image',
                'rules' => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $image = $this->request->getFile('image');
        $imageName = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();

            $image->move(
                FCPATH . 'uploads/products',
                $imageName
            );
        }

        $this->productModel->insert([
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image' => $imageName,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/products')
            ->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return redirect()->to('/products')
                ->with('error', 'Product not found.');
        }

        return view('products/edit', [
            'product' => $product,
        ]);
    }

    public function update($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return redirect()->to('/products')
                ->with('error', 'Product not found.');
        }

        $rules = [
            'name' => 'required|max_length[100]',
            'price' => 'required|decimal',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
            'image' => [
                'label' => 'Product Image',
                'rules' => 'permit_empty|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ];

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();

            $image->move(
                FCPATH . 'uploads/products',
                $imageName
            );

            $data['image'] = $imageName;
        }

        $this->productModel->update($id, $data);

        return redirect()->to('/products')
            ->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return redirect()->to('/products')
                ->with('error', 'Product not found.');
        }

        /*
         * Prevent deletion if this product already has sales records.
         * This protects the Sales History from being deleted by
         * the database's ON DELETE CASCADE relationship.
         */
        $saleExists = $this->saleModel
            ->where('product_id', $id)
            ->first();

        if ($saleExists) {
            return redirect()->to('/products')
                ->with(
                    'error',
                    'This product cannot be deleted because it has existing sales records.'
                );
        }

        /*
         * Delete the product image from the server
         * before deleting the product record.
         */
        if (!empty($product['image'])) {
            $imagePath = FCPATH . 'uploads/products/' . $product['image'];

            if (is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        $this->productModel->delete($id);

        return redirect()->to('/products')
            ->with('success', 'Product deleted successfully.');
    }
}