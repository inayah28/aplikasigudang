<?php
 include 'config.php';

  $no_do=$_POST['no_do'];
 	$no_so=$_POST['no_so'];
	$distributor=$_POST['distributor'];
	$tgl_pengiriman=$_POST['tgl_pengiriman'];
	$stok=$_POST['stok'];
	$no_truk=$_POST['no_truk'];
	$nm_sopir=$_POST['nm_sopir'];
	$tombol=$_POST['proses'];
  $id=$_POST['id']; // dari parameter di pengeluaran.php pada bagian hapus

	//jika tombol di klik maka 
  if ($tombol=="Submit") {
    
// mengurangi jmlparty pada tabel gudang berdasarkan no_so
  	$sql="select * from gudang where no_so='$no_so' and id_distributor='$distributor'"; 
  	$cek=$dbh->query($sql)->fetch(); 
  	if ($cek) { 
  		$id=$cek['id_gudang']; 
  		$jml=$cek['jmlparty']-$stok; 

      if($cek['jmlparty'] < $stok){ 
        echo "mohon maaf stok tidak sesuai dengan permintaan"; //
        header('location:pengeluaran.php?stok=f');
        die();  
      }
      
      $dbh->query("INSERT INTO pengeluaran (id_pengeluaran,id_distributor, no_do,no_so,tgl_pengiriman,stok,no_truk,nm_sopir) VALUES (NULL,'$distributor','$no_do','$no_so','$tgl_pengiriman','$stok','$no_truk','$nm_sopir')");
     
  		$dbh->query("UPDATE gudang set jmlparty='$jml' where  id_gudang='$id'");
    }else{ 
      echo "nama distributor tidak ditemukan"; 
      header('location:pengeluaran.php?distributor=d');
      die();
    }
  }else 
   {  //ngambil dari parameter di pengeluaran.php
      $id=$_GET['id'];
      $no_so=$_GET['no'];
      $dis=$_GET['dis'];
      $stok=$_GET['stok'];
      //
      $sql1="select * from gudang where no_so=$no_so and id_distributor=$dis";
      $a=$dbh->query($sql1)->fetch();
      $jml=$a['jmlparty'];
      $jml=$jml+$stok;//jml pada database gudang yaitu jmlpary di tambah stok yang dipilih user yang akan dihapus

      // update terlebih dahulu jmlpary dengan hasil perhitungan line 50
      $ubah="update gudang set jmlparty='$jml' where id_distributor=$dis and no_so=$no_so";
      $dbh->query($ubah); // dbh menjalankan query ubah
      //baru melakukan query delete sesuai id
      $sql=  "DELETE FROM `pengeluaran` WHERE `pengeluaran`.`id_pengeluaran` = $id";
      $dbh->query($sql); 
    }
  	header('location:pengeluaran.php'); //mengarah ke pengeluaran.php
?>