<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$_SESSION[username_tbm]'");
$records =mysqli_fetch_array($query);
?>
<nav class="navbar navbar-expand navbar-dark sticky-top" style="background-color: #175510;">
  <div class="container-lg">
    <style>
      #judul{
        color: whitesmoke;
        font-family: "Playwrite MX", cursive;
      }
    </style>
    <a id= "judul" class="navbar-brand" href="."><img class="mb-0" src="..\TBM\foto\logo_tbm.png" alt="" width="80" height="60">
      Beras Mulia</a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $hasil['username']; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end mt-2">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahProfile"><i
                  class="bi bi-person-circle"></i> Profil</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword"><i
                  class="bi bi-key"></i> Ubah Password</a></li>
            <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Modal Ubah password-->
<div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate action="proses/proses_ubah_password.php" method="post">
          <div class="row">
            <!-- awal kolom username -->
            <div class="col-lg-6">
              <div class="form-floating mb-3">
                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                  name="username" required value="<?php echo $_SESSION['username_tbm'] ?>">
                <label for="floatingInput">Username</label>
                <div class="invalid-feedback">
                  Please input your username.
                </div>
              </div>
            </div>
            <!-- awal kolom password lama -->
            <div class="col-lg-6">
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="passwordlama" required>
                <label for="floatingInput">password Lama</label>
                <div class="invalid-feedback">
                  Please enter your old password.
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- awal kolom password baru -->
            <div class="col-lg-6">
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="passwordbaru" required>
                <label for="floatingInput">password Baru</label>
                <div class="invalid-feedback">
                  Please enter your new password.
                </div>
              </div>
            </div>
            <!-- awal kolom masukan ulang password baru -->
            <div class="col-lg-6">
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="repasswordbaru" required>
                <label for="floatingInput">Ulangi Password Baru</label>
                <div class="invalid-feedback">
                  Please re-enter your new password.
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="ubah_password_validate" value="12345">Save
              changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Ubah Password -->

<!-- Modal Ubah profile -->
<div class="modal fade" id="ModalUbahProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate action="proses/proses_ubah_profile.php" method="post">
          <div class="row">
            <!-- awal kolom username -->
            <div class="col-lg-4">
              <div class="form-floating mb-3">
                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                  name="username" required value="<?php echo $_SESSION['username_tbm'] ?>">
                <label for="floatingInput">Username</label>
                <div class="invalid-feedback">
                  Please input your username.
                </div>
              </div>
            </div>
            <!-- awal kolom nama -->
            <div class="col-lg-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingNama" name="nama" required value="<?php echo $records['nama'] ?>" >
                <label for="floatingInput">Nama</label>
                <div class="invalid-feedback">
                  Please enter your name.
                </div>
              </div>
            </div>
            <!-- awal kolom nomer hp -->
            <div class="col-lg-4">
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" name="nohp" required value="<?php echo $records['nohp'] ?>">
                <label for="floatingInput">Nomor HP</label>
                <div class="invalid-feedback">
                  Please enter your number phone.
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- awal kolom masukan alamat -->
            <div class="col-lg-12">
              <div class="form-floating mb-3">
                <textarea class="form-control" id="" style="height:100px"
                  name="alamat"><?php echo $records['alamat'] ?></textarea>
                <label for="floatingInput">Alamat</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="ubah_profile_validate" value="12345">Save
              changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Ubah profile -->