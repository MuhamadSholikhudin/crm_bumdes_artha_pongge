<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php


$user = QueryOnedata('SELECT * FROM user WHERE id_user = ' . $_GET['id_user'] . '')->fetch_assoc();
?>
<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>User page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Edit Data User
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/user.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row ' style='display:none;'>
                    <label for='inputid_user' class='col-sm-2 col-form-label'>Id_User</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputid_user' name='id_user' value='<?= $user['id_user']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputusername' class='col-sm-2 col-form-label'>Username</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputusername' name='username' value='<?= $user['username']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputpassword' class='col-sm-2 col-form-label'>Password</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputpassword' name='password' value='<?= $user['password']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputnm_pengguna' class='col-sm-2 col-form-label'>Nm_Pengguna</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputnm_pengguna' name='nm_pengguna' value='<?= $user['nm_pengguna']; ?>' required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputlevel" class="col-sm-2 col-form-label">Level
                    </label>
                    <div class="col-sm-10">

                        <select class="form-control" name="level" id="inputlevel">
                            <?php
                            $level = ['pelanggan', 'petugas bumdes', 'petugas lapangan', 'ketua unit air', 'ketua bumdes'];
                            foreach ($level    as $val) { ?> <?php
                                if ($val == $user['level']) { ?>
                                    <option value='<?= $val ?>' selected><?= $val ?></option>
                                <?php } else { ?> as $val) {
                                    ?>
                                    <option value="<?= $val ?>"><?= $val ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
               
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/user/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='updateuser' value='updateuser' class='btn btn-success btn-user btn-block'>
                            <i class='fas fa-save'></i> UPDATE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>