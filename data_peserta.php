<?php 

include 'config/koneksi.php';
include 'library/controller.php';


    $go = new controller();
    $table = "tbl_peserta";
    @$field = array(
        'nama_lengkap' => $_POST['nama_lengkap'],
        'jk' => $_POST['jk'],
        'alamat' => $_POST['alamat'],
        'agama' => $_POST['agama'],
        'asal_smp' => $_POST['asal_smp'],
        'jurusan' => $_POST['jurusan']
    );

    $redirect = "?menu=data_peserta";
    @$where = "no_daftar= $_GET[no_daftar]";

    if (isset($_POST['simpan'])) {
        $go->simpan($con, $table, $field, $redirect);
    }
    if (isset($_GET['hapus'])) {
        $go->hapus($con, $table, $where, $redirect);
    }
    if (isset($_GET['edit'])) {
        $edit = $go->edit($con, $table, $where);
    }
    if (isset($_POST['ubah'])) {
        $go->ubah($con, $table, $field, $where, $redirect);
    }
    if (isset($_POST['cetak'])) {
        $go->cetak($con, $table, $field, $where);
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Pendaftaran Peserta</title>
  </head>
  <body>
  <div class="container-fluid" id= "content" >
        <div class="card">
            <div class="card-header">
                Form Peserta
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="<?php echo @$edit['nama_lengkap'] ?>" id="exampleFormControlInput1" placeholder="Masukan Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-bold">Jenis Kelamin</label>
                        <select class="form-select" name="jk" aria-label="Default select example" required>
                            <option selected disabled required>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-bold">Alamat</label>
                        <textarea type="text" name="alamat" class="form-control" value="<?php echo @$edit['alamat'] ?>" id="exampleFormControlInput1" placeholder="Masukan Alamat" required ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-bold">Agama</label>
                        <input type="text" name="agama" class="form-control" value="<?php echo @$edit['agama'] ?>" id="exampleFormControlInput1" placeholder="Masukan Agama" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-bold">Asal SMP</label>
                        <input type="text" name="asal_smp" class="form-control" value="<?php echo @$edit['asal_smp'] ?>" id="exampleFormControlInput1" placeholder="Masukan Asal SMP" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-bold">Jurusan</label>
                        <select class="form-select" name="jurusan" aria-label="Default select example" required>
                            <option selected disabled required>Pilih Jurusan</option>
                            <option value="RPL">RPL</option>
                            <option value="MMD">MMD</option>
                            <option value="TKJ">TKJ</option>
                            <option value="BDP">BDP</option>
                            <option value="OTKP">OTKP</option>
                            <option value="TBG">TBG</option>
                        </select>
                    </div>
                    <?php if(@$_GET['no_daftar'] ==""){ ?>
                        <input type="submit" class="btn btn-primary" name="simpan" value="Simpan Data">
                    <?php }else{ ?>
                        <input type="submit" class="btn btn-warning" name="ubah" value="Ubah Data">
                    <?php } ?>
            </form>
            </div>
        </div>
    <div class="container-fluid" id="content" >
        <div class="card">
            <div class="card-body">
                <div style="padding:10px;">
                    <div class="table-responsive">
                        <table align="center" border="1" class="mt-4 table table-stripped table-hover bg-white" id="data">
                            <tr>
                                <th>No Dafrar</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Agama</th>
                                <th>Asal SMP</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                                $sql = "SELECT * FROM tbl_peserta ";
                                $go = mysqli_query($con, $sql);
                                while($r = mysqli_fetch_array($go)){
                            ?>
                            <tr>
                                <td><?php echo $r['no_daftar']?></td>
                                <td><?php echo $r['nama_lengkap']?></td>
                                <td><?php echo $r['jk']?></td>
                                <td><?php echo $r['alamat']?></td>
                                <td><?php echo $r['agama']?></td>
                                <td><?php echo $r['asal_smp'] ?></td>
                                <td><?php echo $r['jurusan']?></td>
                                <td><a href="?menu=data_peserta&edit&no_daftar=<?php echo $r['no_daftar']?>" class="btn btn-warning">Edit</a>
                                <a href="?menu=data_peserta&hapus&no_daftar=<?php echo $r['no_daftar']?>"class="btn btn-danger" onclick="return confirm('Hapus Data?')">Hapus</a>
                                <a class="btn btn-success" href="cetakpeserta.php?menu=cetakpeserta.php&cetak&no_daftar=<?php echo $r['no_daftar']?>" class=>Cetak</a></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
