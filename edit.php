<?php
include 'config/database.php';

$id = $_GET['id'];

$query = "SELECT * FROM buku WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $penerbit = trim($_POST['penerbit']);
    $tahun = trim($_POST['tahun']);
    $stok = trim($_POST['stok']);

    $update = "UPDATE buku
               SET judul=?,
                   pengarang=?,
                   penerbit=?,
                   tahun_terbit=?,
                   stok=?
               WHERE id=?";

    $stmtUpdate = mysqli_prepare($conn, $update);

    mysqli_stmt_bind_param(
        $stmtUpdate,
        "ssssii",
        $judul,
        $pengarang,
        $penerbit,
        $tahun,
        $stok,
        $id
    );

    mysqli_stmt_execute($stmtUpdate);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(to right, #11998e, #38ef7d);
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
                        ✏️ Edit Data Buku
                    </h2>

                    <form method="POST">

                        <div class="mb-3">
                            <label>Judul Buku</label>
                            <input type="text"
                                   name="judul"
                                   class="form-control"
                                   value="<?= htmlspecialchars($data['judul']); ?>">
                        </div>

                        <div class="mb-3">
                            <label>Pengarang</label>
                            <input type="text"
                                   name="pengarang"
                                   class="form-control"
                                   value="<?= htmlspecialchars($data['pengarang']); ?>">
                        </div>

                        <div class="mb-3">
                            <label>Penerbit</label>
                            <input type="text"
                                   name="penerbit"
                                   class="form-control"
                                   value="<?= htmlspecialchars($data['penerbit']); ?>">
                        </div>

                        <div class="mb-3">
                            <label>Tahun Terbit</label>
                            <input type="number"
                                   name="tahun"
                                   class="form-control"
                                   value="<?= htmlspecialchars($data['tahun_terbit']); ?>">
                        </div>

                        <div class="mb-3">
                            <label>Stok Buku</label>
                            <input type="number"
                                   name="stok"
                                   class="form-control"
                                   value="<?= htmlspecialchars($data['stok']); ?>">
                        </div>

                        <button type="submit"
                                name="update"
                                class="btn btn-success w-100">
                            Update Data
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