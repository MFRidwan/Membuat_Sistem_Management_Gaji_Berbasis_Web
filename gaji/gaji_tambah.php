<?php
include '../koneksi.php';
include '../includes/header.php';
include '../includes/sidebar.php';

if (isset($_POST['simpan'])) {
  $kid = $_POST['karyawan_id'];
  $bulan = $_POST['bulan'];
  $gaji = $_POST['total_gaji'];
  mysqli_query($conn, "INSERT INTO gaji (karyawan_id, bulan, total_gaji) VALUES ('$kid', '$bulan', '$gaji')");
  echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        title: 'Berhasil!',
        text: 'Data gaji berhasil disimpan.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        window.location.href = '../gaji/gaji.php';
      });
    });
  </script>";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Tambah Data Gaji</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background-color: #121212;
      color: #fff;
    }

    .form-control, .form-select {
      background-color: #1e1e1e;
      border: 1px solid #444;
      color: #fff;
    }

    .form-control:focus, .form-select:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .card-form {
      background-color: #1f1f1f;
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.4);
      animation: fadeInUp 0.8s ease;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    /* Animasi glow saat fokus atau input berubah */
    .form-control:focus,
    .form-select:focus {
      animation: inputGlow 0.3s ease-in-out;
    }

    @keyframes inputGlow {
      0% {
        box-shadow: 0 0 0px rgba(13, 110, 253, 0);
      }
      100% {
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
      }
    }

    /* Saat user mulai mengetik */
    .form-control.input-active {
      border-color: #00bcd4;
      box-shadow: 0 0 5px rgba(0, 188, 212, 0.5);
      transition: all 0.2s ease-in-out;
    }

  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="card-form mx-auto" style="max-width: 1200px;">
      <h2 class="mb-4">Tambah Data Gaji</h2>
      <form id="formGaji" method="post" novalidate>
        <div class="mb-3">
          <label class="form-label">Nama Karyawan</label>
          <select name="karyawan_id" class="form-select" required>
            <option value="">-- Pilih --</option>
            <?php
            $res = mysqli_query($conn, "SELECT * FROM karyawan");
            while ($k = mysqli_fetch_assoc($res)) {
              echo "<option value='{$k['id']}'>{$k['nama']}</option>";
            }
            ?>
          </select>
          <div class="invalid-feedback">Silakan pilih karyawan.</div>
        </div>
        <div class="mb-3">
          <label class="form-label">Bulan</label>
          <input type="text" name="bulan" class="form-control" required>
          <div class="invalid-feedback">Bulan harus diisi.</div>
        </div>
        <div class="mb-3">
          <label class="form-label">Total Gaji</label>
          <input type="number" name="total_gaji" class="form-control" required min="0">
          <div class="invalid-feedback">Masukkan jumlah gaji yang valid.</div>
        </div>
        <button type="submit" name="simpan" class="btn btn-success w-100">
          <i class="bi bi-check-circle-fill me-1"></i> Simpan
        </button>
      </form>
    </div>
  </div>

  <script>

    document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('input', () => {
      input.classList.add('input-active');
    });
    input.addEventListener('blur', () => {
      input.classList.remove('input-active');
    });
  });
    // Validasi Bootstrap instan
    (() => {
      'use strict'
      const form = document.getElementById('formGaji')
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })()
  </script>
</body>

</html>
