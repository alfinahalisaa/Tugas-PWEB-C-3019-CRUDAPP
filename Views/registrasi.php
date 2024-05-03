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
        <form action="<?= urlpath('registrasi');?>" method="POST">
            <h2>Register</h2>
            <div class="form-control">
                <label for="nama">Full Name</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-control">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" id="loginButton">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="<?= urlpath('login');?>">Klik disini</a> untuk login.</p>
    </div>
</body>

</html>