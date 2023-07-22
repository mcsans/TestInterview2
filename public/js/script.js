$(document).ready(function(){
  readData();
});

const token   = $('meta[name="csrf-token"]').attr("content");
const baseurl = $('meta[name="baseurl"]').attr("content");

// SWEETALERT
const Toast = Swal.mixin({
	toast: true,
	position: 'bottom-end',
	showConfirmButton: false,
	timer: 3000,
	timerProgressBar: true,
	didOpen: (toast) => {
	toast.addEventListener('mouseenter', Swal.stopTimer)
	toast.addEventListener('mouseleave', Swal.resumeTimer)
	}
})

function sweetalert(icon, title) {
	Toast.fire({
		icon: icon,
		title: title
	})
}

// Read
function readData() {
	$.ajax({
		type: "get",
		url: `/${baseurl}/readData`,
		datatype: 'html',
		async: false,
		success: function(data) {
			$('#tbody').html(data);
		}
	});
}

// Showform
function showForm(id) {
	if(id == null) {
		$.get(`/${baseurl}/showForm`, {}, function(data) {
			$('#showForm').html(data);
			modal_add.showModal();
		});
	} else {
		$.get(`/${baseurl}/showForm?id=`+id, {}, function(data) {
			$('#showForm').html(data);
			modal_edit.showModal();
		});
	}
}

function showFormStock() {
  $.get(`/${baseurl}/showFormStock`, {}, function(data) {
    $('#showForm').html(data);
    modal_add.showModal();
  });
}

// Form add
$('#showForm').on('submit', '.form-add', function(e){
  e.preventDefault();
  modal_add.close();

	$.ajax({
		type:'POST',
		url: $(this).attr('action'),
		data: $(this).serialize(),
		success: (data) => {
			if(data == "") {
				readData();
				sweetalert('success', 'Data added successfully');
			} else {
				$('#showForm').html(data);
        modal_add.showModal();
			}
		}
	});
});

// Form edit
$('#showForm').on('submit', '.form-edit', function(e){
	e.preventDefault();
  modal_edit.close();

	$.ajax({
		type:'POST',
		url: $(this).attr('action'),
		data: $(this).serialize(),
		success: (data) => {
      console.log(data);
			if(data == "") {
				readData();
				sweetalert('success', 'Data changed successfully');
			} else {
				$('#showForm').html(data);
        modal_edit.showModal();
			}
		}
	});
});

// FORM ADD FILE
$('#showForm').on('submit', '.form-add-file', function(e){
	e.preventDefault();
	modal_add.close();
	let formData = new FormData(this);

	$.ajax({
		type:'POST',
		url: $(this).attr('action'),
		data: formData,
		contentType: false,
		processData: false,
		success: (data) => {
			if(data == "") {
				readData();
				sweetalert('success', 'Data changed successfully');
			} else {
				$('#showForm').html(data);
        modal_add.showModal();
			}
		}
	});
});

// FORM EDIT FILE
$('#showForm').on('submit', '.form-edit-file', function(e){
	e.preventDefault();
	modal_edit.close();
	let formData = new FormData(this);

	$.ajax({
		type:'POST',
		url: $(this).attr('action'),
		data: formData,
		contentType: false,
		processData: false,
		success: (data) => {
			if(data == "") {
				readData();
				sweetalert('success', 'Data changed successfully');
			} else {
				$('#showForm').html(data);
        modal_edit.showModal();
			}
		}
	});
});

// FORM DELETE
$('#tbody').on('click', '.form-delete', function(e){
	e.preventDefault();
	const id = $(this).data('id');
	const name = $(this).data('name');

	Swal.fire({
		icon: 'warning',
		title: 'Are you sure?',
		text: `Data ${name} will be deleted.`,
		showCancelButton: true,
		confirmButtonText: 'Sure',
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(`/${baseurl}/${id}`, { "_method": "DELETE", "_token": token, "id": id }, function(data) {
				readData();
				sweetalert('success', 'Data deleted successfully');
			}); 
		}
	})
});

// Tambahkan barang ke keranjang
$('#tbody').on('click', '.add-to-cart', function(e){
	var jumlahCart = parseInt($('#info-cart').data('jumlah'));

  $.ajax({
		type:'POST',
		url: '/keranjang-pesanan',
    data: { "_token": token, 'barang_id': $(this).data('id'), },
		success: (data) => {
      console.log(data);
			if(data == "") {
				readData();
				sweetalert('success', 'Data added successfully');
				$('#info-cart').html(`+${(jumlahCart+1)}`);
				$('#info-cart').data('jumlah', (jumlahCart+1));
			} else {
				sweetalert('error', data);
			}
		}
	});
});

$('#tambah-barang').on('change', function(e){
  $.ajax({
		type:'POST',
		url: baseurl,
    data: { "_token": token, 'barang_id': $(this).val(), },
		success: (data) => {
      console.log(data);
			if(data == "") {
				readData();
				sweetalert('success', 'Data added successfully');
			} else {
				sweetalert('error', data);
			}
		}
	});

  $(this).val(0);
});

// Update jumlah di keranjang
$('#tbody').on('keyup', '.tambah-jumlah-barang', function(e){
  const id        = $(this).data('id');
  const barang_id = $(this).data('barang');
  const jumlah    = $(this).val();

  if(jumlah > 0) {
    $.ajax({
      type:'POST',
      url: `${baseurl}/${id}`,
      data: { "_method": "PUT", "_token": token, 'barang_id': barang_id, 'jumlah': jumlah },
      success: (data) => {
        console.log(data);
        if(data == "") {
          readData();
        } else {
          sweetalert('error', 'Not enough stock');
          $(this).val(data)
        }
      }
    });
  }
});

// Update tunai di keranjang
$('#tbody').on('keyup', '#tunai', function(e){
  var tunai = parseInt($(this).val());
  var total = parseInt($('#total').val());

  if(tunai >= total) {
    $(this).removeClass('input-error');
    $('#kembali').removeClass('text-error');
    $('#kembali').html(`Rp.${(tunai-total).toLocaleString("de-DE")},-`);
  } else {
    $(this).addClass('input-error');
    $('#kembali').addClass('text-error');
    $('#kembali').html(`Rp.${(tunai-total).toLocaleString("de-DE")},-`);
  }
});

// reset keranjang
$('#reset-keranjang').on('click', function(e){
	Swal.fire({
		icon: 'warning',
		title: 'Apakah anda yakin?',
		text: `Keranjang belanja akan di reset.`,
		showCancelButton: true,
		confirmButtonText: 'Sure',
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(`/${baseurl}/reset-keranjang`, { "_token": token }, function() {
				readData();
				sweetalert('success', 'Reset Pesanan Berhasil');
			}); 
		}
	})
});

// pembayaran
$('#pembayaran').on('click', function(e){
	Swal.fire({
		icon: 'question',
		title: 'Lanjutkan Pembayaran?',
		showCancelButton: true,
		confirmButtonText: 'Sure',
	}).then((result) => {
		if (result.isConfirmed) {
			var tunai = parseInt($('#tunai').val());
			var total = parseInt($('#total').val());
		
			if(tunai >= total) {
				$.post(`/${baseurl}/pembayaran`, { "_token": token, "tunai": tunai, "total": total }, function(data) {
					readData();
					sweetalert('success', 'Pembayaran Berhasil');
				}); 
			} else {
				sweetalert('error', 'Gagal, Tunai tidak cukup');
			}
		}
	})
});

// detail transaksi
function detailTransaksi(id) {
  $.get(`/${baseurl}/detailTransaksi?id=`+id, {}, function(data) {
    $('#showForm').html(data);
    modal_detail.showModal();
  });
}