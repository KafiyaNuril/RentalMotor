<?php
class rental
{
    public $nama;
    protected static $member = ["Caca", "caca", "kafiya", "dhino", "kika", "keyla", "Kafiya", "Dhino", "Kika", "Keyla"], // List member
                    $Scooter = 70000,
                    $Matic = 80000,
                    $Retro = 90000,
                    $DualSport = 100000,
                    $diskon = 0.05,
                    $pajak = 10000,
                    $totalrental,
                    $hasilDiskon;

    public function __construct($nama)
    {
        $this->nama = $nama;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function hitungRental($jenis, $waktu)
    {
       return self::$totalrental = ($waktu * self::$$jenis) + self::$pajak;
    }
    
    public function rentalDiskon($jenis,$waktu)
    {
       return self::$hasilDiskon = ($waktu * self::$$jenis) + self::$pajak - (($waktu * self::$$jenis) * self::$diskon);
    }
}

class motor extends rental
{
    public function __construct($nama, $jenis, $waktu)
    {
        parent::__construct($nama);
        parent::hitungRental($jenis, $waktu);
        parent::rentalDiskon($jenis, $waktu);

        if(in_array($nama, parent::$member)) {
            echo "<div class='border border-black text-center'><br>";
            echo $nama . " berstatus sebagai Member mendapatkan diskon sebesar 5% <br> Jenis motor yang dirental adalah " . $jenis . " selama " . $waktu . " hari <br> Harga rental per-harinya : " . number_format(self::$$jenis, 2, ',', '.') . "<br/> Besar yang harus dibayarkan adalah Rp. " . number_format(parent::$hasilDiskon, 2, ',', '.') . "</br>";
            echo "<a href='/' class='btn btn-secondary stretched-link w-25'>Reset</a></br><br>";
            echo "</div>";
        } else {
            echo "<div class='border border-black text-center'><br>";
            echo $nama . " berstatus Bukan sebagai Member <br> Jenis motor yang dirental adalah " . $jenis . " selama " . $waktu . " hari <br> Harga rental per-harinya : " . number_format(self::$$jenis, 2, ',', '.') . "<br/> Besar yang harus dibayarkan adalah Rp. " . number_format(parent::$totalrental, 2, ',', '.') . "</br>";
            echo "<a href='/' class='btn btn-secondary stretched-link w-25'>Reset</a><br><br>";
            echo "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        *   {
                font-family: 'Times New Roman', Times, serif;
            }
    </style>
</head>
<body class="bg-secondary-subtle">
    <div class="d-flex justify-content-center mt-5">
        <div class="card border border-secondary border-1" style="width: 40rem;">
            <h2 class="text-center mt-2">Rental Motor</h2>
            <div class="card-body">
                <form action="" method="POST">
                    <div>
                        <label for="nama">Nama Pelanggan:</label>
                        <input class="form-control" type="text" name="nama" id="nama">
                    </div>
                    <div>
                        <label for="waktu">Lama Waktu Rental (per hari):</label>
                        <input class="form-control" type="number" name="waktu" id="waktu" min="1">
                    </div>
                    <div>
                        <label for="jenis">Jenis Motor:</label>
                        <select class="form-control form-select" name="jenis" id="jenis">
                            <option hidden disabled selected>Pilih Jenis Motor</option>
                            <option value="Scooter">Scooter</option>
                            <option value="Matic">Matic</option>
                            <option value="Retro">Retro</option>
                            <option value="DualSport">Dual-Sport</option>
                        </select>
                    </div><br>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary w-25"><br><br>
                </form>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (isset($_POST['jenis']) && isset($_POST['waktu']) && $_POST['nama']) {
                            $nama = $_POST['nama'];
                            $jenis = $_POST['jenis'];
                            $waktu = $_POST['waktu'];
                            new motor($nama, $jenis, $waktu);
                        } else {
                            echo "<div class='text-danger text-center'><br>Masukkan data dengan benar !</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
