<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Detail Surat</h3>

  <form id="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $dataSurat->id; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" readonly value="<?php echo $dataSurat->nama; ?>" class="form-control" placeholder="Nama Penerima" name="nama" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-envelope"></i>
      </span>
      <input type="text" readonly value="<?php echo $dataSurat->nomor_surat; ?>" class="form-control" placeholder="Nomor Surat" name="nomor_surat" aria-describedby="sizing-addon2">
    </div>
    
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-home"></i>
      </span>
      <input type="text" readonly class="form-control" value="<?php echo $dataSurat->tujuan; ?>" placeholder="Tujuan" name="tujuan" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">

      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
       <p>Tanggal Surat</p>
     <input type="date" readonly value="<?php echo $dataSurat->tanggal_surat; ?>" class="form-control" name="tanggal_surat">
    </div>

     <div class="input-group form-group">

      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
       <p>Tanggal Pengambilan Surat</p>
     <input type="date" readonly value="<?php echo $dataSurat->tanggal_pengembalian_surat; ?>" class="form-control" name="tanggal_pengembalian_surat">
    </div>

    <div class="input-group form-group">

      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
       <p>Tanggal Pengambilan Tanda Terima</p>
     <input type="date" readonly value="<?php echo $dataSurat->tanggal_pengembalian_tanda; ?>" class="form-control" name="tanggal_pengembalian_tanda">
    </div>

     <div class="input-group form-group">

      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-pencil"></i>
      </span>
       <p><b>Keterangan Diterima</b></p>
     <select name="ket_diterima" readonly value="<?php echo $dataSurat->tanggal_pengembalian_tanda; ?>" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Kategori" data-width="80%" placeholder="Pilih Kategori" required>
       <?php if($dataSurat->ket_diterima=='Acc') {

                                        echo "<option value='Acc' selected>Acc</option>";
                                        echo "<option value='Tolak'>Tolak</option>";
                                        echo "<option value='TK'>TK</option>";
                                    } elseif($dataSurat->ket_diterima=='Tolak') {
                                      echo "<option value='Acc'></option>";
                                        echo "<option value='Tolak' selected>Tolak</option>";
                                        echo "<option value='TK' >TK</option>";
                                     } elseif($dataSurat->ket_diterima=='TK') {
                                      echo "<option value='Acc'></option>";
                                        echo "<option value='Tolak' >Tolak</option>";
                                        echo "<option value='TK' selected>TK</option>";

                                    } else {
                                      echo "<option value=''>-</option>";
                                      echo "<option value='Acc'>Acc</option>";
                                      echo "<option value='Tolak'>Tolak</option>";
                                        echo "<option value='TK'>TK</option>";
                                } ?>
                                  
                                </select>
    </div>

    <div class="input-group form-group">

      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-note"></i>
      </span>
       <p>Keterangan</p>
       <textarea readonly class="form-control" rows="3" name="keterangan"><?php echo $dataSurat->keterangan; ?></textarea>
     
    </div>
    
    <div class="form-group">

      <div class="col-md-12">

           <a href="<?php echo base_url()."SuratController/download/".$dataSurat->id; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-download"></i>  Generate Surat</a>
      </div>
    </div>
    
  </form>
</div>


<script type="text/javascript">
$(function () {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
});
</script>