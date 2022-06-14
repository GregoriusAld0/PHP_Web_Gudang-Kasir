<?php
require 'function.php';
require 'cek.php';

?>

<html>
<head>
  <title>Stok Produk</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2>Tabel Stok Produk</h2>
			<h4>(Inventory)</h4>
				<div class="data-tables datatable-dark">

                <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Stok</th>
                                                <th>Harga</th>
                                                <th>Deskripsi</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php 
                                                $ambildata_stok = mysqli_query($conn, "SELECT * FROM produk");
                                                while($data = mysqli_fetch_array($ambildata_stok))
                                                {
                                                    $kodeproduk = $data['kode_produk'];
                                                    $namaproduk = $data['nama_produk'];
                                                    $deskripsi = $data['deskripsi'];
                                                    $stok = $data['stok'];
                                                    $harga = $data['harga'];
                                                    $idproduk = $data['id_produk'];
                                                 
                                            ?>

                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?php echo $kodeproduk; ?></td>
                                                <td><?php echo $namaproduk; ?></td>
                                                <td><?php echo $stok; ?></td>
                                                <td>Rp. <?php echo number_format($harga); ?></td>
                                                <td><?php echo $deskripsi; ?></td>
                                            </tr>
                                              
                                            <?php
                                                };

                                            ?>
                     
                                    </table>
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>