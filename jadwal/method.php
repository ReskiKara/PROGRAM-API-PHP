<?php
require_once "koneksi.php";

class jadwal_kereta 
{
    private function send_json_response($response) {
        header('Content-Type: application/json');
        $json_response = json_encode($response);
        if (json_last_error() !== JSON_ERROR_NONE) {
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode(array(
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server saat menulis JSON.'
            ));
        } else {
            echo $json_response;
        }
    }

    public function get_jadwal_keretas()
    {
        global $mysqli;
        $query = "SELECT * FROM JadwalKereta";
        $data = array();
        
        if ($result = $mysqli->query($query)) {
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
            $result->close();
            $response = array(
                'status' => 200,
                'message' => 'Berhasil Menampilkan Jadwal Kereta.',
                'data' => $data
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server.'
            );
        }

        $this->send_json_response($response);
    }

    public function get_jadwal_kereta($id)
    {
        global $mysqli;
        $query = "SELECT * FROM JadwalKereta WHERE id = ?";
        
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_object()) {
                    $data[] = $row;
                }
                $response = array(
                    'status' => 200,
                    'message' => 'Berhasil mengambil jadwal kereta.',
                    'data' => $data
                );
                header("HTTP/1.1 200 OK");
            } else {
                $response = array(
                    'status' => 404,
                    'message' => 'Data jadwal kereta tidak ditemukan.'
                );
                header("HTTP/1.1 404 Not Found");
            }
            $stmt->close();
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server.'
            );
            header("HTTP/1.1 500 Internal Server Error");
        }

        $this->send_json_response($response);
    }

    public function insert_jadwal_kereta()
    {
        global $mysqli;
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $response = array(
                'status' => 400,
                'message' => 'Format JSON tidak sesuai.'
            );
            header("HTTP/1.1 400 Bad Request");
            $this->send_json_response($response);
            return;
        }
        
        $required_fields = array('nama_kereta', 'stasiun_asal', 'stasiun_tujuan', 'waktu_berangkat', 'waktu_tiba', 'harga_tiket', 'kelas');
        foreach ($required_fields as $field) {
            if (!isset($data[$field])) {
                $response = array(
                    'status' => 400,
                    'message' => 'Parameter ' . $field . ' tidak ada atau kosong.'
                );
                header("HTTP/1.1 400 Bad Request");
                $this->send_json_response($response);
                return;
            }
        }

        $query = "INSERT INTO JadwalKereta (nama_kereta, stasiun_asal, stasiun_tujuan, waktu_berangkat, waktu_tiba, harga_tiket, kelas) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("sssssss", 
                $data['nama_kereta'], 
                $data['stasiun_asal'], 
                $data['stasiun_tujuan'], 
                $data['waktu_berangkat'], 
                $data['waktu_tiba'], 
                $data['harga_tiket'], 
                $data['kelas']
            );
            if ($stmt->execute()) {
                $response = array(
                    'status' => 201,
                    'message' => 'Jadwal Kereta Berhasil Ditambahkan.'
                );
                header("HTTP/1.1 201 Created");
            } else {
                $response = array(
                    'status' => 500,
                    'message' => 'Jadwal Kereta Gagal Ditambahkan.'
                );
                header("HTTP/1.1 500 Internal Server Error");
            }
            $stmt->close();
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server.'
            );
            header("HTTP/1.1 500 Internal Server Error");
        }

        $this->send_json_response($response);
    }

    public function update_jadwal_kereta($id)
    {
        global $mysqli;
        $data = json_decode(file_get_contents("php://input"), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $response = array(
                'status' => 400,
                'message' => 'Format JSON tidak sesuai.'
            );
            header("HTTP/1.1 400 Bad Request");
            $this->send_json_response($response);
            return;
        }

        $required_fields = array('nama_kereta', 'stasiun_asal', 'stasiun_tujuan', 'waktu_berangkat', 'waktu_tiba', 'harga_tiket', 'kelas');
        foreach ($required_fields as $field) {
            if (!isset($data[$field])) {
                $response = array(
                    'status' => 400,
                    'message' => 'Parameter ' . $field . ' tidak ada atau kosong.'
                );
                header("HTTP/1.1 400 Bad Request");
                $this->send_json_response($response);
                return;
            }
        }

        $query = "UPDATE JadwalKereta SET nama_kereta = ?, stasiun_asal = ?, stasiun_tujuan = ?, waktu_berangkat = ?, waktu_tiba = ?, harga_tiket = ?, kelas = ? WHERE id = ?";
        
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("sssssssi", 
                $data['nama_kereta'], 
                $data['stasiun_asal'], 
                $data['stasiun_tujuan'], 
                $data['waktu_berangkat'], 
                $data['waktu_tiba'], 
                $data['harga_tiket'], 
                $data['kelas'], 
                $id
            );
            if ($stmt->execute()) {
                $response = array(
                    'status' => 200,
                    'message' => 'Jadwal Kereta berhasil diperbarui.'
                );
                header("HTTP/1.1 200 OK");
            } else {
                $response = array(
                    'status' => 500,
                    'message' => 'Jadwal Kereta gagal diperbarui.'
                );
                header("HTTP/1.1 500 Internal Server Error");
            }
            $stmt->close();
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server.'
            );
            header("HTTP/1.1 500 Internal Server Error");
        }

        $this->send_json_response($response);
    }

    public function delete_jadwal_kereta($id)
    {
        global $mysqli;
        $query = "DELETE FROM JadwalKereta WHERE id = ?";
        
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $response = array(
                    'status' => 200,
                    'message' => 'Jadwal Kereta berhasil dihapus.'
                );
                header("HTTP/1.1 200 OK");
            } else {
                $response = array(
                    'status' => 500,
                    'message' => 'Jadwal Kereta gagal dihapus.'
                );
                header("HTTP/1.1 500 Internal Server Error");
            }
            $stmt->close();
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server.'
            );
            header("HTTP/1.1 500 Internal Server Error");
        }

        $this->send_json_response($response);
    }
}

?>
