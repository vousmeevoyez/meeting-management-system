<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manajemen Rapat
            <small>Tambah</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Manajemen Rapat</a></li>
            <li class="active">Tambah</li>
        </ol>
    </section>
        
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<?php $attributes = array('id' => 'insertFormUser'); ?>
			<?php echo form_open('absent/absentland/doAdd', $attributes); ?>
            <form role="form">
              <div class="box-body">
              	<span class="errorlanding" id="error"><?php echo validation_errors(); ?></span>                
                <div class="form-group">
                  <label for="username">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo set_value('name'); ?>">
                </div>
                <div class="form-group">
                  <label for="username">Time</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter time ex: 09.00 - 15.00" value="<?php echo set_value('time'); ?>">
                </div>
                <div class="form-group">
                  <label for="username">Date</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter date ex: 21 Desember 2017" value="<?php echo set_value('date'); ?>">
                </div>
                <div class="form-group">
                  <label for="username">Place</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter place" value="<?php echo set_value('place'); ?>">
                </div>
                <div class="form-group">
                  <label for="speaker">Speaker</label>
                  <input type="text" class="form-control" id="speaker" name="speaker" placeholder="Enter speaker" value="<?php echo set_value('speaker'); ?>">
                </div>
                <div class="form-group">
                  <label for="host">Host</label>
                  <input type="text" class="form-control" id="host" name="host" placeholder="Enter host" value="<?php echo set_value('host'); ?>">
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" id="status" name="status">
                    <option value="-1">-- Please Select --</option>
                    <option value="1">Active</option>
					<option value="0">Non Active</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              	<a href="<?=base_url('absent/absentland');?>" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
	$(function () {
		
	});
</script>