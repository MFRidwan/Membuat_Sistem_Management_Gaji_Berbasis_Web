-- Tabel: jabatan
CREATE TABLE jabatan (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_jabatan VARCHAR(100),
    gaji_pokok INT(11),
    deskripsi TEXT
);

-- Tabel: karyawan
CREATE TABLE karyawan (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    jenis_kelamin VARCHAR(10),
    jabatan VARCHAR(100),
    alamat TEXT,
    no_hp VARCHAR(20),
    foto VARCHAR(255),
    jabatan_id INT(11),
    FOREIGN KEY (jabatan_id) REFERENCES management_gaji_jabatan(id)
);

-- Tabel: lembur
CREATE TABLE lembur (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    karyawan_id INT(11),
    bulan VARCHAR(20),
    jabatan_id INT(11),
    tarif_per_jam INT(11),
    jumlah_jam INT(11),
    FOREIGN KEY (karyawan_id) REFERENCES management_gaji_karyawan(id),
    FOREIGN KEY (jabatan_id) REFERENCES management_gaji_jabatan(id)
);

-- Tabel: rating
CREATE TABLE rating (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    karyawan_id INT(11),
    bulan VARCHAR(20),
    nilai_rating INT(11),
    FOREIGN KEY (karyawan_id) REFERENCES management_gaji_karyawan(id)
);

-- Tabel: gaji
CREATE TABLE gaji (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    karyawan_id INT(11),
    bulan VARCHAR(20),
    total_gaji INT(11),
    FOREIGN KEY (karyawan_id) REFERENCES management_gaji_karyawan(id)
);

-- Insert Table Jabatan --
INSERT INTO jabatan (nama_jabatan, gaji_pokok) VALUES
('Manager', 10000000.00),
('Supervisor', 7000000.00),
('Staff', 5000000.00);
