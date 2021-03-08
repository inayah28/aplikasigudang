<?php
include_once 'tampilan/header.php';
include_once 'tampilan/navbar.php';
?><br><br><br><br><br><br><br><br>
<div class="container">

	<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	            <h1 class="page-header">Laporan Pengeluaran</h1>
	        </div>
	        <!-- /.col-lg-12 -->
	    </div>
	    <button onclick="printDiv('printlaporan')" class="btn btn-info">print</button>
	    <div class="row">
	    	
	    	<div class="col-sm-12" id="printlaporan"><br>

	    		<div class="text-center" >

			      <h4><b>P.T. Pupuk Sriwidjaya </b><br><b>Gudang GPP BREBES </b><br>
			      <b>Jl. Raya St. Prupuk Kec. Margasari Kab. Tegal </b></h4>  
			    </div><br><br>
	    		
	    		<table class="table table-hover table-bordered">
	    			<thead>
	    				
		    				<th >No</th>
		    				<th >Distibutor</th>
		    				<th >No Sales Order</th>
		    				<th >Tanggal Pengeluaran</th>
	    				
	    					<th >Stok</th>
	    					<th >No Truk</th>
	    					<th >Nama Sopir</th>
	    					
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
					    			<td>$v[nama_distributor]</td>
					    			<td>$v[no_so]</td>
					    			<td>$v[tgl_pengiriman]</td>
					    			<td>$v[stok]</td>
					    			<td>$v[no_truk]</td>
					    			<td>$v[nm_sopir]</td>
					    			
					    		</tr>
	    					";
	    					$no++;
	    					$jml +=$v['stok'];
	    					
	    				}

	    				 ?> 
	    			</tbody>
	    			<tr>
	    				<td colspan="4" align="center"><b >Jumlah</b></td>
	    				<td><?php echo $jml; ?></td>
	    				<td></td>
	    				<td></td>
	    			</tr>
	    		</table>
	    		<div align="right" class="ttd">
			      <label>Brebes, 
			        <script type="text/javascript">
			          var date = new Date(); //buat objek
			          var tanggal= date.getDate(); //buat tanggal           
			          var bulan=date.getMonth()+1;
			          var tahun=date.getFullYear();
			          document.write(tanggal+'-'+bulan+'-'+tahun);         
			        </script>    
			      </label><br><br><br><br>
			      <label>AMJAD</label><br>
			      <label>KEPALA GUDANG</label>
			    </div>
	    	</div>
	    </div>
	</div>
	<script type="text/javascript">
		function printDiv(divName){
		    var printContents = document.getElementById(divName).innerHTML;
		       var originalContents = document.body.innerHTML;

		       document.body.innerHTML = printContents;

		       window.print();

		       document.body.innerHTML = originalContents;
		  }
</script>
</div>
<?php 
 include_once 'tampilan/footer.php';
 ?>		

