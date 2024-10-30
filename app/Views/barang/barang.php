<title>Obat</title>
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span><?=$title?></h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="card-header">
        <a href="<?=base_url('barang/tambah_barang')?>"><button class="btn btn-primary">+ Tambah</button></a>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Obat</th>
              <th>Kode Obat</th>
              <th>Stock</th>
              <th>Harga</th>
              <th>Tanggal Tersedia</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php
            $no=1;
            foreach ($a as $data) {
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?php echo $data->nama_brg?></td>
                <td><?php echo $data->kode_brg?></td>
                <td><?php echo $data->stock?></td>
                <td><?php echo $data->harga?></td>
                <td><?php echo $data->tanggal?></td>
              <td>
                <a href="<?=base_url('barang/edit_barang/'. $data->id_barang)?>"><button class="btn rounded-pill btn-warning my-1">Edit</button></a>
                <a href="<?=base_url('barang/hapus/'. $data->id_barang)?>"><button class="btn rounded-pill btn-danger my-1">Hapus</button></a>
              </div>
            </div>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>
</div>