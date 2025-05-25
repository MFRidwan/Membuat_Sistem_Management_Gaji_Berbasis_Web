<?php
include '../koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jabatan_id = $_POST['jabatan_id'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $tanggal_bergabung = $_POST['tanggal_bergabung'];
    $nilai_rating = $_POST['nilai_rating'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $upload_dir = '../uploads/';

    if (!empty($foto)) {
        move_uploaded_file($tmp, $upload_dir . $foto);
    }

    $query = mysqli_query($conn, "INSERT INTO karyawan (nama, jenis_kelamin, jabatan_id, alamat, no_hp, foto, tanggal_bergabung) 
                                  VALUES ('$nama', '$jenis_kelamin', '$jabatan_id', '$alamat', '$no_hp', '$foto', '$tanggal_bergabung')");

    if ($query) {
        $karyawan_id = mysqli_insert_id($conn);
        $bulan = date('Y-m');
        mysqli_query($conn, "INSERT INTO rating (karyawan_id, bulan, nilai_rating) 
                             VALUES ('$karyawan_id', '$bulan', '$nilai_rating')");

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data Karyawan berhasil disimpan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '../karyawan/karyawan.php';
                });
            });
        </script>";
        exit;
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal menambahkan data karyawan.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '../karyawan/karyawan.php';
                });
            });
        </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Tambah Karyawan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animate.css for AOS fallback -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        html,
        body {
            background-color: #121212 !important;
            color: #e0e0e0 !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            background-color: #1a1a1a !important;
            color: #ddd !important;
            min-height: 100vh;
            padding: 1rem;
        }

        .container {
            background-color: transparent !important;
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .card {
            background-color: #1e1e1e !important;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            border: none;
        }

        .form-control,
        .form-select,
        textarea {
            background-color: #2c2c2c !important;
            color: #e0e0e0 !important;
            border: 1px solid #444 !important;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .form-control::placeholder,
        textarea::placeholder {
            color: #bbbbbb !important;
        }

        .form-control:focus,
        .form-select:focus,
        textarea:focus {
            border-color: #4A90E2 !important;
            box-shadow: 0 0 10px rgba(74, 144, 226, 0.7) !important;
            outline: none;
            background-color: #353535 !important;
            color: #fff !important;
        }

        label {
            margin-top: 10px;
            color: #ddd !important;
        }

        a {
            color: #4A90E2 !important;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn-success {
            background-color: #00c853 !important;
            border: none !important;
        }

        .btn-success:hover {
            background-color: #00b14a !important;
        }

        .btn-secondary {
            background-color: #616161 !important;
            border: none !important;
        }

        .btn-secondary:hover {
            background-color: #757575 !important;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1e1e1e;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #444;
            border-radius: 4px;
        }

        .teks-button {
            color: #fff !important;
            text-decoration: none !important;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <?php include '../includes/sidebar.php'; ?>

        <div class="container py-5">
            <div class="card shadow border-0" data-aos="fade-up" data-aos-duration="800">
                <div class="card-header bg-primary text-white fw-bold">
                    Tambah Data Karyawan
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" id="formKaryawan" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" required />
                                <div class="invalid-feedback">Nama wajib diisi.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="invalid-feedback">Jenis kelamin wajib dipilih.</div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Jabatan</label>
                                <select name="jabatan_id" class="form-select" required>
                                    <option value="">-- Pilih Jabatan --</option>
                                    <?php
                                    $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
                                    while ($row = mysqli_fetch_assoc($jabatan)) {
                                        echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['nama_jabatan']) . '</option>';
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">Jabatan wajib dipilih.</div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required></textarea>
                                <div class="invalid-feedback">Alamat wajib diisi.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No HP</label>
                                <input type="text" name="no_hp" class="form-control" required />
                                <div class="invalid-feedback">No HP wajib diisi.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Bergabung</label>
                                <input type="date" name="tanggal_bergabung" class="form-control"
                                    max="<?= date('Y-m-d') ?>" required />
                                <div class="invalid-feedback">Tanggal bergabung wajib diisi.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Foto</label>
                                <input type="file" name="foto" class="form-control" accept="image/*" required />
                                <div class="invalid-feedback">Foto wajib diupload.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Rating (1 - 5)</label>
                                <select name="nilai_rating" class="form-select" required>
                                    <option value="">-- Pilih Rating --</option>
                                    <option value="1">1 - Sangat Buruk</option>
                                    <option value="2">2 - Buruk</option>
                                    <option value="3">3 - Cukup</option>
                                    <option value="4">4 - Baik</option>
                                    <option value="5">5 - Sangat Baik</option>
                                </select>
                                <div class="invalid-feedback">Rating wajib dipilih.</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="../karyawan/karyawan.php" class="btn btn-primary teks-button">Kembali</a>
                            <button type="submit" class="btn btn-success px-4">Simpan</button>
                        </div>
                    </form>             
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();

        (() => {
            const form = document.getElementById('formKaryawan');
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();

                    Swal.fire({
                        icon: 'error',
                        title: 'Form belum lengkap',
                        text: 'Silakan lengkapi semua field yang wajib diisi.',
                        confirmButtonText: 'OK'
                    });

                    return false;
                }
                form.classList.add('was-validated');
            }, false);
        })();
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', () => {
                input.classList.add('input-active');
            });
            input.addEventListener('blur', () => {
                input.classList.remove('input-active');
            });
        });
    </script>

</body>

</html>