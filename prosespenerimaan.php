<?php
 include 'config.php';
    $distributor=$_POST['distributor'];
    $tgl_order=$_POST['tgl_order'];
    $tgl_pengiriman=$_POST['tgl_pengiriman'];
    $no_so=$_POST['no_so'];
    $stok=$_POST['stok'];
    $no_truk=$_POST['no_truk'];
    $nm_sopir=$_POST['nm_sopir'];
    $tombol=$_POST['proses'];
    $id=$_POST['id'];
     if ($tombol=="Submit") {
        $dbh->query("INSERT INTO penerimaan (id_penerimaan,id_distributor,tgl_order,tgl_pengiriman,no_so,stok,no_truk,nm_sopir) VALUES (NULL,'$distributor','$tgl_order','$tgl_pengiriman','$no_so','$stok','$no_truk','$nm_sopir')");
        //jika noso sama maka akan update jmlparty, jika noso berbeda akan bertambah record baru. 
        $sql="select * from gudang where no_so='$no_so' and id_distributor='$distributor'";
        $cek=$dbh->query($sql)->fetch();
        if ($cek) {
          $id=$cek['id_gudang'];
          $stok=$stok+$cek['jmlparty'];
          $dbh->query("UPDATE gudang set jmlparty='$stok' where  id_gudang='$id'");

        }else{
          $dbh->query("INSERT INTO gudang (id_distributor,no_so,jmlparty) VALUES ('$distributor','$no_so','$stok')");
          
        }
     }else{
        $id=$_GET['id'];
        $no_so=$_GET['no'];
        $dis=$_GET['dis'];
        $stok=$_GET['stok'];
        $sql=  "DELETE FROM `penerimaan` WHERE `penerimaan`.`id_penerimaan` = $id";
        $dbh->query($sql); 
        $sql1=  "DELETE FROM `gudang` WHERE `gudang`.`id_gudang` = $id";
        $dbh->query($sql1); 
     }   
    header('location:penerimaan.php');
    
?>