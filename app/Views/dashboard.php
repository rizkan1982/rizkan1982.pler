<title>Dashboard</title>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body text-center">
            <h1 class="mb-3">SELAMAT DATANG <?php echo session()->get('username') ?></h1>
            <p class="lead">Terimakasih Sudah Menggunakan Website Sistem Informasi Apotek UNIBA</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .content-wrapper {
    background-color: #f2f2f2;
    min-height: 100vh;
  }

  .card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .card-body {
    padding: 30px;
  }

  h1 {
    font-size: 48px;
    font-weight: 700;
  }

  p.lead {
    font-size: 24px;
    font-weight: 400;
    line-height: 1.5;
  }
</style>
