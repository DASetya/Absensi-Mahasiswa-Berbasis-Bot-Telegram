<?php 
require_once 'database/configDB.php';


function insertData($id_user, $npm, $nama_lengkap){
    $date = date("d/m/Y (h:i:s)");
    
    $queryInsertCatatan = "INSERT INTO tb_mhs (npm, nama_lengkap, mk, id_user, waktu) VALUES ('$npm', '$nama_lengkap', 'Pemrograman Web', '$id_user'.'$date')";
    $resultQueryInsert  = mysqli_query(connDB(), $queryInsertCatatan);

    if ($resultQueryInsert) {
    	$message = "Terima kasih anda telah melakukan absensi";
    }
    else{
    	$message = "Anda gagal melakukan absensi, Mohon cek kembali";
    }
    
    return $message;
}

?>