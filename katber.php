<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_kategori_menu");
$result = []; // Inisialisasi $result sebagai array kosong
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}
?>
<div class="col-lg-9 mt-2">
  <div class="card">
    <div class="card-header">
      Kategori Beras
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col d-flex justify-content-end">
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah Kategori
            Beras</button>
        </div>
      </div>
      <!-- Modal Tambah Kategori Baru -->
      <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Beras</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="proses/proses_input_katmenu.php" method="post">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <select class="form-select" name="jenismenu" id="">
                        <option value="1">Pulen</option>
                        <option value="2">Pera</option>
                      </select>
                      <label for="floatingInput">Jenis Beras</label>
                      <div class="invalid-feedback">
                        Tolong Masukan Jenis Beras.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="Kategori Menu"
                        name="katmenu" required>
                      <label for="floatingInput">Kategori Beras</label>
                      <div class="invalid-feedback">
                        Tolong Masukan Kategori Beras.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" name="input_katmenu_validate" value="12345">Save
                    changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Akhir Modal Tambah Kategori Baru -->

      <?php
      foreach ($result as $row) {
        ?>

        <!-- Modal Edit-->
        <div class="modal fade" id="ModalEdit<?php echo $row['id_kat_menu'] ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kategori Beras</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_edit_katmenu.php" method="post">
                  <input type="hidden" value="<?php echo $row['id_kat_menu'] ?>" name="id">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" required name="jenismenu" id="">
                          <?php
                          $data = array("pulen", "pera");
                          foreach ($data as $key => $value) {
                            if ($row['jenis_menu'] == $key + 1) {
                              echo "<option selected value=" . ($key + 1) . ">$value</option>";
                            } else {
                              echo "<option value=" . ($key + 1) . ">$value</option>";
                            }
                          }
                          ?>
                        </select>
                        <label for="floatingInput">Jenis Beras</label>
                        <div class="invalid-feedback">
                          Tolong Masukan Jenis Beras.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Kategori Menu"
                          name="katmenu" required value="<?php echo $row['kategori_menu'] ?>">
                        <label for="floatingInput">Kategori Beras</label>
                        <div class="invalid-feedback">
                          Tolong Masukan Kategori Beras.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="input_katmenu_validate" value="12345">Save
                      changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Akhir Modal Edit -->

        <!-- Modal Delete-->
        <div class="modal fade" id="ModalDelete<?php echo $row['id_kat_menu'] ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Kategori Beras</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_delete_katmenu.php" method="post">
                  <input type="hidden" value="<?php echo $row['id_kat_menu'] ?>" name="id">
                  <div class="col-lg-12">
                    Apakah anda yakin akan menghapus kategori Beras <b><?php echo $row['kategori_menu'] ?></b>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="hapus_kategori_validate"
                      value="12345">Delete</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Akhir Modal Delete -->
        <?php
      }
      if (empty($result)) {
        echo "Data user tidak ada";
      } else {
        ?>
        <!--Table Daftar Kategori Menu-->
        <div class="table-responsive mt-2">
          <table class="table table-hover" id="example">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Jenis Beras</th>
                <th scope="col">Kategori Beras</th>
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
                  <td><?php echo ($row['jenis_menu'] == 1) ? "liter" : "kg" ?></td>
                  <td><?php echo $row['kategori_menu'] ?></td>
                  <td class="d-flex">
                    <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                      data-bs-target="#ModalEdit<?php echo $row['id_kat_menu'] ?>"><i
                        class="bi bi-pencil-square"></i></button>
                    <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal"
                      data-bs-target="#ModalDelete<?php echo $row['id_kat_menu'] ?>"><i class="bi bi-trash"></i></button>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <!--Akhir Table Daftar Kategori Menu-->
        <?php
      }
      ?>
    </div>
  </div>
</div>