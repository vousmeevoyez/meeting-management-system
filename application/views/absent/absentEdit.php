<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manajemen Rapat
            <small>Generate QR Code</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Manajemen Rapat</a></li>
            <li class="active">Generate QR Code</li>
        </ol>
    </section>
        
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Generate QR Code</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php foreach ($singleData as $user): ?>
			<?php $attributes = array('id' => 'updateForm'); ?>
			<?php echo form_open('absent/absentland/doGenerateQrCode', $attributes); ?>
            <form role="form">
              <div class="box-body">
              	<span class="errorlanding" id="error"><?php echo validation_errors(); ?></span>
                <div class="form-group" align="center">
                  <label for="name">Name</label> :
                  <?php echo $user['name']; ?>
                  <input type="hidden" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>">
                </div>
                <!-- <div class="form-group" align="center">
                  <label for="time">Time</label> :
                  <?php echo $user['time']; ?>
                </div> -->
                <div class="form-group" align="center">
                  <label for="date">Start Date</label> :
                  <?php echo $user['start_date']; ?>
                </div>
                 <div class="form-group" align="center">
                  <label for="date">End Date</label> :
                  <?php echo $user['end_date']; ?>
                </div>
                <div class="form-group" align="center">
                  <label for="place">Place</label> :
                  <?php echo $user['place']; ?>
                </div>
                <!-- <div class="form-group" align="center">
                  <label for="speaker">Speaker</label> :
                  <?php echo $user['speaker']; ?>                  
                </div>
                <div class="form-group" align="center">
                  <label for="host">Host</label> :
                  <?php echo $user['host']; ?>
                </div> -->
                <div class="form-group" align="center">
                  <label for="qrcode">Ingin generate berapa QR Code?</label>
                  <select class="form-control" id="qrcode" name="qrcode">
                    <option value="-1">-- Please Select --</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer" align="center">
              	<a href="<?=base_url('absent/absentland');?>" class="btn btn-default">Cancel</a>
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