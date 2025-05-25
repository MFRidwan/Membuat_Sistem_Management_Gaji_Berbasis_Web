<?php
include '../koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: ../karyawan/karyawan.php");
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM karyawan WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan_id = $_POST['jabatan_id'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $tanggal_bergabung = $_POST['tanggal_bergabung'];

    // Cek apakah ada file foto baru yang diupload
    $foto_baru = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $upload_dir = 'uploads/';

    if ($foto_baru != "") {
        move_uploaded_file($tmp, $upload_dir . $foto_baru);
        $foto = $foto_baru;
    } else {
        $foto = $data['foto']; // pakai foto lama
    }

    // Update data
    $update = mysqli_query($conn, "UPDATE karyawan SET 
        nama='$nama',
        jenis_kelamin='$jenis_kelamin',
        jabatan_id='$jabatan_id',
        alamat='$alamat',
        no_hp='$no_hp',
        foto='$foto',
        tanggal_bergabung='$tanggal_bergabung'
        WHERE id='$id'");

    if ($update) {
        header("Location: ../karyawan/karyawan.php");
        exit;
    } else {
        echo "Gagal mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <?php include '../includes/sidebar.php'; ?>
    <div class="p-4 w-100">
        <h3>Edit Data Karyawan</h3>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <select name="jabatan_id" class="form-select" required>
                    <?php
                    $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
                    while ($row = mysqli_fetch_assoc($jabatan)) {
                        $selected = $data['jabatan_id'] == $row['id'] ? 'selected' : '';
                        echo "<option value='{$row['id']}' $selected>{$row['nama_jabatan']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required><?= $data['alamat'] ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" value="<?= $data['no_hp'] ?>" required>
            </div>

            <!-- Tanggal Bergabung -->
            <div class="mb-3">
                <label class="form-label">Tanggal Bergabung</label>
                <input type="date" name="tanggal_bergabung" class="form-control" value="<?= $data['tanggal_bergabung'] ?>" max="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto (kosongkan jika tidak ingin mengganti)</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                <div class="mt-2">
                    <img src="../uploads/<?= $data['foto'] ?>" width="100" alt="Foto Karyawan">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="../karyawan/karyawan.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
