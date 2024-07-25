<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kereta = $_POST["nama_kereta"];
    $stasiun_asal = $_POST["stasiun_asal"];
    $stasiun_tujuan = $_POST["stasiun_tujuan"];
    $waktu_berangkat = $_POST["waktu_berangkat"];
    $waktu_tiba = $_POST["waktu_tiba"];
    $harga_tiket = $_POST["harga_tiket"];
    $kelas = $_POST["kelas"];

    $data = array(
        'nama_kereta' => $nama_kereta,
        'stasiun_asal' => $stasiun_asal,
        'stasiun_tujuan' => $stasiun_tujuan,
        'waktu_berangkat' => $waktu_berangkat,
        'waktu_tiba' => $waktu_tiba,
        'harga_tiket' => $harga_tiket,
        'kelas' => $kelas
    );

    // Konversi data ke format JSON
    $data_json = json_encode($data);

    // URL endpoint API
    $url = 'http://localhost/jadwal/Schedules';

    // Pengaturan request ke API
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json\r\n",
            'method' => 'POST',
            'content' => $data_json
        )
    );

    // Kirim request ke API
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    // Cek apakah request berhasil
    if ($result === FALSE) {
        // Gagal mengirim data ke API
        echo "Gagal mengirim data ke API.";
    } else {
        // Berhasil mengirim data ke API
        echo "Data berhasil dikirim ke API.";
    }
}
?>
