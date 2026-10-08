<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Products</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }

        h1 {
            margin-bottom: 20px;
        }

        .top-links {
            margin-bottom: 20px;
        }

        .top-links a {
            display: inline-block;
            margin-right: 10px;
            padding: 10px 15px;
            text-decoration: none;
            background-color: #333;
            color: white;
            border-radius: 5px;
        }

        .top-links a:hover {
            background-color: #555;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .no-image {
            color: #777;
        }

        .edit-button {
            display: inline-block;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }

        .delete-button {
            padding: 8px 12px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <h1>Products</h1>

    <!-- Success Message -->
    <?php if (session()->getFlashdata('success')): ?>

        <div class="success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>

    <?php endif; ?>


    <!-- Error Message -->
    <?php if (session()->getFlashdata('error')): ?>

        <div class="error">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>

    <?php endif; ?>


    <!-- Navigation Links -->
    <div class="top-links">

        <a href="<?= base_url('products/create') ?>">
            Add Product
        </a>

        <a href="<?= base_url('dashboard') ?>">
            Dashboard
        </a>

        <a href="<?= base_url('logout') ?>">
            Logout
        </a>

    </div>


    <!-- Products Table -->
    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Image</th>

                <th>Product Name</th>

                <th>Price</th>

                <th>Stock Quantity</th>

                <th>Actions</th>

            </tr>

        </thead>


        <tbody>

            <?php if (!empty($products)): ?>

                <?php foreach ($products as $product): ?>

                    <tr>

                        <!-- ID -->
                        <td>
                            <?= esc($product['id']) ?>
                        </td>


                        <!-- Product Image -->
                        <td>

                            <?php if (!empty($product['image'])): ?>

                                <img
                                    src="<?= base_url('uploads/products/' . $product['image']) ?>"
                                    alt="<?= esc($product['name']) ?>"
                                    class="product-image"
                                >

                            <?php else: ?>

                                <span class="no-image">
                                    No Image
                                </span>

                            <?php endif; ?>

                        </td>


                        <!-- Product Name -->
                        <td>
                            <?= esc($product['name']) ?>
                        </td>


                        <!-- Price -->
                        <td>
                            ₱<?= number_format($product['price'], 2) ?>
                        </td>


                        <!-- Stock -->
                        <td>
                            <?= esc($product['stock_quantity']) ?>
                        </td>


                        <!-- Actions -->
                        <td>

                            <!-- Edit Button -->
                            <a
                                href="<?= base_url('products/edit/' . $product['id']) ?>"
                                class="edit-button"
                            >
                                Edit
                            </a>


                            <!-- Delete Form -->
                            <form
                                action="<?= base_url('products/delete/' . $product['id']) ?>"
                                method="post"
                                style="display: inline;"
                                onsubmit="return confirm('Are you sure you want to delete this product?');"
                            >

                                <?= csrf_field() ?>

                                <button
                                    type="submit"
                                    class="delete-button"
                                >
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="6">
                        No products found.
                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</body>

</html>