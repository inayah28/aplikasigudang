<?php
include 'tampilan/header.php';
include 'tampilan/navbar.php';
include 'config.php';
?>
<br><br><br><br><br><br><br><br>
<div class="container">
	<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	            <h1 class="page-header">Pengeluaran</h1>
	        </div>
	        <!-- /.col-lg-12 -->

	    </div>
	      <br>
	    <div class="row">
	    	<div class="col-sm-4">
	    		<?php 
                if (isset($_GET['id'])) {
                    # code...
                    $id=$_GET['id'];
                    $sql="select * from pengeluaran where id_pengeluaran=$id";
                    $field=$dbh->query($sql)-> fetch();
                }else{
                    $field=[
                            'distributor'=>'',
                            'no_do'=>'',
                            'tgl_pengiriman'=>'',
                            'no_so'=>'',
                            'stok'=>'',
                            'no_truk'=>'',
                            'nm_sopir'=>''

                    ];
                }
             ?>
             <?php if (isset($_GET['stok'])): ?>
	    		 	<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Jumlah Stok tidak cukup 
                    </div>
	    		 <?php endif ?>
	    		<form method="post" action="prosespengeluaran.php">
	    			<div class="form-group input-group">
	    				<span class="input-group-addon">Delivery Order</span>
	    				<input class="form-control" type="text" name="no_do" value="<?php echo $field['no_do']?>" >
	    			</div>
	    			<select class="form-control" name="distributor" value="<?php echo $field['distributor']?>">
	    			<?php 
	    			include 'config.php';
	    				$sql="select * from distributor";
	    				$do=$dbh->query($sql);
	    				foreach ($do as $a) {
	    					echo "<option value='$a[id_distributor]'>$a[nama_distributor]</option>";
	    				}
	    			 ?>
	    			</select> <br>
	    			<div class="form-group input-group">
	    				<span class="input-group-addon">Sales Order</span>
	    				<input class="form-control" type="text" name="no_so" value="<?php echo $field['no_so']?>">
	    			</div>
	    			<div class="form-group input-group">
	    				<span class="input-group-addon">Tanggal Pengiriman</span>
	    				<input class="form-control" type="date" name="tgl_pengiriman" value="<?php echo $field['tgl_pengiriman']?>">
	    			</div>
	    			<input class="form-control" type="text" name="stok" placeholder="Stok" value="<?php echo $field['stok']?>"><br>	    			
	    			<input class="form-control" type="text" name="no_truk" placeholder="No Truk" value="<?php echo $field['no_truk']?>"><br>
	    			<input class="form-control" type="text" name="nm_sopir" placeholder="Nama Sopir" value="<?php echo $field['nm_sopir']?>"><br>
	    			<input type="submit" name="proses" value="Submit" class="btn btn-info" onclick="javascript:return confirm('Apakah data sudah benar?')" ><br><br><br>
	    		</form>
	    	</div>
	    	
	    		

	    		 <?php if (isset($_GET['distributor'])): ?>
	    		 	<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Nama distributor tidak di temukan 
                    </div>
	    		 <?php endif ?>
	    	
	    	<br>
	    	<div class="col-sm-8">
	    		<table class="table table-hover">
	    			<thead>
	    				<th>No</th>
	    				<th>Nomor SO</th>
	    				<th>Stok</th>
	    				<th>Distributor</th>
	    			</thead>
	    			<tbody>
	    				<?php 
	    				include 'config.php';
	    				$sql="SELECT * FROM gudang,distributor where gudang.id_distributor=distributor.id_distributor";
	    				$do=$dbh->query($sql); //menjalankan sql
	    				$no=1;
	    				$jml=0;
	    				foreach ($do as $v) { 
	    					echo "
	    						<tr>
					    			<td>$no</td>
					    			<td>$v[no_so]</td>
					    			<td>$v[jmlparty]</td>
					    			<td>$v[nama_distributor]</td>
					    		</tr>
	    					";
	    					$no++;
	    					 //perhitungan stok
	    				}	
	    				 ?>
	    			</tbody>
	    		</table>
	    		
	    	</div>
	    		<table class="table table-hover">
	    			<thead>
	    				<th>No</th>
	    				<th>No Delivery Order</th>
	    				<th>Distributor</th>
	    				<th>Tanggal Pengiriman</th>
	    				<th>Stok</th>
	    				<th>No Truk</th>
	    				<th>Nama Sopir</th>
	    				<th>Aksi</th>
	    			</thead>
	    			<tbody>
	    				<?php 
	    				include 'config.php';
	    				$sql="SELECT * FROM `distributor`,pengeluaran where distributor.id_distributor=pengeluaran.id_distributor ";
	    				$do=$dbh->query($sql); //menjalankan sql
	    				$no=1;
	    				$jml=0;
	    				foreach ($do as $v) { 
	    					echo "
	    						<tr>
					    			<td>$no</td>
					    			<td>$v[no_do]</td>
					    			<td>$v[nama_distributor]</td>
					    			<td>$v[tgl_pengiriman]</td>
					    			<td>$v[stok]</td>
					    			<td>$v[no_truk]</td>
					    			<td>$v[nm_sopir]</td>
					    			<td> <a href='pengeluaran.php?id=$v[id_pengeluaran]&no=$v[no_so]&dis=$v[id_distributor]&stok=$v[stok]' class='btn btn-info'>Edit</a>
					    			<a href='prosespengeluaran.php?id=$v[id_pengeluaran]&no=$v[no_so]&dis=$v[id_distributor]&stok=$v[stok] '";?> onclick="javascript:return confirm('Anda Yakin?')" <?php echo " class='btn btn-danger' name='proses'>Hapus</a> </td>
					    		</tr>
	    					";
	    					$no++;
	    					$jml +=$v['stok']; //perhitungan stok
	    				}
	    				?>
	    			</tbody>
	    			<tr>
	    				<td>Jumlah</td>
	    				<td><?php echo $jml; ?></td>
	    			</tr>
	    		</table>
	    	</div>
	</div>

</div>
			<!-- End contact-page Area -->

<?php 
 include_once 'tampilan/footer.php';
 ?>		



