<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sales History - Point of Sale System</title>

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
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .page-header h1 {
            margin: 0;
            color: #212529;
        }

        .page-header p {
            margin: 8px 0 0;
            color: #777;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
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

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        thead {
            background: #212529;
            color: white;
        }

        th,
        td {
            padding: 14px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
            white-space: nowrap;
        }

        th {
            font-size: 14px;
        }

        td {
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .sale-id {
            font-weight: bold;
            color: #212529;
        }

        .amount {
            font-weight: bold;
        }

        .empty-state {
            padding: 50px 20px;
            text-align: center;
            color: #777;
        }

        .empty-state h3 {
            margin-bottom: 8px;
            color: #555;
        }

        .summary {
            margin-bottom: 20px;
            color: #666;
            font-size: 14px;
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

            .page-header {
                align-items: flex-start;
            }

            .page-header .btn {
                width: 100%;
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

        <div>
            <h1>Sales History</h1>
            <p>View all recorded sales transactions.</p>
        </div>

        <a
            href="<?= base_url('sales/create') ?>"
            class="btn btn-primary"
        >
            + Record New Sale
        </a>

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

    <div class="summary">
        Total recorded transactions:
        <strong><?= count($sales) ?></strong>
    </div>

    <div class="card">

        <?php if (!empty($sales)): ?>

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Sold By</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Date</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($sales as $sale): ?>

                            <tr>

                                <td class="sale-id">
                                    #<?= esc($sale['id']) ?>
                                </td>

                                <td>
                                    <?= esc($sale['product_name']) ?>
                                </td>

                                <td>
                                    <?php if (!empty($sale['customer_name'])): ?>

                                        <?= esc($sale['customer_name']) ?>

                                    <?php else: ?>

                                        <span>Walk-in Customer</span>

                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?= esc($sale['staff_name']) ?>
                                </td>

                                <td>
                                    <?= esc($sale['quantity']) ?>
                                </td>

                                <td class="amount">
                                    ₱<?= number_format($sale['total_price'], 2) ?>
                                </td>

                                <td>
                                    <?= esc(date(
                                        'M d, Y h:i A',
                                        strtotime($sale['created_at'])
                                    )) ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty-state">

                <h3>No Sales Yet</h3>

                <p>
                    There are currently no recorded sales transactions.
                </p>

                <a
                    href="<?= base_url('sales/create') ?>"
                    class="btn btn-primary"
                >
                    Record First Sale
                </a>

            </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>