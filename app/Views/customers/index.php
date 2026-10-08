<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Customers - Point of Sale System</title>

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
            padding: 10px 15px;
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

        .btn-edit {
            background: #6c757d;
            color: white;
        }

        .btn-edit:hover {
            background: #5c636a;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background: #bb2d3b;
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
            min-width: 750px;
        }

        th {
            background: #212529;
            color: white;
            text-align: left;
            padding: 13px 15px;
            font-size: 14px;
        }

        td {
            padding: 13px 15px;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .actions {
            display: flex;
            gap: 7px;
            align-items: center;
        }

        .actions form {
            margin: 0;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #777;
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
            <h1>Customers</h1>
            <p>Manage your customer records.</p>
        </div>

        <a
            href="<?= base_url('customers/create') ?>"
            class="btn btn-primary"
        >
            + Add Customer
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

    <div class="card">

        <?php if (!empty($customers)): ?>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($customers as $customer): ?>

                            <tr>

                                <td>
                                    <?= esc($customer['id']) ?>
                                </td>

                                <td>
                                    <?= esc($customer['full_name']) ?>
                                </td>

                                <td>
                                    <?= esc($customer['email']) ?>
                                </td>

                                <td>
                                    <?= esc($customer['phone'] ?? '-') ?>
                                </td>

                                <td>
                                    <?= esc($customer['created_at']) ?>
                                </td>

                                <td>

                                    <div class="actions">

                                        <a
                                            href="<?= base_url('customers/edit/' . $customer['id']) ?>"
                                            class="btn btn-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="<?= base_url('customers/delete/' . $customer['id']) ?>"
                                            method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this customer?');"
                                        >

                                            <?= csrf_field() ?>

                                            <button
                                                type="submit"
                                                class="btn btn-delete"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="empty">
                No customers found.
            </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>