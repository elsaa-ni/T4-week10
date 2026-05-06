<?php
include 'config/database.php';

$query = "SELECT * FROM buku ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(to right, #1d2671, #c33764);
            min-height: 100vh;
        }

        .card-custom{
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        .title{
            font-weight: bold;
            color: #fff;
        }

        table{
            border-radius: 15px;
            overflow: hidden;
        }

        .btn-custom{
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title">📚 Data Buku Perpustakaan</h2>

        <a href="create.php" class="btn btn-success btn-custom">
            + Tambah Buku
        </a>
    </div>

    <div class="card card-custom">
        <div class="card-body">

            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $no = 1;

                while($data = mysqli_fetch_assoc($result)) :
                ?>

                    <tr>
                        <td class="text-center"><?= $no++; ?></td>

                        <td><?= htmlspecialchars($data['judul']); ?></td>

                        <td><?= htmlspecialchars($data['pengarang']); ?></td>

                        <td><?= htmlspecialchars($data['penerbit']); ?></td>

                        <td class="text-center">
                            <?= htmlspecialchars($data['tahun_terbit']); ?>
                        </td>

                        <td class="text-center">
                            <?= htmlspecialchars($data['stok']); ?>
                        </td>

                        <td class="text-center">

                            <a href="edit.php?id=<?= $data['id']; ?>"
                               class="btn btn-warning btn-sm">
                               Edit
                            </a>

                            <a href="delete.php?id=<?= $data['id']; ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">
                               Hapus
                            </a>

                        </td>
                    </tr>

                <?php endwhile; ?>

                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>

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