<?php 

include_once 'Models/dashboard_model.php';


class dashboardController{

    static function index(){
        $data = dashboardModel::getAll();
        // var_dump($data);
        
        return view('dashboard', ['result' => $data]);
    }

    // regits
    static function regist() {
        if (isset($_POST["email"]) && isset($_POST["nama"]) && isset($_POST["phone"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $nama = $_POST["nama"];
            $phone = $_POST["phone"];
            $password = $_POST["password"];
    
            $regist_result = dashboardModel::regist($email, $nama, $phone, $password);
            
            if ($regist_result) {
                echo '<script>alert("Berhasil.");</script>';
                header("Location: " . BASEURL . "login");
                exit();
            } else {
                // Registrasi gagal
                echo '<script>alert("Registrasi gagal. Silakan coba lagi.");</script>';
            }
        } else {
            // Jika data POST tidak lengkap
            echo '<script>alert("Data registrasi tidak lengkap. Silakan coba lagi.");</script>';
        }
    }
      

    // Login Auth
    static function login() {
        if (isset($_POST["phone"]) && isset($_POST["password"])) {
            $phone = $_POST["phone"];
            $password = $_POST["password"];
    
            $login_result = dashboardModel::login($phone, $password);
            
            if ($login_result) {
                header("Location: " . BASEURL . "dashboard");
                exit();
            } else {
                // Login gagal
                echo '<script>alert("Login gagal. Silakan coba lagi.");</script>';
                return view('login');
        }
    } else {
        // Jika data POST tidak lengkap
        echo '<script>alert("Data login tidak lengkap. Silakan coba lagi.");</script>';
        return view('login');

    }
    }


    // edit FIlm

    static function editFilm() {
        // Periksa apakah ID film diteruskan melalui URL
        
        if (isset($_POST['id'], $_POST['judul'], $_POST['rate'], $_POST['status'])) {
            // Tangkap data yang diterima
            $newid = $_POST['id'];
            $newjudul = $_POST['judul'];
            $newrate = $_POST['rate'];
            $newstatus = $_POST['status'];
        
            // Inisialisasi variabel foto_path
            $foto_path = '';
        
            // Periksa apakah ada file gambar yang diunggah
            if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
                $foto_name = $_FILES['poster']['name'];
                $foto_temp = $_FILES['poster']['tmp_name'];
                $foto_folder = "uploads/";
                $foto_path = $foto_folder . $foto_name;
        
                // Pindahkan file gambar yang diunggah ke folder uploads
                if (move_uploaded_file($foto_temp, $foto_path)) {
                    // Panggil fungsi updateFilm untuk memperbarui data film dengan poster
                    $success = dashboardModel::updateFilm($newid, $newjudul, $newrate, $newstatus,  $foto_path);
        
                    // Jika pembaruan berhasil, arahkan ke halaman dashboard
                    if ($success) {
                        header("Location: " . BASEURL . "dashboard");
                        exit();
                    } else {
                        echo "Gagal menyimpan data. Silakan coba lagi.";
                    }
                } else {
                    echo "Gagal mengunggah file gambar.";
                }
            } else {
                // Panggil fungsi updateFilmwithoutposter untuk memperbarui data film tanpa poster
                $success = dashboardModel::updateFilmwithoutposter($newid, $newjudul, $newrate, $newstatus);
                
                // Jika pembaruan berhasil, arahkan ke halaman dashboard
                if ($success) {
                    header("Location: " . BASEURL . "dashboard");
                    exit();
                } else {
                    echo "Gagal menyimpan data. Silakan coba lagi.";
                }
            }
        }
        

        if (isset($_GET['id'])) {
            // Dapatkan ID film dari parameter URL
            $id = intval($_GET['id']);
            $result = dashboardModel::getFilm($id);
    
            // Periksa apakah ada hasil
            if ($result->num_rows > 0) {
                // Ambil data film
                $row = $result->fetch_assoc();
                $judul = $row['judul'];
                $rate = $row['rate'];
                $status = $row['status'];
                $poster = $row['poster']; 
    
                // Mengirim data film ke view edit
                return view('crudViews/edit', ['judul' => $judul, 'rate' => $rate, 'status' => $status, 'poster' => $poster , 'id'=>$id]);
            } else {
                // Jika tidak ada hasil, tampilkan pesan error
                echo '<script>alert("Film tidak ditemukan.");</script>';
            }
        } else {
            // Jika ID film tidak ditemukan dalam URL, tampilkan pesan error
            echo '<script>alert("ID film tidak ditemukan dalam URL.");</script>';
        }
    }


    // tambah film

    static function tambahFilm(){
        // Periksa apakah data yang diperlukan tersedia
        if (isset($_POST['judul'], $_POST['rate'], $_POST['status'], $_FILES['poster'])) {
            $judul = $_POST['judul'];
            $rate = $_POST['rate'];
            $status = $_POST['status'];
    
            // Ambil nama file gambar
            $nama_file = $_FILES['poster']['name'];
            $lokasi = 'uploads/';
    
            // Periksa apakah file gambar berhasil diunggah
            if(move_uploaded_file($_FILES['poster']['tmp_name'], $lokasi.$nama_file)){
                // Panggil fungsi tambahFilm dari model dan kirimkan data film
                $success = dashboardModel::tambahFilm($judul, $rate, $status, $nama_file);
                
                // Jika penambahan film berhasil, arahkan ke halaman dashboard
                if ($success) {
                    header("Location: " . BASEURL . "dashboard");
                    exit();
                } else {
                    echo "Gagal menambahkan film. Silakan coba lagi.";
                }
            } else {
                echo "Gagal mengunggah file gambar.";
            }
        } else {
            echo "Data tidak lengkap.";
        }
    }

    // delete film 
    static function deleteFilm(){
        $id = intval($_GET['id']);
        // var_dump($id);
        $success = dashboardModel::deleteFilmByid($id);
        if($success) {
            $data = dashboardModel::getAll();
            echo '<script>alert("Data berhasil dihapus.");</script>';
            return view('dashboard',['result' => $data]);         
        } else {
            echo '<script>alert("GAGAL.");</script>';
            $data = dashboardModel::getAll();
            return view('dashboard',['result' => $data]);         
        }
    }
    
    


}