<?php
include 'config/database.php';

$error = "";

if(isset($_POST['submit'])){

    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $penerbit = trim($_POST['penerbit']);
    $tahun = trim($_POST['tahun']);
    $stok = trim($_POST['stok']);

    if(
        empty($judul) ||
        empty($pengarang) ||
        empty($penerbit) ||
        empty($tahun) ||
        empty($stok)
    ){
        $error = "Semua field wajib diisi!";
    } else {

        $query = "INSERT INTO buku
                  (judul, pengarang, penerbit, tahun_terbit, stok)
                  VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param(
            $stmt,
            "ssssi",
            $judul,
            $pengarang,
            $penerbit,
            $tahun,
            $stok
        );

        mysqli_stmt_execute($stmt);

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(to right, #4568dc, #b06ab3);
            min-height: 100vh;
        }

        .card-custom{
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card card-custom">
                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        ➕ Tambah Data Buku
                    </h2>

                    <?php if($error != "") : ?>
                        <div class="alert alert-danger">
                            <?= $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label>Judul Buku</label>
                            <input type="text"
                                   name="judul"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Pengarang</label>
                            <input type="text"
                                   name="pengarang"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Penerbit</label>
                            <input type="text"
                                   name="penerbit"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Tahun Terbit</label>
                            <input type="number"
                                   name="tahun"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Stok Buku</label>
                            <input type="number"
                                   name="stok"
                                   class="form-control">
                        </div>

                        <button type="submit"
                                name="submit"
                                class="btn btn-primary w-100">
                            Simpan Data
                        </button>

                        <a href="index.php"
                           class="btn btn-secondary w-100 mt-2">
                           Kembali
                        </a>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>

</body>
</html>