<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rundown Rapat
            <small>Tambah</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active">Rundown Rapat</li>
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
			<?php echo form_open_multipart('rundown/rundownland/doAdd', $attributes); ?>
            <form role="form">
              <div class="box-body">
              	<span class="errorlanding" id="error"><?php echo validation_errors(); ?></span>
                <div class="form-group">
                  <label for="meeting">Meeting Name<span id="redstar">*</span></label>
                  <select class="form-control" id="meeting" name="meeting" disabled="true">
                    <option value="-1">-- Please Select --</option>
                    <?php foreach($listsEvent as $keys) { ?>
            <option value="<?php echo $keys->event_id; ?>"><?php echo $keys->name; ?></option>
          <?php }?>
                  </select>
                  <input id="meetingShadow" type="hidden" name="meetingShadow" value="<?php echo $event_id; ?>" />
                </div>
                <div class="form-group">
                  <label for="date">Date<span id="redstar">*</span></label>
                  <input type="text" class="form-control" id="date" name="date" placeholder="Enter date ex: 21 Desember 2017" value="<?php echo set_value('date'); ?>">
                </div>
                <div class="form-group">
                  <label for="time">Time<span id="redstar">*</span></label>
                  <input type="text" class="form-control" id="time" name="time" placeholder="Enter time ex: 09.00 - 09.15" value="<?php echo set_value('time'); ?>">
                </div>
                <div class="form-group">
                  <label for="name">Rundown Name<span id="redstar">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo set_value('name'); ?>">
                </div>
                <div class="form-group">
                  <label for="speaker">Speaker</label>
                  <input type="text" class="form-control" id="speaker" name="speaker" placeholder="Enter speaker" value="<?php echo set_value('speaker'); ?>">
                </div>
                <div class="form-group">
                  <label for="status">Status<span id="redstar">*</span></label>
                  <select class="form-control" id="status" name="status">
                    <option value="-1">-- Please Select --</option>
                    <option value="1">Active</option>
					<option value="0">Non Active</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->              
              <div class="box-footer">
              	<a href="<?=base_url('rundown/rundownland/showrundown'); echo "/".$event_id;?>" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
  $(function () {
    $("#meeting [value='"+$('#meetingShadow').val()+"']").prop("selected", true);
	});
</script>