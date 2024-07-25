<?php
require_once "method.php";

// Instansiasi objek untuk jadwal keberangkatan kereta
$jadwal_kereta = new jadwal_kereta();

// Menyimpan jenis HTTP METHOD dalam request
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $jadwal_kereta->get_jadwal_kereta($id);
        } else {
            $jadwal_kereta->get_jadwal_keretas();
        }
        break;
    case 'POST':
        $jadwal_kereta->insert_jadwal_kereta();
        break;
    case 'PUT':
        $id = intval($_GET["id"]);
        $jadwal_kereta->update_jadwal_kereta($id);
        break;
    case 'DELETE':
        $id = intval($_GET["id"]);
        $jadwal_kereta->delete_jadwal_kereta($id);
        break;
    default:
        
        header("HTTP/1.1 405 Method Not Allowed");
        break;
}
?>
