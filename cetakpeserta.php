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

    @$where = "no_daftar= $_GET[no_daftar]";

    if (isset($_GET['edit'])) {
        $edit = $go->edit($con, $table, $where);
    }

?>

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
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<script type="text/javascript">
        window.print();
</script>