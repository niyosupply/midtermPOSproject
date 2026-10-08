<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product - Point of Sale System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
            color: #333;
        }

        .navbar {
            background: #212529;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .navbar .brand {
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar .links {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .navbar .links a {
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
        }

        .navbar .links a:hover {
            background: #343a40;
        }

        .container {
            max-width: 800px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .page-header {
            margin-bottom: 20px;
        }

        .page-header h1 {
            margin: 0;
            color: #212529;
        }

        .page-header p {
            color: #777;
            margin-top: 8px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #444;
        }

        .form-group input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 15px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #212529;
            box-shadow: 0 0 0 3px rgba(33, 37, 41, 0.1);
        }

        .help-text {
            display: block;
            margin-top: 6px;
            color: #777;
            font-size: 13px;
        }

        .errors {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .errors ul {
            margin: 0;
            padding-left: 20px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-primary {
            background: #212529;
            color: white;
        }

        .btn-primary:hover {
            background: #343a40;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5c636a;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 15px;
            }

            .navbar .links {
                margin-top: 10px;
                width: 100%;
            }

            .navbar .links a {
                padding: 7px 9px;
            }

            .container {
                margin: 25px auto;
                padding: 0 15px;
            }

            .card {
                padding: 20px;
            }

            .buttons {
                flex-direction: column;
            }

            .btn {
                text-align: center;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">

    <a href="<?= base_url('dashboard') ?>" class="brand">
        Point of Sale System
    </a>

    <div class="links">
        <a href="<?= base_url('dashboard') ?>">Dashboard</a>
        <a href="<?= base_url('products') ?>">Products</a>
        <a href="<?= base_url('customers') ?>">Customers</a>
        <a href="<?= base_url('staff') ?>">Staff</a>
        <a href="<?= base_url('sales/create') ?>">Record Sale</a>
        <a href="<?= base_url('sales/history') ?>">Sales History</a>
        <a href="<?= base_url('logout') ?>">Logout</a>
    </div>

</nav>

<div class="container">

    <div class="page-header">
        <h1>Add Product</h1>
        <p>Add a new product to your inventory.</p>
    </div>

    <div class="card">

        <?php if (session()->getFlashdata('errors')): ?>

            <div class="errors">
                <strong>Please correct the following errors:</strong>

                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php endif; ?>

        <form
            action="<?= base_url('products/store') ?>"
            method="post"
            enctype="multipart/form-data"
        >

            <?= csrf_field() ?>

            <div class="form-group">
                <label for="name">Product Name</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?= old('name') ?>"
                    placeholder="Enter product name"
                    maxlength="100"
                    required
                >
            </div>

            <div class="form-group">
                <label for="price">Price</label>

                <input
                    type="number"
                    id="price"
                    name="price"
                    value="<?= old('price') ?>"
                    placeholder="0.00"
                    step="0.01"
                    min="0"
                    required
                >
            </div>

            <div class="form-group">
                <label for="stock_quantity">Stock Quantity</label>

                <input
                    type="number"
                    id="stock_quantity"
                    name="stock_quantity"
                    value="<?= old('stock_quantity') ?>"
                    placeholder="0"
                    min="0"
                    required
                >
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <span class="help-text">
                    Allowed formats: JPG, JPEG, PNG, WEBP. Maximum size: 2 MB.
                </span>
            </div>

            <div class="buttons">

                <button type="submit" class="btn btn-primary">
                    Save Product
                </button>

                <a
                    href="<?= base_url('products') ?>"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>