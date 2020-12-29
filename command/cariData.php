<?php 
require_once 'database/configDB.php';


function cariDataCatatan($id_user, $no_absen){
	// pengecekan data terlebih dahulu sebelum di eksekusi
	$queryCariDataCatatan = "SELECT * FROM tb_mhs WHERE id_user = $id_user AND no_absen=$no_absen";
	$resultQueryFlag  = mysqli_query(connDB(), $queryCariDataCatatan); 

    $message = "";

    // ketika data ada dan sesuai eksekusi bro
    if ($resultQueryFlag->num_rows > 0) {
        while ($viewDataCatatanUser = mysqli_fetch_assoc($resultQueryFlag)) {
            $resultCatatanUser = (object) $viewDataCatatanUser;
            
            $message .= "No Absensi : " . $resultCatatanUser->no_absen . PHP_EOL;
            $message .= "NPM : " . $resultCatatanUser->npm . PHP_EOL;
            $message .= "Nama Lengkap : " . $resultCatatanUser->nama_lengkap . PHP_EOL;
            $message .= "Mata Kuliah : " . $resultCatatanUser->mk . PHP_EOL;
            $message .= "Waktu Absensi : " . $resultCatatanUser->waktu . PHP_EOL;
            $message .= "\n";

        }
    }
    else {
        $message = "Data Absensi Masih Kosong!!";
    }
    
    return $message;
}

?>