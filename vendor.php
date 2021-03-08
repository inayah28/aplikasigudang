<?php
include_once 'tampilan/header.php';
include_once 'tampilan/navbar.php';
include_once 'config.php';
?>

<br><br><br><br><br><br><br><br>
<!-- start banner Area -->
<div class="container">
<div id="page-wrapper">
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Distributor</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>
      <div class="row">
        <div class="col-sm-4">
          <?php
            //untuk mengedit 
            if (isset($_GET['id'])) { //jika id yang di pilih ada pada database
                $id=$_GET['id']; //buat variabel untuk menampung parameter id (baris) saat klik edit
                $sql="select * from distributor where id_distributor=$id"; //select semua data pada distributor dimana id_distributor adalah id yang dipilih
                $field=$dbh->query($sql)->fetch(); 
            } else{ //jika id tidak ada nilainya 
                $field=[ // field adalah nama_distribur,nohp dan alamat nya tidak ada nylainya (kosong.  
                    'nama_distributor'=>'',
                    'telepon'=>'',
                    'alamat'=>''
                    ];
            }
           ?>
          <form method="post" action="prosesvendor.php">
            <!-- saat user pilih edit maka data pada tabel yang di pilik akan tampil pada form input -->
            <input class="form-control" type="text" name="nama" placeholder="Nama Distributor" value="<?php echo $field['nama_distributor']?>"><br> 
            <input class="form-control" type="number" name="telepon" placeholder="Telepon" value="<?php echo $field['telepon']?>"><br>
            <textarea name="alamat" class="form-control" placeholder="Alamat"><?php echo $field['alamat']?></textarea><br>
            <?php
               if (isset($_GET['id'])) { ?>  <!-- jika sudah di klik edit di tabel  -->
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="submit" name="proses" value="Simpan" class="btn btn-info"> <!-- yang muncul tombol Simpan -->
            <?php } else{ ?> <!-- jika belum -->
                <input type="submit" name="proses" value="Tambah" class="btn btn-info"> <!-- yang muncul tombol Tambah -->
            <?php } ?> 
          </form>
        </div>
        <div class="col-sm-8">
          <table class="table table-hover">
            <thead>
              <th>No</th>
              <th>Nama Ditributor</th>
              <th>No Telepon</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </thead>
            <tbody>
            <!-- menampilkan data pada database distributor -->
            <?php 
            include 'config.php';
              $sql="select * from distributor";
              $do=$dbh->query($sql); //menjalankan sql
              $no=1;
              foreach ($do as $v) { 
                echo " <tr>
                    <td>$no</td>
                    <td>$v[nama_distributor]</td>
                    <td>$v[telepon]</td>
                    <td>$v[alamat]</td>
                    <td>
                      <a href='vendor.php?id=$v[id_distributor]' class='btn btn-info'>Edit</a>
                      <a href='prosesvendor.php?id=$v[id_distributor]'";?> onclick="javascript:return confirm('Anda Yakin?')" <?php echo " class='btn btn-danger'>Hapus</a> 
                    </td></tr> ";
                $no++;
              }
             ?>
            </tbody>
          </table>
        </div>
      </div>

  </div>
</div>
<?php 
 include_once 'tampilan/footer.php';
 ?>   




