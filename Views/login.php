<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfina Halisa - 3019</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/style1.css">
</head>

<body>
    <div class="container">
        <form action="<?= urlpath('login');?>" method="POST">
            <h2>Login</h2>
            <div class="form-control">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" id="loginButton">Login</button>
        </form>
        <p>Belum punya akun? <a href="<?= urlpath('registrasi');?>">Klik disini</a> untuk daftar.</p>
    </div>
</body>

</html>