<?php
// Connect Database
require "vendor/autoload.php";

$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "excel_to_mysql";

$konek = mysqli_connect($host,$user,$pass,$db);
// Connect Database End

// Import Feature
if(isset($_POST['submit'])) {
    $error = "";
    $extention = "";
    $success = "";

    $file_name = $_FILES['filexls']['name']; // mendaptkan name file yang diupload
    $file_data = $_FILES['filexls']['tmp_name']; // mendapatkan temporary data

    if(empty($file_name)){
        $error .= "<li>Silahkan masukkan file yang kamu inginkan</li>";
    } else {
        $extention = pathinfo($file_name)['extension'];
    }

    $extention_allowed = array("xls","xlsx","csv");

    if(!in_array($extention,$extention_allowed)) {
        $error .= "<li>Silahkan masukkan file tipe xls atau xlsx, File yang kamu masukkan <b>$file_name</b> dengan ekstensi <b>$extention</b></li>";
    }

    if(empty($error)){
        // createReaderForFile = menentukan reader yang akan digunakan, apakah file yg di upload adalah file xls / xlsx / csv
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
        $spreadsheet = $reader->load($file_data); // melakukan load data
        $sheetData = $spreadsheet->getActiveSheet()->toArray(); // memastikan sheet yang diload adalah sheet yang sedang aktif

        // Membuat Function untuk mengambil nama hari dari tanggal
        function nama_hari($dayName){
            // mengubah tanggal menjadi hari
            $day = date('N', strtotime($dayName));
            // membuat array nama hari
            $array_nama_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");

            return $array_nama_hari[$day];
        }

        // function untuk mengambil tanggal
        function ambilTanggal($ambilTanggal) {
            
            return $ambilTanggal;
        }
        

        // mengetahu jumlah data yang diupload
        $jumlahData = 0;
        $tanggalAwal = $sheetData[0][3];
        // $mergeTanggal = $sheetData[0][]
        for( $tgl = 3; $tgl < count($sheetData[0]); $tgl++) {
            $tanggal = $sheetData[0][$tgl];
            // $tanggal = date($tanggal);

            // if ($tanggal >= "2023-12-01") {
            if (!empty($tanggal)) {
            //     $error .= "<li>Silahkan masukkan file yang kamu inginkan</li>";
            // } else {
                for( $i = 2; $i < count($sheetData); $i++){
                    $nip = $sheetData[$i][1];
                    $hari = nama_hari($tanggal);
                    
                    // Mengatur agar $jam_masuk, $jam_pulang, dan $keterangan loncat 4 kolom
                    $jam_masuk_index = $tgl;
                    $jam_pulang_index = $tgl + 2;
                    $keterangan_index = $tgl + 3;

                    $jam_masuk = $sheetData[$i][$jam_masuk_index];
                    $jam_pulang = $sheetData[$i][$jam_pulang_index];
                    $keterangan = $sheetData[$i][$keterangan_index];

                    // echo "$nip, $hari, $tanggal, $jam_masuk, $jam_pulang, $keterangan <br>";

                    // Memasukkan data ke MySQL
                    $sql1 = "insert into `absensi`(`nip`,`hari`,`tanggal`,`jam_masuk`,`jam_pulang`,`keterangan`) values('$nip', '$hari', '$tanggal', '$jam_masuk', '$jam_pulang', '$keterangan')";

                    mysqli_query($konek, $sql1);

                    $jumlahData++;
                }

                if($jumlahData > 0){
                    $success = "<b>$file_name</b> berhasil diupload";
                }
            }
        }
    }

    if($error){
        ?>
        <div class="alert alert-danger">
           <ul><?= $error ?></ul>
        </div>
        <?php
    }

    if($success){
        ?>
        <div class="alert alert-success">
            <?= $success ?>
        </div>
        <?php
    }
}










?>