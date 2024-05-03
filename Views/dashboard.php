<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/styles1.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="logout">
        <button id="logoutBtn">Logout</button>
    </div>
    <div class="container">
        <div class="dashboard">
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
            <div class="side-bar">
                <div class="menu">
                    <!-- Tambahkan id "dashboardItem" pada item dashboard -->
                    <div class="item" id="dashboardItem"><a href="<?= urlpath('dashboard');?>"><i
                                class="fas fa-chart-line"></i>
                            Dashboard</a></div>
                    <!-- Ganti id dari rofileItem menjadi TambahItem -->
                    <div class="item" id="TambahItem"><a href="<?= urlpath('tambahFilm');?>"><i class="fas fa-user"></i>
                            Tambah Data</a>
                    </div>
                    <div class="item" id="EditItem"><a><i class="fas fa-cogs"></i> Edit</a></div>
                    <!-- Ganti id dari settingsItem menjadi settingsItem -->
                    <div class="item" id="settingsItem"><a><i class="fas fa-cogs"></i>
                            Settings</a>
                    </div>
                </div>
            </div>
        </div>

        <?php // Sertakan file koneksi.php

        // Periksa apakah ada baris hasil
        if ($result->num_rows > 0) {
            // Mulai tabel HTML
            echo "<div class='main-content table-container'>"; // Tambahkan kelas table-container di sini
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Rate</th>
                        <th>Status</th>
                        <th>Poster</th>
                        <th>Aksi</th> <!-- Tambahkan kolom Aksi -->
                    </tr>";

            // Output data dari setiap baris
            $count = 1; 
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $count++ . "</td>"; 
                echo "<td>" . $row['judul'] . "</td>";
                echo "<td>" . $row['rate'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td><img src='" . BASEURL . "/uploads/" . $row['poster'] . "' alt='Poster' style='width:100px;'></td>"; 
                echo "<td>
                        <a href='" . urlpath('editFilm') . "?id=" . $row["id"] . "' class='edit-btn'>Edit</a>
                        <a href='" . urlpath('deleteFilm') . "?id=" . $row["id"] . "' class='edit-btn' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</i></a>
                      </td>";
                echo "</tr>";
            }
            
            // Selesai tabel HTML
            echo "</table>";
            echo "</div>";
        } else {
            // Jika tidak ada data film
            echo "<div class='main-content'>";
            echo "<h1>Tidak ada data film.</h1>";
            echo "</div>";
        }
        ?>


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


        // Atur gaya untuk item menu yang sedang dibuka saat halaman dimuat
        dashboardItem.classList.contains('active') ? dashboardItem.style.fontWeight = 'bold' : null;
        TambahItem.classList.contains('active') ? TambahItem.style.fontWeight = 'bold' : null;
        settingsItem.classList.contains('active') ? settingsItem.style.fontWeight = 'bold' : null;

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