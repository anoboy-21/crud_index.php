<?php
//Koneksi Database
$server = "localhost";
$user = "root";
$pass = "";
$database = "dbdata_mahasiswa";

$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

//Jika Tombol Simpan Di klik
if (isset($_POST['bsimpan'])) {
    //Pengujian apakah data akan di edit atau simpan baru
    if ($_GET['hal'] == "edit") {
        //Data akan di edit
        $edit = mysqli_query($koneksi, "UPDATE tabel_mahasiswa set
                                            nim = '$_POST[tnim]', 
                                            nama = '$_POST[tnama]',
                                            gender = '$_POST[tgender]',
                                            alamat = '$_POST[talamat]',
                                            prodi = '$_POST[tprodi]',
                                            semester = '$_POST[tsemester]'
                                            WHERE id_mhs = '$_GET[id]'
                                            ");
        if ($edit) // Jika edit Sukses
        {
            echo "<script>
                  alert('Edit data berhasil!');
                   document.location='index.php';
                </script>";
        } else {
            echo "<script>
            alert('Edit data gagal!');
             document.location='index.php';
          </script>";
        }
    } else {
        //Data akan di simpan baru
        $simpan = mysqli_query($koneksi, "INSERT INTO tabel_mahasiswa (nim, nama, gender, alamat, prodi, semester)
                                          VALUES ('$_POST[tnim]', 
                                                 '$_POST[tnama]', 
                                                 '$_POST[tgender]', 
                                                 '$_POST[talamat]', 
                                                 '$_POST[tprodi]', 
                                                 '$_POST[tsemester]')
                                            ");
        if ($simpan) // Jika Simpan Sukses
        {
            echo "<script>
                  alert('Simpan data berhasil!');
                   document.location='index.php';
                </script>";
        } else {
            echo "<script>
            alert('Simpan data gagal!');
             document.location='index.php';
          </script>";
        }
    }
}

//Pengujian tombol edit & hapus jika di klik
if (isset($_GET['hal'])) {
    //Pengujian edit data
    if ($_GET['hal'] == "edit") {
        // Tampilkan data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM tabel_mahasiswa WHERE id_mhs = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //Jika data ditemukan maka data akan di tempung ke dalam variable
            $vnim = $data['nim'];
            $vnama = $data['nama'];
            $vgender = $data['gender'];
            $valamat = $data['alamat'];
            $vprodi = $data['prodi'];
            $vsemester = $data['semester'];
        }
    } else if ($_GET['hal'] == "hapus") {
        //Persiapan penghapusan data
        $hapus = mysqli_query($koneksi, "DELETE  FROM tabel_mahasiswa WHERE id_mhs = '$_GET[id]'");
        if ($hapus) {
            echo "<script>
                alert('Hapus Data Berhasil!');
                 document.location='index.php';
              </script>";
        }
    }
}
?>

<!DOCTYPE html>
<htmal>

    <head>
        <title>CRUD PHP & MySQL + Bootstrap 4 </title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>

    <body>
        <div class="container">

            <h1 class="text-center">TUGAS BESAR PRAKTIKUM RPL</h1>
            <h2 class="text-center">C R U D @nano_sukarno</h2>

            <!--Awal Card From-->
            <?php
            if (isset($_GET['hal']) == 'edit') {
            ?>
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    Form Input Data Mahasiswa
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="tnim" value="<?= @$vnim ?>" class="form-control"
                                placeholder="Input nim anda disini!" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="tnama" value="<?= @$vnama ?>" class="form-control"
                                placeholder="Input nama anda disini!" required>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="tgender">
                                <option>-Pilih-</option>
                                <option value="Laki-laki" <?php echo ($vgender == "Laki-laki") ? "Selected" : ""; ?>>
                                    Laki-laki
                                </option>
                                <option value="Perempuan" <?php echo ($vgender == "Perempuan") ? "Selected" : ""; ?>>
                                    Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="talamat"
                                placeholder="Input alamat anda disini!"><?= @$valamat ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select class="form-control" name="tprodi">
                                <option>-Pilih-</option>
                                <option value="S1-Teknik Industri"
                                    <?php echo ($vprodi == "S1-Teknik Industri") ? "Selected" : ""; ?>>S1-Teknik
                                    Industri
                                </option>
                                <option value="S1-Teknik Elektro"
                                    <?php echo ($vprodi == "S1-Teknik Elektro") ? "Selected" : ""; ?>>S1-Teknik Elektro
                                </option>
                                <option value="S1-Teknik Informatika"
                                    <?php echo ($vprodi == "S1-Teknik Informatika") ? "Selected" : ""; ?>>S1-Teknik
                                    Informatika
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control" name="tsemester">
                                <option>-Pilih-</option>
                                <option value="1-(satu)" <?php echo ($vsemester == "1-(satu)") ? "Selected" : ""; ?>>
                                    1-(satu)</option>
                                <option value="2-(dua)" <?php echo ($vsemester == "2-(dua)") ? "Selected" : ""; ?>>
                                    2-(dua)
                                </option>
                                <option value="3-(tiga)" <?php echo ($vsemester == "3-(tiga)") ? "Selected" : ""; ?>>
                                    3-(tiga)</option>
                                <option value="4-(empat)" <?php echo ($vsemester == "4-(empat)") ? "Selected" : ""; ?>>
                                    4-(empat)</option>
                                <option value="5-(lima)" <?php echo ($vsemester == "5-(lima)") ? "Selected" : ""; ?>>
                                    5-(lima)</option>
                                <option value="6-(enam)" <?php echo ($vsemester == "6-(enam)") ? "Selected" : ""; ?>>
                                    6-(enam)</option>
                                <option value="7-(tujuh)" <?php echo ($vsemester == "7-(tujuh)") ? "Selected" : ""; ?>>
                                    7-(tujuh)</option>
                                <option value="8-(delapan)"
                                    <?php echo ($vsemester == "8-(delapan)") ? "Selected" : ""; ?>>8-(delapan)</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
                        <button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>

                    </form>
                </div>
            </div>
            <?php
            } else {
            ?>
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    Form Input Data Mahasiswa
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="tnim" value="" class="form-control"
                                placeholder="Input nim anda disini!" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="tnama" value="" class="form-control"
                                placeholder="Input nama anda disini!" required>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="tgender">
                                <option>-Pilih-</option>
                                <option value="Laki-laki">
                                    Laki-laki
                                </option>
                                <option value="Perempuan">
                                    Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="talamat"
                                placeholder="Input alamat anda disini!"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select class="form-control" name="tprodi">
                                <option>-Pilih-</option>
                                <option value="S1-Teknik Industri">S1-Teknik Industri
                                </option>
                                <option value="S1-Teknik Elektro">S1-Teknik Elektro
                                </option>
                                <option value="S1-Teknik Informatika">S1-Teknik Informatika
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control" name="tsemester">
                                <option>-Pilih-</option>
                                <option value="1-(satu)">1-(satu)</option>
                                <option value="2-(dua)">2-(dua)</option>
                                <option value="3-(tiga)">3-(tiga)</option>
                                <option value="4-(empat)">4-(empat)</option>
                                <option value="5-(lima)">5-(lima)</option>
                                <option value="6-(enam)">6-(enam)</option>
                                <option value="7-(tujuh)">7-(tujuh)</option>
                                <option value="8-(delapan)">8-(delapan)</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
                        <button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>

                    </form>
                </div>
            </div>
            <?php
            }
            ?>
            <!--Akhir Card From-->

            <!--Awal Card Tabel-->
            <div class="card mt-4">
                <div class="card-header bg-success text-white">
                    Daftar Mahasiswa
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Gender</th>
                            <th>Alamat</th>
                            <th>Program Studi</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT * from tabel_mahasiswa order by id_mhs desc");
                        while ($data = mysqli_fetch_array($tampil)) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['nim'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['gender'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['prodi'] ?></td>
                            <td><?= $data['semester'] ?></td>
                            <td>
                                <a href="index.php?hal=edit&id=<?= $data['id_mhs'] ?>" class="btn btn-warning">Edit
                                </a>
                                <a href="index.php?hal=hapus&id=<?= $data['id_mhs'] ?>"
                                    onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                    class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; //Penutup Perulangan While
                        ?>
                    </table>

                </div>
            </div>
            <!--Akhirl Card Tabel-->

        </div>
        <script type="text/javascript" scr="js/bootstrap.min.js"></script>
    </body>

    </html>