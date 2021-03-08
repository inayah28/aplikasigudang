<?php 
try {
	//buat koneksi database
		$dbh=new PDO('mysql:host=localhost;dbname=gppbrebes', "root","");
		//set erorr mode
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
} 
catch (Exception $e) {
	// tampilkan pesan kesalahan jika koneksi gagal
	echo "Koneksi atau query bermasalah:".$e->getMessage() . "<br/>";
	die();	
}
?>