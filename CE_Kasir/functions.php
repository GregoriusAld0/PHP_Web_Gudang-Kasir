<?php  
require_once "config.php";

function check_login($user="", $pass=""){
	
	global $con;

	$sql = "SELECT * FROM user WHERE username = :id and password = :pass";
	try {
		$stmt = $con->prepare($sql);
		$stmt->bindValue(':id', $user, PDO::PARAM_STR);
		$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
		
		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt->fetchAll();

			if ($rs != null) {
				return true;
			}else {
				return false;
			}
		}else{
			return false;
		}
	}catch(Exception $e) {
		echo 'Error select_data : '.$e->getMessage();
	}
}
function check_id($user) {
	global $con;

	$sql = "SELECT * FROM user WHERE username = :id";
	try {
		$stmt = $con->prepare($sql);
		$stmt->bindValue(':id', $user, PDO::PARAM_STR);
		
		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt->fetchAll();

			if ($rs != null) {
				return true;
			}else {
				return false;
			}
		}
	}catch(Exception $e) {
		echo 'Error select_data : '.$e->getMessage();
	}
}

function baca_user($id="") {
		global $con;

		$hasil = array();

	 	if ($id != "") $sql = "SELECT * FROM user WHERE username = :id";
		else $sql = "SELECT * FROM user";

		try {
            $stmt = $con->prepare($sql);
            if ($id != "") $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
        		if ($rs != null) {
        			foreach ($rs as $val) {
        				$hasil['idUser'] = $val['id_user'];
        				$hasil['username'] = $val['username'];
        				$hasil['password'] = $val['password'];
        				$hasil['email'] = $val['email'];
						$hasil['roll'] = $val['roll'];
						$hasil['nama'] = $val['nama'];
        			}
        		}
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}

function baca_produk($id="") {
		global $con;

		$hasil = array();

	 	if ($id != "") $sql = "SELECT * FROM produk WHERE id_produk = :id ";
		else $sql = "SELECT * FROM produk ORDER BY RIGHT (kode_produk,5) ASC";

		try {
            $stmt = $con->prepare($sql);
            if ($id != "") $stmt->bindValue(':id', $id, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
    			if ($rs != null) {
    			$i = 0;
    			foreach ($rs as $val) {
    				$hasil[$i]['idProduk'] = $val['id_produk'];
    				$hasil[$i]['kodeProduk'] = $val['kode_produk'];
    				$hasil[$i]['namaProduk'] = $val['nama_produk'];
    				$hasil[$i]['deskripsi'] = $val['deskripsi'];
					$hasil[$i]['stok'] = $val['stok'];
					$hasil[$i]['harga'] = $val['harga'];
					$i++;
    				}
    			}
        		
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}

	function baca_pengumuman($id="") {
		global $con;

		$hasil = array();

	 	if ($id != "") $sql = "SELECT * FROM pengumuman WHERE id_pengumuman = :id ";
		else $sql = "SELECT * FROM pengumuman ORDER BY id_pengumuman DESC";

		try {
            $stmt = $con->prepare($sql);
            if ($id != "") $stmt->bindValue(':id', $id, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
    			if ($rs != null) {
    			$i = 0;
    			foreach ($rs as $val) {
    				$hasil[$i]['idPengumuman'] = $val['id_pengumuman'];
    				$hasil[$i]['isi'] = $val['isi'];
					$i++;
    				}
    			}
        		
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}

	function baca_diskon($id="") {
		global $con;

		$hasil = array();

	 	if ($id != "") $sql = "SELECT * FROM diskon WHERE kode_diskon = :id ";
		else $sql = "SELECT * FROM diskon ORDER BY id_diskon DESC";

		try {
            $stmt = $con->prepare($sql);
            if ($id != "") $stmt->bindValue(':id', $id, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
    			if ($rs != null) {
    			$i = 0;
    			foreach ($rs as $val) {
    				$hasil[$i]['idDiskon'] = $val['id_diskon'];
    				$hasil[$i]['kodeDiskon'] = $val['kode_diskon'];
    				$hasil[$i]['diskon'] = $val['diskon'];
    				$hasil[$i]['expired'] = $val['expired'];
    				$hasil[$i]['stok_diskon'] = $val['stok_diskon'];
					$i++;
    				}
    			}
        		
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}

	function baca_user_noid() {
		global $con;

		$hasil = array();

	 	$sql = "SELECT * FROM user ORDER BY roll ASC";

		try {
            $stmt = $con->prepare($sql);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
    			if ($rs != null) {
    			$i = 0;
    			foreach ($rs as $val) {
    				$hasil[$i]['idUser'] = $val['id_user'];
    				$hasil[$i]['username'] = $val['username'];
    				$hasil[$i]['password'] = $val['password'];
    				$hasil[$i]['email'] = $val['email'];
    				$hasil[$i]['roll'] = $val['roll'];
    				$hasil[$i]['nama'] = $val['nama'];
					$i++;
    				}
    			}
        		
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}

function baca_detail_trx($id="") {
		global $con;

		$hasil = array();

	 	if ($id != "") $sql = "SELECT * FROM detail_pemesanan dp, pemesanan psn WHERE dp.id_pemesanan=psn.id_pemesanan AND dp.id_pemesanan = :id";
		else $sql = "SELECT * FROM detail_pemesanan dp, pemesanan psn WHERE dp.id_pemesanan=psn.id_pemesanan";

		try {
            $stmt = $con->prepare($sql);
            if ($id != "") $stmt->bindValue(':id', $id, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
    			if ($rs != null) {
    			$i = 0;
    			foreach ($rs as $val) {
    				$hasil[$i]['idPemesanan'] = $val['id_pemesanan'];
    				$hasil[$i]['totalHarga'] = $val['total_harga'];
    				$hasil[$i]['totalDibayar'] = $val['total_dibayar'];
    				$hasil[$i]['kembalian'] = $val['kembalian'];
    				$hasil[$i]['diskon'] = $val['diskon'];
    				$hasil[$i]['kode_diskon'] = $val['kode_diskon'];
    				$hasil[$i]['qty'] = $val['kuantitas'];
    				$hasil[$i]['total'] = $val['total'];
    				$hasil[$i]['idProduk'] = $val['id_produk'];
    				$hasil[$i]['namaProduk'] = $val['nama_produk'];
    				$hasil[$i]['deskripsi'] = $val['deskripsi'];
					$hasil[$i]['harga'] = $val['harga'];
					$i++;
    				}
    			}
        		
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}

function baca_detail_trx2($id="") {
		global $con;

		$hasil = array();

	 	if ($id != "") $sql = "SELECT * FROM detail_pemesanan WHERE id_pemesanan = :id";
		else $sql = "SELECT * FROM detail_pemesanan";

		try {
            $stmt = $con->prepare($sql);
            if ($id != "") $stmt->bindValue(':id', $id, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
    			if ($rs != null) {
    			$i = 0;
    			foreach ($rs as $val) {
    				$hasil[$i]['idPemesanan'] = $val['id_pemesanan'];
    				$hasil[$i]['qty'] = $val['kuantitas'];
    				$hasil[$i]['total'] = $val['total'];
    				$hasil[$i]['idProduk'] = $val['id_produk'];
					$i++;
    				}
    			}
        		
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}

function cek_detail_trx($id="") {
		global $con;

		$hasil = array();

	 	if ($id != "") $sql = "SELECT * FROM detail_pemesanan dp, pemesanan psn WHERE dp.id_pemesanan=psn.id_pemesanan AND dp.id_produk = :id";
		else $sql = "SELECT * FROM detail_pemesanan dp, pemesanan psn WHERE dp.id_pemesanan=psn.id_pemesanan";

		try {
            $stmt = $con->prepare($sql);
            if ($id != "") $stmt->bindValue(':id', $id['idProduk'], PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
    			if ($rs != null) {
    			$i = 0;
    			foreach ($rs as $val) {
    				$hasil[$i]['idPemesanan'] = $val['id_pemesanan'];
    				$hasil[$i]['totalHarga'] = $val['total_harga'];
    				$hasil[$i]['totalDibayar'] = $val['total_dibayar'];
    				$hasil[$i]['kembalian'] = $val['kembalian'];
    				$hasil[$i]['qty'] = $val['kuantitas'];
    				$hasil[$i]['total'] = $val['total'];
    				$hasil[$i]['idProduk'] = $val['id_produk'];
    				$hasil[$i]['namaProduk'] = $val['nama_produk'];
    				$hasil[$i]['deskripsi'] = $val['deskripsi'];
					$hasil[$i]['harga'] = $val['harga'];
					$i++;
    				}
    			}
        		
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}

function baca_trx($id="") {
		global $con;

		$hasil = array();

	 	if ($id != "") $sql = "SELECT * FROM pemesanan WHERE id_pemesanan = :id";
		else $sql = "SELECT * FROM pemesanan";

		try {
            $stmt = $con->prepare($sql);
            if ($id != "") $stmt->bindValue(':id', $id, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
    			if ($rs != null) {
    			$i = 0;
    			foreach ($rs as $val) {
    				$hasil[$i]['idPemesanan'] = $val['id_pemesanan'];
    				$hasil[$i]['tglPemesanan'] = $val['tgl_pemesanan'];
    				$hasil[$i]['namaPelanggan'] = $val['nama_pelanggan'];
					$hasil[$i]['alamat'] = $val['alamat'];
					$hasil[$i]['totalHarga'] = $val['total_harga'];
					$hasil[$i]['totalDibayar'] = $val['total_dibayar'];
					$hasil[$i]['kembalian'] = $val['kembalian'];
					$hasil[$i]['kasir'] = $val['kasir'];
					$hasil[$i]['hp'] = $val['hp'];
					$i++;
    				}
    			}
        		
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}

function baca_filter($mulai,$selesai) {
		global $con;

		$hasil = array();
		$sql = "SELECT * FROM pemesanan WHERE tgl_pemesanan BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY)";

		try {
            $stmt = $con->prepare($sql);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
    			if ($rs != null) {
    			$i = 0;
    			foreach ($rs as $val) {
    				$hasil[$i]['idPemesanan'] = $val['id_pemesanan'];
    				$hasil[$i]['tglPemesanan'] = $val['tgl_pemesanan'];
    				$hasil[$i]['namaPelanggan'] = $val['nama_pelanggan'];
					$hasil[$i]['alamat'] = $val['alamat'];
					$hasil[$i]['totalHarga'] = $val['total_harga'];
					$hasil[$i]['totalDibayar'] = $val['total_dibayar'];
					$hasil[$i]['kembalian'] = $val['kembalian'];
					$hasil[$i]['kasir'] = $val['kasir'];
					$hasil[$i]['hp'] = $val['hp'];
					$i++;
    				}
    			}
        		
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}

function baca_pembayaran($id="") {
		global $con;

		$hasil = array();

	 	if ($id != "") $sql = "SELECT * FROM pembayaran p, produk pr WHERE p.id_produk=pr.id_produk AND p.id_produk = :id";
	 	else $sql = "SELECT * FROM pembayaran p, produk pr WHERE p.id_produk=pr.id_produk";
		try {
            $stmt = $con->prepare($sql);
            if ($id != "") $stmt->bindValue(':id', $id, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
        		if ($rs != null) {
        			$i = 0;
        			foreach ($rs as $val) {
        				$hasil[$i]['kodePembayaran'] = $val['id_pembayaran'];
						$hasil[$i]['qty'] = $val['qty'];
						$hasil[$i]['total'] = $val['total'];
						$hasil[$i]['idProduk'] = $val['id_produk'];
						$hasil[$i]['namaProduk'] = $val['nama_produk'];
        				$hasil[$i]['deskripsi'] = $val['deskripsi'];
						$hasil[$i]['stok'] = $val['stok'];
						$hasil[$i]['harga'] = $val['harga'];
						$i++;
        			}
        		}
        	}
        } catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
	}

function cari_barang($cari){
	global $con;
	$hasil = array();
		$sql = "SELECT * FROM produk WHERE kode_produk LIKE '%$cari%' OR nama_produk LIKE '%$cari%' ";
		try {
			$stmt = $con -> prepare($sql);
			$stmt -> execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
    		$rs = $stmt->fetchAll();

    		if ($rs != null) {
        			$i = 0;
        			foreach ($rs as $val) {
        				$hasil[$i]['idProduk'] = $val['id_produk'];
        				$hasil[$i]['kodeProduk'] = $val['kode_produk'];
        				$hasil[$i]['namaProduk'] = $val['nama_produk'];
						$hasil[$i]['deskripsi'] = $val['deskripsi'];
						$hasil[$i]['harga'] = $val['harga'];
						$i++;
        			}
        		}

		}catch(Exception $e) {
			echo 'Error select_data : '.$e->getMessage();
		}

		return $hasil;
		
		}

function tambah_pk($id,$jumlah,$total) {
	global $con;

			try {
				$sql = "INSERT INTO pembayaran (qty, id_produk, total) VALUES (:qty, :id, :total)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':qty', $jumlah, PDO::PARAM_STR);
				$stmt->bindValue(':id', $id, PDO::PARAM_STR);
				$stmt->bindValue(':total', $total, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_pk($id,$jumlah,$total2,$total) {
	global $con;

			try {
				$sql = "UPDATE pembayaran SET qty = :qty, total = :total WHERE id_produk = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':qty', $jumlah+1, PDO::PARAM_STR);
				$stmt->bindValue(':id', $id, PDO::PARAM_STR);
				$stmt->bindValue(':total', $total2+$total, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_qty($id,$qty,$harga) {
	global $con;

			try {
				$sql = "UPDATE pembayaran SET qty = :qty, total = :total WHERE id_produk = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':qty', $qty, PDO::PARAM_STR);
				$stmt->bindValue(':id', $id, PDO::PARAM_STR);
				$stmt->bindValue(':total', $qty*$harga, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_psn_d($data,$total_h) {
	global $con;

			try {
				$sql = "UPDATE pemesanan SET total_harga = :total_harga, kasir = :kasir WHERE id_pemesanan = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':total_harga', $total_h, PDO::PARAM_STR);
				$stmt->bindValue(':kasir', $data['kasir'], PDO::PARAM_STR);
				$stmt->bindValue(':id', $data['kode'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_kasir($data) {
	global $con;

			try {
				$sql = "UPDATE user SET email = :email, nama = :nama WHERE id_user = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
				$stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);
				$stmt->bindValue(':id', $data['idU'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_kasir2($data) {
	global $con;

			try {
				$sql = "UPDATE user SET email = :email, nama = :nama, password = :password WHERE id_user = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
				$stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);
				$stmt->bindValue(':password', $data['password'], PDO::PARAM_STR);
				$stmt->bindValue(':id', $data['idU'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_pengumuman($data) {
	global $con;

			try {
				$sql = "UPDATE pengumuman SET isi = :isi WHERE id_pengumuman = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':isi', $data['isi'], PDO::PARAM_STR);
				$stmt->bindValue(':id', $data['id_pengumuman'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_diskon($data) {
	global $con;

			try {
				$sql = "UPDATE diskon SET diskon = :diskon, expired = :expired, stok_diskon = :stok_diskon WHERE id_diskon = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':diskon', $data['diskon'], PDO::PARAM_STR);
				$stmt->bindValue(':expired', $data['expired'], PDO::PARAM_STR);
				$stmt->bindValue(':stok_diskon', $data['stok_diskon'], PDO::PARAM_STR);
				$stmt->bindValue(':id', $data['id_diskon'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_diskon2($kode, $stok) {
	global $con;

			try {
				$sql = "UPDATE diskon SET stok_diskon = :stok_diskon WHERE kode_diskon = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':stok_diskon', $stok, PDO::PARAM_STR);
				$stmt->bindValue(':id', $kode, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_dtl_psn($qty,$idP,$id,$harga) {
	global $con;

			try {
				$sql = "UPDATE detail_pemesanan SET kuantitas= :kuantitas, total= :total WHERE id_pemesanan = :id AND id_produk = :idProduk";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':kuantitas', $qty, PDO::PARAM_STR);
				$stmt->bindValue(':total', $qty*$harga, PDO::PARAM_STR);
				$stmt->bindValue(':id', $id, PDO::PARAM_STR);
				$stmt->bindValue(':idProduk', $idP, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function delete_pk($id) {
	global $con;

			try {
				$sql = "DELETE FROM pembayaran WHERE id_produk = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':id', $id, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function delete_pr($id) {
	global $con;

			try {
				$sql = "DELETE FROM produk WHERE id_produk = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':id', $id, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function delete_kasir($id) {
	global $con;

			try {
				$sql = "DELETE FROM user WHERE username = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':id', $id, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function delete_pengumuman($id) {
	global $con;

			try {
				$sql = "DELETE FROM pengumuman WHERE id_pengumuman = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':id', $id, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function delete_diskon($id) {
	global $con;

			try {
				$sql = "DELETE FROM diskon WHERE id_diskon = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':id', $id, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function tambah_dtl($data,$x) {
	global $con;

			try {
				$sql = "INSERT INTO detail_pemesanan (id_pemesanan, id_produk, nama_produk, deskripsi, harga, kuantitas, total) VALUES (:id_p, :id, :nama_produk, :deskripsi, :harga, :qty, :total)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':qty', $data['qty'][$x], PDO::PARAM_STR);
				$stmt->bindValue(':id', $data['idProduk'][$x], PDO::PARAM_STR);
				$stmt->bindValue(':id_p', $data['id'], PDO::PARAM_STR);
				$stmt->bindValue(':nama_produk', $data['nama_produk'][$x], PDO::PARAM_STR);
				$stmt->bindValue(':deskripsi', $data['deskripsi'][$x], PDO::PARAM_STR);
				$stmt->bindValue(':harga', $data['harga'][$x], PDO::PARAM_STR);
				$stmt->bindValue(':total', $data['total'][$x], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function tambah_dtl_psn_d($data,$harga) {
	global $con;

			try {
				$sql = "INSERT INTO detail_pemesanan (id_pemesanan, id_produk, nama_produk, deskripsi, harga, kuantitas, total) VALUES (:id_p, :id, :nama_produk, :deskripsi, :harga, :qty, :total)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':qty', $data['kuantitas'], PDO::PARAM_STR);
				$stmt->bindValue(':id', $data['idProduk'], PDO::PARAM_STR);
				$stmt->bindValue(':nama_produk', $data['nama_produk'], PDO::PARAM_STR);
				$stmt->bindValue(':deskripsi', $data['deskripsi'], PDO::PARAM_STR);
				$stmt->bindValue(':harga', $data['harga'], PDO::PARAM_STR);
				$stmt->bindValue(':id_p', $data['kode'], PDO::PARAM_STR);
				$stmt->bindValue(':total', $data['kuantitas']*$harga, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function tambah_kasir($data) {
	global $con;

			try {
				$sql = "INSERT INTO user (username, password, roll, email, nama) VALUES (:username, :password, :roll, :email, :nama)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':username', $data['username'], PDO::PARAM_STR);
				$stmt->bindValue(':password', md5($data['password']), PDO::PARAM_STR);
				$stmt->bindValue(':roll', $data['roll'], PDO::PARAM_STR);
				$stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
				$stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function tambah_diskon($data) {
	global $con;

			try {
				$sql = "INSERT INTO diskon (kode_diskon, diskon, expired, stok_diskon) VALUES (:kode_diskon, :diskon, :expired, :stok_diskon)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':kode_diskon', $data['kode_diskon'], PDO::PARAM_STR);
				$stmt->bindValue(':diskon', $data['diskon'], PDO::PARAM_STR);
				$stmt->bindValue(':expired', $data['expired'], PDO::PARAM_STR);
				$stmt->bindValue(':stok_diskon', $data['stok_diskon'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function tambah_pengumuman($data) {
	global $con;

			try {
				$sql = "INSERT INTO pengumuman (isi) VALUES (:isi)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':isi', $data['isi'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_pr($id,$stok) {
	global $con;

			try {
				$sql = "UPDATE produk SET stok = :stok WHERE id_produk = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':stok', $stok, PDO::PARAM_STR);
				$stmt->bindValue(':id', $id, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_pr2($data) {
	global $con;

			try {
				$sql = "UPDATE produk SET harga = :harga WHERE id_produk = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':harga', $data['harga'], PDO::PARAM_STR);
				$stmt->bindValue(':id', $data['id'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function update_pwd($user, $pass) {
	global $con;

			try {
				$sql = "UPDATE user SET password = :password WHERE username = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':password', $pass, PDO::PARAM_STR);
				$stmt->bindValue(':id', $user, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function tambah_psn($data) {
	global $con;

			try {
				$sql = "INSERT INTO pemesanan (id_pemesanan, nama_pelanggan, alamat, total_harga, total_dibayar, kembalian, kasir, hp, diskon, kode_diskon) VALUES (:id, :nama, :alamat, :total_harga, :total_dibayar, :kembalian, :kasir, :hp, :diskon, :kode_diskon)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':id', $data['id'], PDO::PARAM_STR);
				$stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);
				$stmt->bindValue(':hp', $data['hp'], PDO::PARAM_STR);
				$stmt->bindValue(':alamat', $data['alamat'], PDO::PARAM_STR);
				$stmt->bindValue(':total_harga', $data['total_harga'], PDO::PARAM_STR);
				$stmt->bindValue(':total_dibayar', $data['total_dibayar'], PDO::PARAM_STR);
				$stmt->bindValue(':kembalian', $data['kembalian'], PDO::PARAM_STR);
				$stmt->bindValue(':kasir', $data['kasir'], PDO::PARAM_STR);
				$stmt->bindValue(':diskon', $data['diskon'], PDO::PARAM_STR);
				$stmt->bindValue(':kode_diskon', $data['kode_diskon'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function tambah_psn_d($data,$total) {
	global $con;

			try {
				$sql = "INSERT INTO pemesanan (id_pemesanan, tgl_pemesanan, nama_pelanggan, alamat, total_harga, kasir, hp) VALUES (:id, :tgl, :nama, :alamat, :total_harga, :kasir, :hp)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':id', $data['kode'], PDO::PARAM_STR);
				$stmt->bindValue(':tgl', $data['tgl'], PDO::PARAM_STR);
				$stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);
				$stmt->bindValue(':alamat', $data['alamat'], PDO::PARAM_STR);
				$stmt->bindValue(':total_harga', $total, PDO::PARAM_STR);
				$stmt->bindValue(':kasir', $data['kasir'], PDO::PARAM_STR);
				$stmt->bindValue(':hp', $data['hp'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function delete_pem() {
	global $con;

			try {
				$sql = "DELETE FROM pembayaran";
				$stmt = $con->prepare($sql);
				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function gen_trx() {
	global $con;

	try {
		$sql = "SELECT MAX(id_detail_psn) AS noAkhir FROM detail_pemesanan";
		$stmt = $con->prepare($sql);
		if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
        		if ($rs != null) {
        			foreach ($rs as $val) {
        				$hasil['noAkhir'] = $val['noAkhir'];
        			}
        		}
        	}
	} catch(Exception $e) {
		echo 'Error insert_data : '.$e->getMessage();
		return false;
	}
	return $hasil;
}

function gen_diskon() {
	global $con;

	try {
		$sql = "SELECT MAX(id_diskon) AS noAkhir FROM diskon";
		$stmt = $con->prepare($sql);
		if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
        		$rs = $stmt->fetchAll();
        		
        		if ($rs != null) {
        			foreach ($rs as $val) {
        				$hasil['noAkhir'] = $val['noAkhir'];
        			}
        		}
        	}
	} catch(Exception $e) {
		echo 'Error insert_data : '.$e->getMessage();
		return false;
	}
	return $hasil;
}

function tambah_keluar($data,$x,$nama) {
	global $con;

			try {
				$sql = "INSERT INTO tbl_keluar (id_produk, penerima, kuantitas) VALUES (:id, :penerima, :qty)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':qty', $data['qty'][$x], PDO::PARAM_STR);
				$stmt->bindValue(':id', $data['idProduk'][$x], PDO::PARAM_STR);
				$stmt->bindValue(':penerima', $nama, PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}

function tambah_masuk($data) {
	global $con;

			try {
				$sql = "INSERT INTO tbl_masuk (id_produk, keterangan, kuantitas) VALUES (:id, :ket, :qty)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':qty', $data['kuantitas'], PDO::PARAM_STR);
				$stmt->bindValue(':id', $data['idProduk'], PDO::PARAM_STR);
				$stmt->bindValue(':ket', $data['ket'], PDO::PARAM_STR);

				if ($stmt->execute()) $ok = true;
				else return false;
			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
}
?>

