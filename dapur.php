<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT * FROM tb_list_order
  LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
  LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
  LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
  ORDER BY waktu_order ASC");

while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}

$select_menu = mysqli_query($conn, "SELECT id,nama_menu FROM tb_daftar_menu");
?>
<div class="col-lg-9 mt-2">
  <div class="card">
    <div class="card-header">
      Halaman Kurir
    </div>
    <div class="card-body">

      <?php
      if (empty($result)) {
        echo "Data Pesanan tidak ada";
      } else {
        foreach ($result as $row) {
          ?>

          <!-- Modal terima dapur-->
          <div class="modal fade" id="terima<?php echo $row['id_list_order'] ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">View Orderan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="proses/proses_terima_orderitem.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="form-floating mb-3">
                          <select disabled class="form-select" name="menu" id="menu" required>
                            <option selected hidden value="">Pilih Menu</option>
                            <?php foreach ($select_menu as $value) {
                              if ($row['menu'] == $value['id']) {
                                echo "<option selected value='{$value['id']}'>{$value['nama_menu']}</option>";
                              } else {
                                echo "<option value='{$value['id']}'>{$value['nama_menu']}</option>";
                              }
                            } ?>
                          </select>
                          <label for="menu">Jenis Beras</label>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <input disabled type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi"
                            name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                          <label for="floatingInput">Berapa Banyak</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-floating mb-3">
                          <input readonly type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan"
                            value="<?php echo $row['catatan'] ?>">
                          <label for="floatingpassword">Catatan</label>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-5">
                        <div class="form-floating mb-3">
                          <input disabled type="number" class="form-control" id="meja" placeholder="Nomor Hand Phone" name="meja" required
                            value="<?php echo $row['meja'] ?>">
                          <label for="meja">Nomer HP</label>
                          <div class="invalid-feedback">
                            Tolong Masukan Nomer Telpon.
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <div class="form-floating mb-3">
                          <input disabled type="text" class="form-control" id="pelanggan" placeholder="Nama Pelanggan"
                            name="pelanggan" required value="<?php echo $row['pelanggan'] ?>">
                          <label for="pelanggan">Nama Pelanggan</label>
                          <div class="invalid-feedback">
                            Tolong Masukan Nama Pelanggan.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="terima_orderitem_validate"
                        value="12345">Terima</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Akhir Modal terima dapur -->

          <!-- Modal Siap Saji-->
          <div class="modal fade" id="siapsaji<?php echo $row['id_list_order'] ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Order Selesai</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="proses/proses_siapsaji_orderitem.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="form-floating mb-3">
                          <select disabled class="form-select" name="menu" id="menu" required>
                            <option selected hidden value="">Pilih Menu</option>
                            <?php foreach ($select_menu as $value) {
                              if ($row['menu'] == $value['id']) {
                                echo "<option selected value='{$value['id']}'>{$value['nama_menu']}</option>";
                              } else {
                                echo "<option value='{$value['id']}'>{$value['nama_menu']}</option>";
                              }
                            } ?>
                          </select>
                          <label for="menu">Jenis Beras</label>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <input disabled type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi"
                            name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                          <label for="floatingInput">Berapa Banyak</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-floating mb-3">
                          <input readonly type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan"
                            value="<?php echo $row['catatan'] ?>">
                          <label for="floatingpassword">Catatan</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-5">
                        <div class="form-floating mb-3">
                          <input disabled type="number" class="form-control" id="meja" placeholder="Nomor Hand Phone" name="meja" required
                            value="<?php echo $row['meja'] ?>">
                          <label for="meja">Nomer HP</label>
                          <div class="invalid-feedback">
                            Tolong Masukan Nomer Telpon.
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <div class="form-floating mb-3">
                          <input disabled type="text" class="form-control" id="pelanggan" placeholder="Nama Pelanggan"
                            name="pelanggan" required value="<?php echo $row['pelanggan'] ?>">
                          <label for="pelanggan">Nama Pelanggan</label>
                          <div class="invalid-feedback">
                            Tolong Masukan Nama Pelanggan.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success" name="siapsaji_orderitem_validate" value="12345">Order Selesai</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Akhir Modal Siap Saji -->

          <?php
        }
        ?>

        <div class="table-responsive mt-2">
          <table class="table table-hover" id="example">
            <thead>
              <tr class="text-nowrap">
                <th scope="col">No</th>
                <th scope="col">Kode Order</th>
                <th scope="col">Waktu Order</th>
                <th scope="col">Nama Customer</th>
                <th scope="col">Nomer HP</th>
                <th scope="col">Nama Beras</th>
                <th scope="col">Qty</th>
                <th scope="col">Catatan</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($result as $row) {
                if ($row['status'] != 2) {
                  ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['kode_order'] ?></td>
                    <td><?php echo $row['waktu_order'] ?></td>
                    <td><?php echo $row['pelanggan'] ?></td>
                    <td><?php echo $row['meja'] ?></td>
                    <td><?php echo $row['nama_menu'] ?></td>
                    <td><?php echo $row['jumlah'] ?></td>
                    <td><?php echo $row['catatan'] ?></td>
                    <td><?php if ($row['status'] == 1) {
                      echo "<span class='badge text-bg-warning'>Dalam pengiriman</span>";
                    } elseif ($row['status'] == 2) {
                      echo "<span class='badge text-bg-success'>Selesai Pengiriman</span>";
                    } ?></td>
                    <td>
                      <div class="d-flex">
                        <button
                          class="<?php echo (!empty($row['status'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-primary btn-sm me-1"; ?>"
                          data-bs-toggle="modal" data-bs-target="#terima<?php echo $row['id_list_order'] ?>">Terima Order</button>
                        <button
                          class="<?php echo (empty($row['status']) || $row['status'] != 1) ? "btn btn-secondary btn-sm me-1 text-nowrap disabled" : "btn btn-success btn-sm me-1 text-nowrap"; ?>"
                          data-bs-toggle="modal" data-bs-target="#siapsaji<?php echo $row['id_list_order'] ?>">Order Selesai</button>
                      </div>
                    </td>
                  </tr>
                  <?php
                }
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