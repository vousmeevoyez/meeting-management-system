<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rapat
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Master Data</a></li>
            <li class="active">Rapat</li>
        </ol>
    </section>
        
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php foreach ($singleData as $user): ?>
			<?php $attributes = array('id' => 'updateForm'); ?>
			<?php echo form_open('meeting/meetingland/doEdit', $attributes); ?>
            <form role="form">
              <div class="box-body">
              	<span class="errorlanding" id="error"><?php echo validation_errors(); ?></span>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $user['name']; ?>">
                </div>
                <div class="form-group">
                  <label for="time">Time</label>
                  <input type="text" class="form-control" id="time" name="time" placeholder="Enter time ex: 09.00 - 15.00" value="<?php echo $user['time']; ?>">
                </div>
                <div class="form-group">
                  <label for="start_date">Start Date</label>
                  <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Enter date ex: 21 Desember 2017" value="<?php echo $user['start_date']; ?>">
                </div>
                <div class="form-group">
                  <label for="end_date">End Date</label>
                  <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Enter date ex: 21 Desember 2017" value="<?php echo $user['end_date']; ?>">
                </div>
                <div class="form-group">
                  <label for="location">Location</label>
                  <input type="text" class="form-control" id="location" name="location" placeholder="Enter place" value="<?php echo $user['place']; ?>">
                </div>
                <div class="form-group">
                  <label for="speaker">Speaker</label>
                  <input type="text" class="form-control" id="speaker" name="speaker" placeholder="Enter speaker" value="<?php echo $user['speaker']; ?>">
                </div>
                <div class="form-group">
                  <label for="host">Host</label>
                  <input type="text" class="form-control" id="host" name="host" placeholder="Enter host" value="<?php echo $user['host']; ?>">
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" id="status" name="status">
                    <option value="-1">-- Please Select --</option>
                    <option value="1">Active</option>
					<option value="0">Non Active</option>
                  </select>
                  <input id="statusShadow" type="hidden" name="statusShadow" value="<?php echo $user['status']; ?>" />
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              	<a href="<?=base_url('meeting/meetingland');?>" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            <?php endforeach; ?>
          </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
	$(function () {
		$("#status [value='"+$('#statusShadow').val()+"']").prop("selected", true);
	});
</script>