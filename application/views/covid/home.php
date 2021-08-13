<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  
  <!-- /.box-header -->
  <div class="box-body">
    <div class="col-md-offset-1 col-md-6 col-md-offset-1 well">
  <div class="form-msg"></div>
  
  <h3 style="display:block; text-align:center;">Ketersediaan Rumah Sakit</h3>

  <form id="form-tambah-pegawai" method="POST">
   
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-home"></i>
      </span>
      <select id="province" name="province" class="form-control select2" aria-describedby="sizing-addon2">
        <option value="">
           Pilih Provinsi
          </option>
        <?php
        foreach ($dataProvince['provinces'] as $kota) {
          ?>
          <option value="<?php echo $kota['id']; ?>">
            <?php echo $kota['name']; ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-home"></i>
      </span>
      <select id="kota" name="kota" name="kota" class="form-control select2" aria-describedby="sizing-addon2">
        <option>Pilih Kota (Pilih Provinsi Terlebih Dahulu)</option>
      </select>
    </div>
   
    <div id="prop_id" class="input-group form-group">
    </div>
    
  </form>
</div>
  </div>
  <div id="table-rs" class="box">
  
  <!-- /.box-header -->
 
            
            
</div>
</div>
<script type="text/javascript">
        $(document).ready(function(){

            $('#province').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('corona/getKota');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id+'>'+data[i].name+'</option>';
                        }
                        $('#kota').html(html);

 
                    }
                });
                return false;
            }); 

             $('#kota').change(function(){ 
              var province_id = $('#province').val();
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('corona/getBed');?>",
                    method : "POST",
                    data : {id: id, province_id: province_id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;
                        if(data.length == 0 ) {
                          html += '<div class="box-body"><div class="row col-md-12"><div class="col-md-6">';
                            html += '<h3>Tidak Ada Data</h3></div></div>';
                        }
                        else{
                          for(i=0; i<data.length; i++){
                          
                              html += '<hr style="border: 2px solid #3c8dbc;">';
                              html += '<div class="box-body"><div class="row col-md-12"><div class="col-md-6">';
                              
                              html += '<table class="table ttable-condensed">';
                              html += '<tr><th style="width:130px;">Rumah Sakit</th><td>: '+data[i].name+'</td></tr>';
                              html += '<tr"><th>Alamat</th><td class="text"><span>: '+data[i].address+'</span></td></tr>';
                              html += '<tr><th>Nomor Telp</th><td>: '+data[i].phone+'</td></tr>';
                              html += '</table></div>';
                              html += '<div class="col-md-6"><table class="table ttable-condensed"><tr><th>Antrian</th><td>: '+data[i].queue+'</td></tr><tr><th>Ketersediaan Kasur</th><td>: '+data[i].bed_availability+'</td></tr><tr><th>Info</th><td>: '+data[i].info+'</td></tr></table></div>';
                              html += '</div></div><hr style="border: 2px solid #3c8dbc;">';
                          
                 
                        }
                        }
                        
                        $('#table-rs').html(html);
 
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }  
                });
                return false;
            }); 
             
        });
    </script>
