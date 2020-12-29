<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

require_once 'vendor/autoload.php';
require_once 'database/configDB.php';
$date = date("d/m/Y (h:i:s)");
$configs = [
    "telegram" => [
        "token" => file_get_contents("private/token.txt")
    ]
];

DriverManager::loadDriver(TelegramDriver::class);

$botman = BotManFactory::create($configs); 

// Command no @ to bot
$botman->hears("/start", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $lastname = $user->getLastName();
    $id_user = $user->getId();
    

    $bot->reply("Selamat Datang $firstname $lastname di bot absensi mahasiswa.\n\nSilahkan klik perintah /help untuk mengetahui menu yang tersedia pada bot ini $date");
    include "command/requestChat.php";
});

$botman->hears("/help", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    
    include "command/requestChat.php";
    
    $bot->reply("/data_absensi_mahasiswa => Untuk melihat data absensi mahasiswa");
    $bot->reply("/cari_mahasiswa => Untuk mencari data per mahasiswa");
    $bot->reply("/absensi_mahasiswa => Untuk mahasiswa melakukan absensi");
});

$botman->hears("/data_absensi_mahasiswa", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    include "command/requestChat.php";
    include "command/viewDataUser.php";

    $message = viewCatatanUser($id_user);
    $bot->reply($message);

});

$botman->hears("/absensi_mahasiswa", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    include "command/requestChat.php";
    $bot->reply("Format Absensi :\n\n/absensi_mahasiswa [NPM]_[Nama Lengkap]\n\n*Tanpa Tanda Kurung []");
});

$botman->hears("/absensi_mahasiswa {npm}_{nama_lengkap}", function (Botman $bot, $npm, $nama_lengkap) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    
    $npm = $npm;
    $nama_lengkap = $nama_lengkap;
    
    include "command/requestChat.php";
    include "command/insertData.php";

    $message = insertData($id_user, $npm, $nama_lengkap);
    $bot->reply($message);

});

$botman->hears("/cari_mahasiswa", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    include "command/requestChat.php";
    $bot->reply("Format Cari Data Absensi Mahasiswa :\n\n/cari_mahasiswa [No Absensi]\n\n*Tanpa Tanda Kurung []");
});

$botman->hears("/cari_mahasiswa {no_absen}", function (Botman $bot, $no_absen) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    include "command/requestChat.php";
    
    $no_absen = $no_absen;
    
    include "command/cariData.php";

    $message = cariDataCatatan($id_user, $no_absen);
    $bot->reply($message);

});

// command not found
$botman->fallback(function (BotMan $bot) {
    $message = $bot->getMessage()->getText();
    $bot->reply("Maaf, Perintah Ini '$message' Tidak Ada");
});


$botman->listen();