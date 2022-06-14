// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
  $('#datahasil').DataTable();
  // $('#datatrx').DataTable();
  // $('#dataPengumuman').DataTable();
});
//untuk data kosong
$('#dataTable').DataTable( {
	"bInfo": false,
      "pageLength": 5,
      "lengthMenu": [ 5, 10, 100 ],
    "language": {
      "emptyTable": "Produk tidak tersedia",
      "zeroRecords": "Produk tidak ditemukan",
      "lengthMenu": "Tampilkan _MENU_ ",
      "paginate" : {
        "next": ">",
        "previous": "<"
      },
      "sSearch": "Cari Produk"
    }

} );

$('#datatrx').DataTable( {
  "bInfo": false,
      "pageLength": 5,
      "lengthMenu": [ 5, 10, 100 ],
    "language": {
      "emptyTable": "Transaksi belum dibuat",
      "zeroRecords": "Pencarian tidak ditemukan",
      "lengthMenu": "Tampilkan _MENU_ ",
      "paginate" : {
        "next": ">",
        "previous": "<"
      },
      "sSearch": "Cari"
    }

} );

$('#dataPengumuman').DataTable( {
  "bInfo": false,
      "pageLength": 5,
      "bLengthChange": false,
      "lengthMenu": [ 5, 10, 100 ],
    "language": {
      "emptyTable": "Tidak ada Pengumuman",
      "zeroRecords": "Pencarian tidak ditemukan",
      "lengthMenu": "Tampilkan _MENU_ ",
      "paginate" : {
        "next": ">",
        "previous": "<"
      },
      "sSearch": "Cari"
    }

} ); 

$('#dataAkun').DataTable( {
  "bInfo": false,
      "pageLength": 5,
      "bLengthChange": false,
      "lengthMenu": [ 5, 10, 100 ],
    "language": {
      "zeroRecords": "Akun tidak ditemukan",
      "lengthMenu": "Tampilkan _MENU_ ",
      "paginate" : {
        "next": ">",
        "previous": "<"
      },
      "sSearch": "Cari"
    }

} ); 

$('#dataKasir').DataTable( {
  "bInfo": false,
      "pageLength": 5,
      "lengthMenu": [ 5, 10, 100 ],
    "language": {
      "emptyTable": "Masukan produk pada menu Cari Produk",
      "zeroRecords": "Produk tidak ditemukan",
      "lengthMenu": "Tampilkan _MENU_ ",
      "paginate" : {
        "next": ">",
        "previous": "<"
      },
      "sSearch": "Cari"
    }

} );

$('#datahasil').DataTable( {
    "bFilter": false,
    "bInfo": false,
    "pageLength": 5,
    "lengthMenu": [ 5 ],
    "language": {
      "zeroRecords": "Produk tidak ditemukan",
      "paginate" : {
        "next": ">",
        "previous": "<"
      },
      "lengthMenu": "Tampilkan _MENU_ "
    }
} );


