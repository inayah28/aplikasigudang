<?php
include_once 'tampilan/header.php';
include_once 'tampilan/navbar.php';
include_once 'config.php';
?>
<br><br><br><br><br><br><br><br>
<div class="container">
    <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Penerimaan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-sm-4" align="center">
                    <?php 
                        if (isset($_GET['id'])) {
                            # code...
                            $id=$_GET['id'];
                            $sql="select * from penerimaan where id_penerimaan=$id";
                            $field=$dbh->query($sql)-> fetch();
                        }else{
                            $field=[
                                    'distributor'=>'',
                                    'tgl_order'=>'',
                                    'tgl_pengiriman'=>'',
                                    'no_so'=>'',
                                    'stok'=>'',
                                    'no_truk'=>'',
                                    'nm_sopir'=>''

                            ];
                        }
                     ?>
                    <form method="post" action="prosespenerimaan.php">
                       <select class="form-control" value="<?php echo $field['distributor']?>"
                       name="distributor" >
                           <?php 
                           include 'config.php';
                            $sql="select * from distributor";
                            $do=$dbh->query($sql);
                            foreach ($do as $a) {
                                # code...
                                echo "<option value='$a[id_distributor]'>$a[nama_distributor]</option>";
                            }
                         ?>
                       </select><br>
                        <div class="form-group input-group" >
                            <span class="input-group-addon">Tanggal Order</span>
                            <input class="form-control" type="date" name="tgl_order" placeholder="Tanggal Order Distributor" value="<?php echo $field['tgl_order']?>" >
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">Tgl Pengiriman</span>
                            <input class="form-control" type="date" name="tgl_pengiriman" value="<?php echo $field['tgl_pengiriman']?>" >
                        </div>
                        <input class="form-control" type="text" name="no_so" placeholder="Nomor SO" value="<?php echo $field['no_so']?>"><br>
                        <input class="form-control" type="text" name="stok" placeholder="Stok" value="<?php echo $field['stok']?>"><br>
                        <input class="form-control" type="text" name="no_truk" placeholder="No Truk" value="<?php echo $field['no_truk']?>"><br>
                        <input class="form-control" type="text" name="nm_sopir" placeholder="Nama Sopir" value="<?php echo $field['nm_sopir']?>"><br>
                        <input type="submit" name="proses" value="Submit" onclick="javascript:return confirm('Apakah data sudah benar?')" class="btn btn-info"><br><br><br>
                    </form>
                </div>
            


            <div class="col-sm-8">                         
                <table class="table table-hover">
                <thead>
                    <th>No</th>
                    <th>Distributor</th>
                    <th>Tanggal Order</th>
                    <th>Tanggal Pengiriman</th>
                    <th>Nomor SO</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php 
                        include'config.php';
                        $sql="SELECT * FROM distributor,penerimaan where distributor.id_distributor=penerimaan.id_distributor ";
                        $do=$dbh->query($sql); //menjalankan sql
                        $no=1;
                        foreach ($do as $v) { 
                            echo "
                                <tr>
                                    <td>$no</td>
                                    <td>$v[nama_distributor]</td>
                                    <td>$v[tgl_order]</td>
                                    <td>$v[tgl_pengiriman]</td>
                                    <td>$v[no_so]</td>
                                    <td>$v[stok]</td>
                                    <td>
                                    <a href='penerimaan.php?id=$v[id_penerimaan]&no=$v[no_so]&dis=$v[id_distributor]&stok=$v[stok]' class='btn btn-info'>Edit</a>
                                    <a href='prosespenerimaan.php?id=$v[id_penerimaan]&no=$v[no_so]&dis=$v[id_distributor]&stok=$v[stok] '";?> onclick="javascript:return confirm('Anda Yakin?')" <?php echo " class='btn btn-danger' name='proses'>Hapus</a> </td>
                                </tr>
                            ";
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










