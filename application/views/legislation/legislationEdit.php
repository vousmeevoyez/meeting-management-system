<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Peraturan Perundangan
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active">Peraturan Perundangan</li>
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
			<?php echo form_open_multipart('legislation/legislationland/doEdit', $attributes); ?>
            <form role="form">
              <div class="box-body">
              	<span class="errorlanding" id="error"><?php echo validation_errors(); ?></span>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $user['name']; ?>">
                </div>
                <div class="form-group">
                  <label for="about">About</label>
                  <input type="text" class="form-control" id="about" name="about" placeholder="Enter about" value="<?php echo $user['about']; ?>">
                </div>
                <div class="form-group">
                  <label for="legislationfile">File</label>
                  <label style="font-size: 12px">(gif, jpg, png, bmp, jpeg, doc, docx, excel, xls, xlsx, pdf)</label>
                  <br />
                  <p>Current File</p>
                  <p><a href="<?php echo $user['file']; ?>" target="_blank"><?php echo $user['file']; ?></a></p>
                  <br />
                  <input id="legislationfileShadow" type='hidden' name="legislationfileShadow" value="<?php echo $user['file']; ?>">
                  <input id="legislationfile" type='file' name="legislationfile">
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
              	<a href="<?=base_url('legislation/legislationland');?>" class="btn btn-default">Cancel</a>
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