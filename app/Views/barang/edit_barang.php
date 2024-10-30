<title>Edit Obat</title>
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Edit <?=$title?></h4>

    <div class="row">
      <div class="card mb-4">
        <div class="row">
          <div class="col-md-6">
            <div class="card-body">
              <form action="<?= base_url('barang/aksi_edit_barang/')?>" method="post">
              <input type="hidden" name="id" value="<?php echo $jojo->id_barang ?>">

                <div class="mb-3">
                  <label for="email" class="form-label">Nama Obat</label>
                  <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Obatt" name="nama_brg" value="<?=$jojo->nama_brg?>" required>

                <div class="mb-3">
                  <label for="email" class="form-label">Kode Obat</label>
                  <input type="text" class="form-control" id="kode" placeholder="Masukkan Kode Obat" name="kode_brg" value="<?=$jojo->kode_brg?>" required>
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Stock</label>
                  <input type="text" class="form-control" id="stock" placeholder="Masukkan Stock" name="stock" value="<?=$jojo->stock?>" required>
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Harga</label>
                  <input type="text" class="form-control" id="harga" placeholder="Masukkan Harga" name="harga" value="<?=$jojo->harga?>" required>
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Tanggal Tersedia</label>
                  <input type="date" class="form-control" id="tanggal" placeholder="Masukkan Tanggal" name="tanggal" value="<?=$jojo->tanggal?>" required>
                </div>
                </div>
                </div>


            <!-- bagian tombol submit -->
            <div class="col-12 d-flex justify-content-end">
              <div class="form-group mb-5">
                <div class="col-md-0 col-md-offset-0">
                  <a href="javascript:history.back()" class="btn btn-danger me-2">Cancel</a>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </div>