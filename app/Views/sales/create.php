<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Record Sale - Point of Sale System</title>

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

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 15px;
            outline: none;
            background: white;
        }

        .form-group select:focus,
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

        .alert {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .info-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .info-box strong {
            color: #212529;
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
        <h1>Record Sale</h1>
        <p>Create a new sales transaction and automatically update inventory.</p>
    </div>

    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>

    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-error">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>

    <?php endif; ?>

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

    <div class="info-box">
        <strong>Note:</strong>
        The selected product's stock will automatically decrease
        after the sale is successfully recorded.
    </div>

    <div class="card">

        <form
            action="<?= base_url('sales/store') ?>"
            method="post"
        >

            <?= csrf_field() ?>

            <div class="form-group">

                <label for="product_id">
                    Product
                </label>

                <select
                    id="product_id"
                    name="product_id"
                    required
                >

                    <option value="">
                        -- Select Product --
                    </option>

                    <?php foreach ($products as $product): ?>

                        <option
                            value="<?= esc($product['id']) ?>"
                            <?= old('product_id') == $product['id'] ? 'selected' : '' ?>
                        >
                            <?= esc($product['name']) ?>
                            — ₱<?= number_format($product['price'], 2) ?>
                            — Stock: <?= esc($product['stock_quantity']) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

                <?php if (empty($products)): ?>

                    <span class="help-text">
                        No products with available stock were found.
                    </span>

                <?php else: ?>

                    <span class="help-text">
                        Only products with available stock are shown.
                    </span>

                <?php endif; ?>

            </div>

            <div class="form-group">

                <label for="customer_id">
                    Customer
                </label>

                <select
                    id="customer_id"
                    name="customer_id"
                >

                    <option value="">
                        Walk-in Customer
                    </option>

                    <?php foreach ($customers as $customer): ?>

                        <option
                            value="<?= esc($customer['id']) ?>"
                            <?= old('customer_id') == $customer['id'] ? 'selected' : '' ?>
                        >
                            <?= esc($customer['full_name']) ?>
                            — <?= esc($customer['email']) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

                <span class="help-text">
                    Customer selection is optional.
                    Leave it as Walk-in Customer if there is no registered customer.
                </span>

            </div>

            <div class="form-group">

                <label for="quantity">
                    Quantity
                </label>

                <input
                    type="number"
                    id="quantity"
                    name="quantity"
                    value="<?= old('quantity', 1) ?>"
                    min="1"
                    step="1"
                    required
                >

                <span class="help-text">
                    The quantity cannot be greater than the available stock.
                </span>

            </div>

            <div class="buttons">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Record Sale
                </button>

                <a
                    href="<?= base_url('dashboard') ?>"
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