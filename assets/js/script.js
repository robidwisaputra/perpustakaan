// SWEETALERT
const flashdata = $('.flash-data').data('flashdata');	
if(flashdata){
	Swal.fire({
	  position: 'center',
	  icon: 'success',
	  title: 'Data berhasil ' + flashdata,
	  showConfirmButton: false,
	  timer: 1800
	})
}

$('.tombol-hapus').on('click', function(e){

	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
	  title: 'Apu Kamu Yakin?',
	  text: "Data Ini Akan Dihapus",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Hapus'
	}).then((result) => {
	  if (result.value) {
	    document.location.href = href;
  	}
  	else {
  		Swal.fire({
			  icon: 'error',
			  title: 'Hapus dibatalkan',
			  text: ''
			})
  	}
	});
});

const pesan = $('.gagal-login').data('pesan');
if(pesan){
		Swal.fire({
	  icon: 'error',
	  title: pesan,
	  text: ''
	})
}

// PILIH ANGGOTA dan BUKU
$('.pilih-anggota').click(function(){
  var id_anggota = $(this).closest('tr').find('td:eq(0)').text();
  var nama_anggota = $(this).closest('tr').find('td:eq(2)').text();
  var status_anggota = $(this).closest('tr').find('td:eq(5)').text();

$('#id_anggota').val(id_anggota);
$('.nama_anggota').val(nama_anggota);
$('.status_anggota').text(status_anggota);
$('#modalAnggota').modal('hide');

});

$('.pilih-buku').click(function(){
  var id_buku = $(this).closest('tr').find('td:eq(0)').text();
  var judul = $(this).closest('tr').find('td:eq(2)').text();
  var jenis = $(this).closest('tr').find('td:eq(3)').text();
  var pengarang = $(this).closest('tr').find('td:eq(4)').text();
  var penerbit = $(this).closest('tr').find('td:eq(5)').text();

$('#id_buku').val(id_buku);
$('#judul').val(judul);
$('#jenis').text(jenis);
$('#pengarang').text(pengarang);
$('#penerbit').text(penerbit);
$('#modalBuku').modal('hide');

});


$('.pilih-anggota-pengembalian').click(function(){
  var id_anggota = $(this).closest('tr').find('td:eq(0)').text();
  var nama_anggota = $(this).closest('tr').find('td:eq(2)').text();
  var status_anggota = $(this).closest('tr').find('td:eq(5)').text();

	

$.ajax({
	url: 'http://localhost/perpustakaan/pengembalian/getpeminjaman',
	data: {id : id_anggota},
	method: 'post',
	dataType: 'json',
	success: function(data){
		if(data.buku == null || data.peminjaman == null || data.detail == null){
			Swal.fire({
			  icon: 'error',
			  title: 'Peminjaman belum dilakukan',
			  text: ''});
		}
		else {
			$('#id_anggota').val(id_anggota);
			$('.nama_anggota').val(nama_anggota);
			$('.status_anggota').text(status_anggota);
			$('#modalAnggota').modal('hide');

			$('#tanggal-pinjam').val(data.peminjaman.tgl_pinjam);
			$('#judul').text(data.buku.judul);
			$('#jenis').text(data.buku.jenis);
			$('#pengarang').text(data.buku.pengarang);
			$('#penerbit').text(data.buku.penerbit);
			$('#id_peminjaman').val(data.peminjaman.id_peminjaman);
			$('#id_buku').val(data.buku.id_buku);
		}
	}
});

});