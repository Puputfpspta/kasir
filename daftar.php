<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu
  LEFT JOIN tb_kategori_menu ON tb_kategori_menu.id_kat_menu = tb_daftar_menu.kategori");
$result = []; // Inisialisasi $result sebagai array kosong
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}

$select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu,kategori_menu FROM tb_kategori_menu");
?>
<div class="col-lg-9 mt-2">
  <div class="card">
    <div class="card-header">
      Daftar Beras
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col d-flex justify-content-end">
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah Beras</button>
        </div>
      </div>
      <!-- Modal Tambah Menu baru -->
      <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Daftar Beras</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="post"
                enctype="multipart/form-data">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control py-3" id="uploadfoto" placeholder="Your Name" name="foto"
                        required>
                      <label class="input-group-text" for="uploadfoto">Unggah Foto Beras</label>
                      <div class="invalid-feedback">
                        Tolong Masukan Foto Beras.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="Nama Beras"
                        name="nama_menu" required>
                      <label for="floatingInput">Nama Beras</label>
                      <div class="invalid-feedback">
                        Tolong Masukan Nama Beras.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="keterangan"
                        name="keterangan">
                      <label for="floatingpassword">Keterangan</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-floating mb-3">
                      <select class="form-select" aria-label="Default select example" name="kat_menu" required>
                        <option selected hidden value="">Pilih Kategori Beras</option>
                        <?php
                        foreach ($select_kat_menu as $value) {
                          echo "<option value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                        }
                        ?>
                      </select>
                      <label for="floatingInput">Kategori Kg atau Liter</label>
                      <div class="invalid-feedback">
                        Tolong Masukan Kategori Beras.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="floatingInput" placeholder="Harga" name="harga"
                        required>
                      <label for="floatingInput">Harga</label>
                      <div class="invalid-feedback">
                        Tolong Masukan Harga.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="floatingInput" placeholder="Stok" name="stok"
                        required>
                      <label for="floatingInput">Stok</label>
                      <div class="invalid-feedback">
                        Tolong Masukan Stock Yang Tersedia.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_menu_validate" value="12345">Save
                    changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Akhir Modal Tambah Menu Baru -->

      <?php
      if (empty($result)) {
        echo "Data Beras Tidak Tersedia";
      } else {
        foreach ($result as $row) {
          ?>
          <!-- Modal view Menu -->
          <div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">View Beras</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="post"
                    enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-floating mb-3">
                          <input disabled type="text" class="form-control" id="floatingInput"
                            value="<?php echo $row['nama_menu'] ?>">
                          <label for="floatingInput">Nama Beras</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-floating mb-3">
                          <input disabled type="text" class="form-control" id="floatingInput"
                            value="<?php echo $row['keterangan'] ?>">
                          <label for="floatingpassword">Keterangan</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <select disabled class="form-select" aria-label="Default select example">
                            <option selected hidden value="">Pilih Kategori Beras</option>
                            <?php
                            foreach ($select_kat_menu as $value) {
                              if ($row['kategori'] == $value['id_kat_menu']) {
                                echo "<option selected value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                              } else {
                                echo "<option value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                              }
                            }
                            ?>
                          </select>
                          <label for="floatingInput">Kategori Beras</label>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <input disabled type="number" class="form-control" id="floatingInput"
                            value="<?php echo $row['harga'] ?>">
                          <label for="floatingInput">Harga</label>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <input disabled type="number" class="form-control" id="floatingInput"
                            value="<?php echo $row['stok'] ?>">
                          <label for="floatingInput">Stok</label>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Akhir Modal view menu -->

          <!-- Modal Edit-->
          <div class="modal fade" id="ModalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Daftar Beras</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="proses/proses_edit_menu.php" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <input type="file" class="form-control py-3" id="uploadfoto" placeholder="Your Name" name="foto"
                            required>
                          <label class="input-group-text" for="uploadfoto">Unggah Foto Beras</label>
                          <div class="invalid-feedback">
                            Tolong Masukan Foto Beras.
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="Nama Beras"
                            name="nama_menu" required value="<?php echo $row['nama_menu'] ?>">
                          <label for="floatingInput">Nama Beras</label>
                          <div class="invalid-feedback">
                            Tolong Masukan Nama Beras.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="keterangan"
                            name="keterangan" value="<?php echo $row['keterangan'] ?>">
                          <label for="floatingpassword">Keterangan</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <select class="form-select" aria-label="Default select example" name="kat_menu">
                            <option selected hidden value="">Pilih Kategori Beras</option>
                            <?php
                            foreach ($select_kat_menu as $value) {
                              if ($row['kategori'] == $value['id_kat_menu']) {
                                echo "<option selected value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                              } else {
                                echo "<option value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                              }
                            }
                            ?>
                          </select>
                          <label for="floatingInput">Kategori Beras</label>
                          <div class="invalid-feedback">
                            Tolong Masukan Kategori Beras.
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="Harga" name="harga"
                            required value="<?php echo $row['harga'] ?>">
                          <label for="floatingInput">Harga</label>
                          <div class="invalid-feedback">
                            Tolong Masukan Harga Beras.
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="Stok" name="stok"
                            required value="<?php echo $row['stok'] ?>">
                          <label for="floatingInput">Stok</label>
                          <div class="invalid-feedback">
                            Tolong Masukan Stok Yang Tersedia.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success" name="input_menu_validate" value="12345">Save
                        changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Akhir Modal Edit -->

          <!-- Modal Delete-->
          <div class="modal fade" id="ModalDelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Daftar Beras</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="proses/proses_delete_menu.php" method="post">
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                    <input type="hidden" value="<?php echo $row['foto'] ?>" name="foto">
                    <div class="col-lg-12">
                      Apakah anda yakin akan menghapus Daftar Beras <b><?php echo $row['nama_menu'] ?></b>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-danger" name="input_menu_validate" value="12345">Delete</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Akhir Modal Delete -->
          <?php
        }
        ?>
        <div class="table-responsive mt-2">
          <table class="table table-hover" id="example">
            <thead>
              <tr class="text-nowrap">
                <th scope="col">No</th>
                <th scope="col">Foto Beras</th>
                <th scope="col">Nama Beras</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Kategori</th>
                <th scope="col">Jenis Beras</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($result as $row) {
                ?>
                <tr>
                  <th scope="row"><?php echo $no++ ?></th>
                  <td>
                    <div style="width: 90px">
                      <img src="assets/img/<?php echo $row['foto'] ?>" class="img-thumbnail" alt="...">
                    </div>
                  </td>
                  <td><?php echo $row['nama_menu'] ?></td>
                  <td><?php echo $row['keterangan'] ?></td>
                  <td><?php echo ($row['jenis_menu'] == 1) ? "Beras Merah" : "Beras Putih" ?></td>
                  <td><?php echo $row['kategori_menu'] ?></td>
                  <td><?php echo $row['harga'] ?></td>
                  <td><?php echo $row['stok'] ?></td>
                  <td>
                    <div class="d-flex">
                      <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                        data-bs-target="#ModalView<?php echo $row['id'] ?>"><i class="bi bi-eye"></i></button>
                      <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                        data-bs-target="#ModalEdit<?php echo $row['id'] ?>"><i class="bi bi-pencil-square"></i></button>
                      <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal"
                        data-bs-target="#ModalDelete<?php echo $row['id'] ?>"><i class="bi bi-trash"></i></button>
                    </div>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</div>