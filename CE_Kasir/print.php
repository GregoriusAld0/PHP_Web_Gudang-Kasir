<?php  
require_once "functions.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$idtrx = $_GET['id'];

if ((strpos($idtrx,"RT")) === 0) { //cek apakah id transaksi adalah retur
    $idretur = $idtrx;
} else {
    $idretur = 'RT'.$idtrx;
}
$baca_dtl = baca_detail_trx($idtrx);


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Print Transaksi | Central Electronic's</title>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
	<link href="css/styles.css" rel="stylesheet" />
	<script>window.print();</script>
    <style type="text/css" media="print"> 

    @page 
    {
        size:  auto;  
        margin: 0px; 
    }
    body {
    	margin: 40px 80px 80px 40px;
    }
    </style>
</head>
		
<body >
		<div >
			<div class="row">
				<div class="col-md">
					<center class="mb-4">
						<p>Central Electronic's</p>
						<p>Jl. Kebenaran Hakiki, Kec Sidorejo Tenggara</p>
						<p>RT/05 RW/04 No.79, Salatiga</p>
					</center>
					<?php 
					$baca_trx = baca_trx($idtrx);
					$date = $baca_trx[0]['tglPemesanan'];
					$newDate = date("j F Y", strtotime($date)); ?>
						<span>Tanggal : <?= $newDate;?></span><br>
						<span>Kasir : <?= $_SESSION['nama'];?></span><br>
					<div class="table-responsive">
					<table class="table table-hover mt-2" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">No.</th>
								<th class="text-center">Produk</th>
								<th class="text-center">Jumlah</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<?php
						$no=1; 
						if ($idretur != $idtrx) { 
						foreach($baca_dtl as $key => $val){?>
						<tbody>
						<tr>
							<td class="text-center" style="word-wrap: break-word;max-width: 100px;"><?= $no++;?></td>
							<td class="text-center" style="word-wrap: break-word;max-width: 100px;"><?= $val['namaProduk'];?></td>
							<td class="text-center" style="word-wrap: break-word;max-width: 100px;"><?= $val['qty'];?></td>
							<td class="text-center" style="word-wrap: break-word;max-width: 100px;"><?= $val['total'];?></td>
						</tr>
						<?php } }
						$baca_dtl2 = baca_detail_trx($idretur);
						$baca_psn = baca_trx($idretur);
						 if (sizeof($baca_psn) > 0) { // cek apakah transaksi memiliki retur
						 	foreach($baca_dtl2 as $key => $val2){
						 	?>
							<tr>
								<td class="text-center" style="word-wrap: break-word;max-width: 100px;"><?= $no++;?></td>
								<td class="text-center" style="word-wrap: break-word;max-width: 100px;"><?= $val2['namaProduk'];?> (r)</td>
								<td class="text-center" style="word-wrap: break-word;max-width: 100px;"><?= $val2['qty'];?></td>
								<td class="text-center" style="word-wrap: break-word;max-width: 100px;"><?= $val2['total'];?></td>
							</tr>
						<?php } }?>
						</tbody>
					</table>
					</div>
					<div>
						<?php if ($idretur != $idtrx) { ?>
						Total : Rp.<?= number_format($val['totalHarga']);?>,-
						<br/>
						<?php } else { ?>
						Total : Rp.<?= number_format($val2['totalHarga']);?>,-
						<br/>
						<?php } ?>
						<?php if ($idretur != $idtrx) { 
							if ($val['diskon'] > 0) {?>
							Total harga termasuk diskon : Rp.<?= number_format($val['diskon']);?>,-
							<br>
						<?php } ?>
							Bayar : Rp.<?= number_format($val['totalDibayar']);?>,-
							<br/><br/>
							Kembali : Rp.<?= number_format($val['kembalian']);?>,- 
						<?php if (sizeof($baca_psn) > 0) { ?>
						<br>Nilai barang yang diretur : Rp.<?= number_format($val2['totalHarga']);?> (r)
					<?php } }?>
						
						<br/>
						<small>*r Produk dikembalikan (return)</small>
					</div>
					<div style="margin-top: 50px">
					<center>
						<p>Terima Kasih Telah Berbelanja di Toko Kami !</p>
					</center>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>