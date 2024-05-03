<?php 
include_once 'config/conn.php';

class dashboardModel {


    static function getAll(){
        global $conn;
        $conn->begin_transaction();
        $stmt = $conn->prepare("SELECT * FROM film");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    static function login($phone, $password) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM regist WHERE phone = ? AND password = ?");
        $stmt->bind_param("ss", $phone, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            return true; // Login berhasil
        } else {
            return false; // Login gagal
        }
    }

    static function regist($email, $nama, $phone, $password) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO regist (email, nama, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $nama, $phone, $password);
        $success = $stmt->execute();
        $stmt->close();
    
        return $success; // Mengembalikan true jika insert berhasil, false jika gagal
    }

    static function getFilm($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM film WHERE id = ?");
        $stmt->bind_param("i", $id); // Mengikat parameter dengan tipe data integer
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        // Mengembalikan hasil query
        return $result;
    }

    static function updateFilm($newid, $newjudul, $newrate, $newstatus, $foto_path) {
        global $conn;
        $stmt = $conn->prepare("UPDATE film SET judul=?, rate=?, status=?, poster=? WHERE id=?");
        $stmt->bind_param("ssssi", $newjudul, $newrate, $newstatus, $foto_path, $newid);
        
        // Jalankan pernyataan
        $stmt->execute();
        $conn->commit();
        return true;
    }
    

    static function updateFilmwithoutposter($newid, $newjudul, $newrate, $newstatus) {
        global $conn;
        $stmt = $conn->prepare("UPDATE film SET judul=?, rate=?, status=? WHERE id=?");
        $stmt->bind_param("sssi", $newjudul, $newrate, $newstatus, $newid);
        
        // Jalankan pernyataan
        $stmt->execute();
        $conn->commit();
        return true;
    }

    static function tambahFilm($judul, $rate, $status, $nama_file){
        global $conn;
        $stmt = $conn->prepare("INSERT INTO film (judul, rate, status, poster) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $judul, $rate, $status, $nama_file);
        
        // Jalankan pernyataan
        $stmt->execute();
        
        // Periksa apakah penambahan film berhasil
        $success = $stmt->affected_rows > 0;
        
        // Tutup statement
        $stmt->close();
    
        return $success;
    }

    static function deleteFilmByid($id){
        global $conn;
        $stmt = $conn->prepare("DELETE FROM film WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    

}



// static function getAll(){
//     global $conn;
//     $conn->begin_transaction();
//     $stmt = $conn->prepare("SELECT id, nama, email, no_hp, bidang, status, foto_profil FROM db_pegawai");
//     $stmt->execute();
//     $result = $stmt->get_result();
//     return $result;
// }

// static function insertData($nama, $email, $no_hp, $bidang, $status, $foto_path) {
//     global $conn;

//     // Persiapkan dan jalankan query dengan parameterized queries
//     $stmt = $conn->prepare("INSERT INTO db_pegawai (nama, email, no_hp, bidang, status, foto_profil) VALUES (?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("ssssss", $nama, $email, $no_hp, $bidang, $status, $foto_path);
    
//     // Jalankan pernyataan
//     $stmt->execute();
//     $conn->commit();
//     return true;
// }

// static function getAllByid($id){
//     global $conn;
//     $conn->begin_transaction();
//     $stmt = $conn->prepare("SELECT * FROM db_pegawai WHERE id = ?");
//     $stmt->bind_param("i", $id);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     return $result;
// }


// static function updateData($new_nama, $new_email, $new_no_hp, $new_bidang, $new_status, $id) {
//     global $conn;
//     $stmt = $conn->prepare("UPDATE db_pegawai SET nama=?, email=?, no_hp=?, bidang=?, status=? WHERE id=?");
//     $stmt->bind_param("sssssi", $new_nama, $new_email, $new_no_hp, $new_bidang, $new_status, $id);
    
//     if ($stmt->execute()) {
//         $stmt->close();
//         return true;
//     } else {
//         $stmt->close();
//         return false;
//     }
// }

// static function deleteDataByid($id){
//     global $conn;
//     $stmt = $conn->prepare("DELETE FROM db_pegawai WHERE id=?");
//     $stmt->bind_param("i", $id);
    
//     if ($stmt->execute()) {
//         $stmt->close();
//         return true;
//     } else {
//         $stmt->close();
//         return false;
//     }
// }
    