<?php 

function connDB() {

   $dbServer = 'localhost';
   $dbUser = 'id15062282_kelompok_web';
   $dbPass = '*t+D7YlIQ{}vT2jc';
   $dbName = "id15062282_kelompok4";

   $conn = mysqli_connect($dbServer, $dbUser, $dbPass);

   if(!$conn) {
         die('Koneksi gagal: ' . mysqli_error());
   }
   
   mysqli_select_db($conn, $dbName);
  
   return $conn;
}