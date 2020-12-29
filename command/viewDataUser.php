<?php 
require_once 'database/configDB.php';

function viewCatatanUser($id_user){

    $queryViewCatatanUser = "SELECT no_absen, npm, nama_lengkap, mk FROM tb_mhs WHERE id_user = $id_user";
    $resultQueryView      = mysqli_query(connDB(), $queryViewCatatanUser);

    $message = "";

    if ($resultQueryView->num_rows > 0) {
        while ($viewDataCatatanUser = mysqli_fetch_assoc($resultQueryView)) {
            $resultCatatanUser = (object) $viewDataCatatanUser;
            $message .= "DATA ABSENSI MAHASISWA";
            $message .= "\n\n";
            $message .= "No Absensi : " . $resultCatatanUser->no_absen . PHP_EOL;
            $message .= "NPM : " . $resultCatatanUser->npm . PHP_EOL;
            $message .= "Nama Lengkap : " . $resultCatatanUser->nama_lengkap . PHP_EOL;
            $message .= "Mata Kuliah : " . $resultCatatanUser->mk . PHP_EOL;
            $message .= "Waktu Absensi : " . $resultCatatanUser->waktu . PHP_EOL;
            $message .= "\n\n";

        }
    }
    else{
        $message = "Data Absensi Masih Kosong!!";
    }

    return $message;
    
}

?>