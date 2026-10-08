<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f5f5f5;
        }

        .navbar {
            background-color: #343a40;
            padding: 15px 30px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            margin-bottom: 5px;
        }

        .welcome {
            color: #666;
            margin-bottom: 30px;
        }

        .cards {
            display: grid;
            grid-template-columns:
                repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            margin: 0;
            font-size: 32px;
        }

        .card p {
            margin-top: 10px;
            color: #666;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .actions {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .actions h2 {
            margin-top: 0;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            margin-right: 10px;
            margin-bottom: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .sale-button {
            background-color: #28a745;
        }

        .sale-button:hover {
            background-color: #218838;
        }

        .logout-button {
            background-color: #dc3545;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        @media (max-width: 800px) {

            .cards {
                grid-template-columns:
                    repeat(2, 1fr);
            }

        }

        @media (max-width: 500px) {

            .cards {
                grid-template-columns:
                    1fr;
            }

            .navbar {
                padding: 15px;
            }

            .navbar a {
                display: inline-block;
                margin-bottom: 10px;
            }

        }

    </style>

</head>

<body>

    <!-- Navigation -->

    <div class="navbar">

        <a href="<?= base_url('dashboard') ?>">
            Dashboard
        </a>

        <a href="<?= base_url('products') ?>">
            Products
        </a>

        <a href="<?= base_url('customers') ?>">
            Customers
        </a>

        <a href="<?= base_url('staff') ?>">
            Staff
        </a>

        <a href="<?= base_url('sales/create') ?>">
            Record Sale
        </a>

        <a href="<?= base_url('sales/history') ?>">
            Sales History
        </a>

        <a href="<?= base_url('logout') ?>">
            Logout
        </a>

    </div>


    <!-- Main Content -->

    <div class="container">

        <h1>
            Point of Sale Dashboard
        </h1>

        <p class="welcome">

            Welcome,
            <strong>
                <?= esc(session()->get('full_name')) ?>
            </strong>

        </p>


        <!-- Statistics -->

        <div class="cards">


            <!-- Products -->

            <a
                href="<?= base_url('products') ?>"
                class="card-link"
            >

                <div class="card">

                    <h2>
                        <?= esc($productCount) ?>
                    </h2>

                    <p>
                        Products
                    </p>

                </div>

            </a>


            <!-- Customers -->

            <a
                href="<?= base_url('customers') ?>"
                class="card-link"
            >

                <div class="card">

                    <h2>
                        <?= esc($customerCount) ?>
                    </h2>

                    <p>
                        Customers
                    </p>

                </div>

            </a>


            <!-- Staff -->

            <a
                href="<?= base_url('staff') ?>"
                class="card-link"
            >

                <div class="card">

                    <h2>
                        <?= esc($staffCount) ?>
                    </h2>

                    <p>
                        Staff Accounts
                    </p>

                </div>

            </a>


            <!-- Total Sales -->

            <a
                href="<?= base_url('sales/history') ?>"
                class="card-link"
            >

                <div class="card">

                    <h2>
                        <?= esc($salesCount) ?>
                    </h2>

                    <p>
                        Total Sales
                    </p>

                </div>

            </a>

        </div>


        <!-- Today's Sales -->

        <div class="actions">

            <h2>
                Today's Sales
            </h2>

            <p>
                Number of sales recorded today:
                <strong>
                    <?= esc($todaySales) ?>
                </strong>
            </p>


            <h2>
                Quick Actions
            </h2>


            <a
                href="<?= base_url('sales/create') ?>"
                class="button sale-button"
            >
                + Record Sale
            </a>


            <a
                href="<?= base_url('sales/history') ?>"
                class="button"
            >
                Sales History
            </a>


            <a
                href="<?= base_url('products/create') ?>"
                class="button"
            >
                + Add Product
            </a>


            <a
                href="<?= base_url('customers/create') ?>"
                class="button"
            >
                + Add Customer
            </a>


            <a
                href="<?= base_url('staff/create') ?>"
                class="button"
            >
                + Add Staff
            </a>


            <a
                href="<?= base_url('logout') ?>"
                class="button logout-button"
            >
                Logout
            </a>

        </div>

    </div>

</body>

</html>