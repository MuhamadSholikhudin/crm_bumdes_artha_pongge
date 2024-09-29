<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<!-- Begin Page Content -->
<div class='container-fluid'>
    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>User page</h1>
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Success !</strong> <?= $_SESSION['message'] ?>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    <?php
        unset($_SESSION['message']);
    }
    ?>
    <div class='d-sm-flex align-items-center justify-content-between mb-4'>
        <a href='<?= $url ?>/app/user/tambah.php' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-plus fa-sm text-white-50'></i> Tambah data user</a>
    </div>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data User
            </h5>
        </div>
        <div class='card-body'>
            <table id='example' class='table table-bordered dataTable' id='dataTable' width='100%' cellspacing='0' role='grid' aria-describedby='dataTable_info' style='width: 100%;'>
                <thead>
                    <tr class='text-center'>
                        <th>ID_USER</th>
                        <th>USERNAME</th>
                        <th>PASSWORD</th>
                        <th>NM_PENGGUNA</th>
                        <th>LEVEL</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach (QueryManyData('SELECT * FROM user') as $row) {
                    ?>
                        <tr>
                            <td><?= $row['id_user'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['password'] ?></td>
                            <td><?= $row['nm_pengguna'] ?></td>
                            <td><?= $row['level'] ?></td>
                            <td><a href='<?= $url ?>/app/user/edit.php?id_user=<?= $row['id_user'] ?>' user class='btn btn-success btn-icon-split btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-edit'></i>
                                    </span>
                                    <span class='text'>edit</span>
                                </a>
                                <button onclick="ConfirmDelete(<?= $row['id_user'] ?>)" class='btn btn-danger btn-icon-split btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-trash'></i>
                                    </span>
                                    <span class='text'>hapus</span>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function ConfirmDelete(id) {
            let text = 'Apakah Anda Yakin Ingin Menghapus data!\n OK or Cancel.';
            if (confirm(text) == true) {
                text = 'You pressed OK!';
                window.location.href = '<?= $url ?>/aksi/user.php?id_user=' + id + '&action=delete'
            }
        }
    </script>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>