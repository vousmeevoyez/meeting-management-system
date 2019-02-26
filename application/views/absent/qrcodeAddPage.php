<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manajemen Rapat
            <small>Tambah Data Absen</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Manajemen Rapat</a></li>
            <li class="active">Tambah Data Absen</li>
        </ol>
    </section>
        
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Absen</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->            
      <?php $attributes = array('id' => 'updateForm'); ?>
      <?php echo form_open('absent/absentland/doAddUserQrCode', $attributes); ?>
            <form role="form">
              <div class="box-body">
                <span class="errorlanding" id="error"><?php echo validation_errors(); ?></span>
                <div class="form-group">
                  <label for="name">Daftar Nama Peserta</label>
                  <select class="form-control custom-select" id="name" name="name[]" style="width: 400px;">                   
                    <?php foreach($lists as $keys) { ?>
            <option value="<?php echo $keys->app_id; ?>"><?php echo $keys->fullname; ?> | <?php echo $keys->jabatan_name; ?> | <?php echo $keys->unit_kerja_name; ?></option>
          <?php }?>
                  </select>
                </div>
                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                <input type="hidden" name="section" value="<?php echo $section; ?>">
                <input type="hidden" name="qrcode_id" value="<?php echo $qrcode_id; ?>">
              </div>
              <!-- /.box-body -->

              <div class="box-footer" align="center">
                <a href="<?=base_url('absent/absentland/viewqrcodedetail'); echo "/".$qrcode_id; ?>" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>            
          </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
  $(function () {
    $("#status [value='"+$('#statusShadow').val()+"']").prop("selected", true);
    $("#name").customselect();
  });
</script>