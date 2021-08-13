<script type="text/javascript">
	var MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false
		});

	window.onload = function() {
		// tampilPegawai();
		// tampilPosisi();
		// tampilKota();
		//tampilTeam();
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
		MyTable = $('#list-data').dataTable();
	}

	function effect_msg_form() {
		// $('.form-msg').hide();
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}

	function tampilPegawai() {
		$.get('<?php echo base_url('Pegawai/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-pegawai').html(data);
			refresh();
		});
	}

	var id_pegawai;
	$(document).on("click", ".konfirmasiHapus-pegawai", function() {
		id_pegawai = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPegawai", function() {
		var id = id_pegawai;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pegawai/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPegawai();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPegawai", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pegawai/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-pegawai').modal('show');
		})
	})

	$('#form-tambah-pegawai').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pegawai/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPegawai();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-pegawai").reset();
				$('#tambah-pegawai').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-pegawai', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pegawai/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPegawai();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-pegawai").reset();
				$('#update-pegawai').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-pegawai').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-pegawai').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Kota
	function tampilKota() {
		$.get('<?php echo base_url('Kota/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kota').html(data);
			refresh();
		});
	}

	var id_kota;
	$(document).on("click", ".konfirmasiHapus-kota", function() {
		id_kota = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataKota", function() {
		var id = id_kota;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilKota();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataKota", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kota').modal('show');
		})
	})

	$(document).on("click", ".detail-dataKota", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-kota').modal('show');
		})
	})

	$(document).on("click", ".detail-dataSurat", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SuratController/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			
			$('#detail-surat').modal('show');
		})
	})

	$('#form-tambah-kota').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kota/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKota();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kota").reset();
				$('#tambah-kota').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kota', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kota/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKota();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kota").reset();
				$('#update-kota').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-kota').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-kota').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Posisi
	function tampilPosisi() {
		$.get('<?php echo base_url('Posisi/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-posisi').html(data);
			refresh();
		});
	}

	var id_posisi;
	$(document).on("click", ".konfirmasiHapus-posisi", function() {
		id_posisi = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPosisi", function() {
		var id = id_posisi;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPosisi();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPosisi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-posisi').modal('show');
		})
	})

	$(document).on("click", ".detail-dataPosisi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-posisi').modal('show');
		})
	})

	$('#form-tambah-posisi').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Posisi/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPosisi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-posisi").reset();
				$('#tambah-posisi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-posisi', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Posisi/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPosisi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-posisi").reset();
				$('#update-posisi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-posisi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-posisi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//team
	
	function tampilTeam() {
		$.get('<?php echo base_url('TeamController/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-team').html(data);
			refresh();
		});
	}

	var id_team;
	$(document).on("click", ".konfirmasiHapus-team", function() {
		id_team = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataTeam", function() {
		var id = id_team;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Team/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPosisi();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataTeam", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('TeamController/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-team').modal('show');
		})
	})

	$(document).on("click", ".update-dataSurat", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SuratController/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-surat').modal('show');
		})
	})

	// $(document).on("click", ".detail-dataTeam", function() {
	// 	var id = $(this).attr("data-id");
		
	// 	$.ajax({
	// 		method: "POST",
	// 		url: "<?php echo base_url('TeamController/detail'); ?>",
	// 		data: "id=" +id
	// 	})
	// 	.done(function(data) {
	// 		$('#tempat-modal').html(data);
	// 		$('#tabel-detail').dataTable({
	// 			  "paging": true,
	// 			  "lengthChange": false,
	// 			  "searching": true,
	// 			  "ordering": true,
	// 			  "info": true,
	// 			  "autoWidth": false
	// 			});
	// 		$('#detail-team').modal('show');
	// 	})
	// })

	$('#form-tambah-team').submit(function(e) {
		//var data = $(this).serialize();
		e.preventDefault(); 
                 $.ajax({
                     url:'<?php echo base_url();?>TeamController/prosesTambah',
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
                      	var out = jQuery.parseJSON(data);
                      		tampilTeam();
                          	if (out.status == 'form') {
								$('.form-msg').html(out.msg);
								effect_msg_form();
							} else {
								document.getElementById("form-tambah-team").reset();
								$('#tambah-team').modal('hide');
								$('.msg').html(out.msg);
								effect_msg();
							}
                   }
                 });

	});
	function tampilSurat() {
		$.get('<?php echo base_url('SuratController/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-surat').html(data);
			refresh();
		});
	}

	$('#form-tambah-surat').submit(function(e) {
		//var data = $(this).serialize();
		e.preventDefault(); 
                 $.ajax({
                     url:'<?php echo base_url();?>SuratController/prosesTambah',
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
                      	var out = jQuery.parseJSON(data);
                      		tampilSurat();
                          	if (out.status == 'form') {
								$('.form-msg').html(out.msg);
								effect_msg_form();
							} else {
								document.getElementById("form-tambah-surat").reset();
								$('#tambah-surat').modal('hide');
								$('.msg').html(out.msg);
								effect_msg();
							}
							//window.location = baseurl + 'SuratController/download/'+id;
                   }
                 });

	});
	$('#tambah-surat').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-surat').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$(document).on('submit', '#form-update-surat', function(e){
		//var data = $(this).serialize();
		e.preventDefault(); 
                 $.ajax({
                     url:'<?php echo base_url();?>SuratController/prosesUpdate',
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
                      	var out = jQuery.parseJSON(data);
                      		tampilSurat();
                          	if (out.status == 'form') {
								$('.form-msg').html(out.msg);
								effect_msg_form();
							} else {
								document.getElementById("form-update-surat").reset();
								$('#update-surat').modal('hide');
								$('.msg').html(out.msg);
								effect_msg();
							}
                   }
                 });
	});

	$(document).on('submit', '#form-update-team', function(e){
		//var data = $(this).serialize();
		e.preventDefault(); 
                 $.ajax({
                     url:'<?php echo base_url();?>TeamController/prosesUpdate',
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
                      	var out = jQuery.parseJSON(data);
                      		tampilTeam();
                          	if (out.status == 'form') {
								$('.form-msg').html(out.msg);
								effect_msg_form();
							} else {
								document.getElementById("form-update-team").reset();
								$('#update-team').modal('hide');
								$('.msg').html(out.msg);
								effect_msg();
							}
                   }
                 });
	});
	var id_team
	$(document).on("click", ".konfirmasiHapus-team", function() {
		id_team = $(this).attr("data-id");
	})

	$(document).on("click", ".hapus-dataTeam", function() {
		var id = id_team;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('TeamController/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilTeam();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".konfirmasiHapus-surat", function() {
		id_team = $(this).attr("data-id");
	})

	$(document).on("click", ".hapus-dataSurat", function() {
		var id = id_team;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SuratController/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilSurat();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$('#tambah-team').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-team').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
</script>