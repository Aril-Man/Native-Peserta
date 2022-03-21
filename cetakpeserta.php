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
<?php
$sql = "SELECT * FROM tbl_peserta ";
$go = mysqli_query($con, $sql);
while ($r = mysqli_fetch_array($go)) {
?>

<p> <?php echo $r['no_daftar'] ?></p>
<p><?php echo $r['nama_lengkap'] ?></p>
<p><?php echo $r['jk'] ?></p>
<p> <?php echo $r['alamat'] ?></p>
<p><?php echo $r['agama'] ?></p>
<p><?php echo $r['asal_smp'] ?></p>
<p><?php echo $r['jurusan'] ?></p>

<?php } ?>



<script type="text/javascript">
window.print();
</script>