<?php
 include 'config.php';

  	$nama=$_POST['nama'];
  	$alamat=$_POST['alamat'];
  	$telepon=$_POST['telepon'];
  	$tombol=$_POST['proses']; 
  	$id=$_POST['id'];
  	if ($tombol=="Tambah") { //jika yang di klik tombol tambah
  		# code...
  		$sql="INSERT INTO distributor (nama_distributor,alamat,telepon) VALUES ('$nama','$alamat','$telepon')";
 		$dbh->query($sql); //variabel dbh akan menjalankan query variabel sql, variabel dbh adalah pdo pada config
  	}else if ($tombol=="Simpan") { //jikn yang diklik tombol edit
  		# code...
  		$sql="UPDATE distributor SET
             `nama_distributor`='$nama',
             `telepon`='$telepon',
             `alamat`='$alamat'
             WHERE `distributor`.`id_distributor`=$id";
  		$dbh->query($sql); 
  	}

  	else{ 
  		$id=$_GET['id'];
  		$sql= "DELETE FROM `distributor` WHERE `distributor`.`id_distributor` = $id";
  		$dbh->query($sql); 
  	}
  	
  	header('location:vendor.php');

?>