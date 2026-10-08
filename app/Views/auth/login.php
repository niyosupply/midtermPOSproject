<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Staff Login - Point of Sale System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 15px;
            background: #212529;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
        }

        .logo-section h1 {
            margin: 0;
            font-size: 24px;
            color: #212529;
        }

        .logo-section p {
            margin-top: 8px;
            color: #777;
            font-size: 14px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .validation-errors {
            background: #fff3cd;
            color: #664d03;
            border: 1px solid #ffecb5;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .validation-errors ul {
            margin: 0;
            padding-left: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 14px;
            color: #444;
        }

        .form-group input {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus {
            border-color: #212529;
            box-shadow: 0 0 0 3px rgba(33, 37, 41, 0.1);
        }

        .login-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #212529;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .login-button:hover {
            background: #343a40;
        }

        .footer-text {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #888;
        }

        @media (max-width: 480px) {
            .login-wrapper {
                padding: 15px;
            }

            .login-card {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <div class="logo-section">
            <div class="logo-icon">
                POS
            </div>

            <h1>Point of Sale System</h1>

            <p>Staff Login</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="validation-errors">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login/authenticate') ?>" method="post">

            <?= csrf_field() ?>

            <div class="form-group">
                <label for="username">Username</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= old('username') ?>"
                    placeholder="Enter your username"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                Login
            </button>

        </form>

        <div class="footer-text">
            Point of Sale System &copy; <?= date('Y') ?>
        </div>

    </div>

</div>

</body>
</html>