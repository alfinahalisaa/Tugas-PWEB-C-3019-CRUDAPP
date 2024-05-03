<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/tambah.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="dashboard">
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
            <div class="side-bar">
                <div class="menu">
                    <div class="item" id="dashboardItem"><a href="<?= urlpath('dashboard');?>"><i
                                class="fas fa-chart-line"></i>
                            Dashboard</a></div>
                    <div class="item" id="TambahItem"><a href="<?= urlpath('tambahFilm');?>"><i class="fas fa-user"></i>
                            Tambah Data</a>
                    </div>
                    <div class="item" id="EditItem"><a><i class="fas fa-cogs"></i> Edit</a></div>
                    <div class="item" id="settingsItem"><a><i class="fas fa-cogs"></i> Settings</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="logout">
            <button id="logoutBtn">Logout</button>
        </div>

        <div class="main-content">
            <h1>EDIT DATA</h1>
            <p>Bingung mau ngelist film tontonan dimana? MyMovieList yang bisa nyatet tontonan kesukaanmu nih!<br>Edit
                Data dibawah ini ya.</p>
            <div id="formTambahData" class="add-form" style="display: block;">
                <form action="<?= urlpath('editFilm') ?>" method="POST" enctype="multipart/form-data">
                    <!-- ID Film (Hidden Input) -->
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

                    <!-- Judul Film -->
                    <label for="judul">Judul:</label><br>
                    <input type="text" id="judul" name="judul" value="<?php echo $judul; ?>"><br>

                    <!-- Rate -->
                    <label for="rate">Rate:</label><br>
                    <input type="text" id="rate" name="rate" value="<?php echo $rate; ?>"><br>

                    <!-- Status -->
                    <label for="status">Status:</label><br>
                    <select id="status" name="status">
                        <option value="On Going" <?php if ($status == "On Going") echo "selected"; ?>>On Going</option>
                        <option value="Finish" <?php if ($status == "Finish") echo "selected"; ?>>Finish</option>
                    </select><br>

                    <!-- Poster -->
                    <label for="poster">Poster:</label><br>
                    <input type="file" id="poster" name="poster" accept="image/*"><br>

                    <!-- Tombol Edit -->
                    <button id="submitEntryBtn" style="margin-bottom: 10px;">Edit</button>
                </form>
            </div>
        </div>

    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.querySelector('.menu-btn');
        const sideBar = document.querySelector('.side-bar');
        const mainContent = document.querySelector('.main-content');
        const logoutBtn = document.getElementById('logoutBtn');
        const dashboardItem = document.getElementById('dashboardItem');
        const TambahItem = document.getElementById('TambahItem');
        const settingsItem = document.getElementById('settingsItem');
        const EditItem = document.getElementById('EditItem')

        // Event listener untuk logout
        logoutBtn.addEventListener('click', () => {
            // Arahkan pengguna ke halaman login
            window.location.href = 'login.php'; // Sesuaikan dengan Judul halaman login Anda
        });

        // Periksa halaman yang sedang dibuka saat halaman dimuat
        const currentPage = window.location.pathname;

        // Fungsi untuk menghapus kelas active dari semua item menu
        function removeActiveClass() {
            dashboardItem.classList.remove('active');
            TambahItem.classList.remove('active');
            settingsItem.classList.remove('active');
            EditItem.classList.remove('active');
        }

        // Event listener untuk tombol menu
        menuBtn.addEventListener('click', () => {
            sideBar.classList.toggle('active');
            mainContent.classList.toggle('active');
        });

        // Event listener untuk menutup sidebar saat diklik di luar area sidebar
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dashboard') && sideBar.classList.contains('active')) {
                sideBar.classList.remove('active');
                mainContent.classList.remove('active');
            }
        });
    })
    </script>
</body>

</html>