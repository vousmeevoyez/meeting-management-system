<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengguna Aplikasi
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active">Pengguna Aplikasi</li>
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
            <?php foreach ($singleUser as $user): ?>
			<?php $attributes = array('id' => 'updateForm'); ?>
			<?php echo form_open('memberuser/memberuser/doEdit', $attributes); ?>
            <form role="form">
              <div class="box-body">
              	<span class="errorlanding" id="error"><?php echo validation_errors(); ?></span>
                <div class="form-group">
                  <label for="jabatan">Jabatan</label>
                  <select class="form-control" id="jabatan" name="jabatan">
                    <option value="-1">-- Please Select --</option>
                    <?php foreach($listsJabatan as $keys) { ?>
            <option value="<?php echo $keys->jabatan_id; ?>"><?php echo $keys->name; ?></option>
          <?php }?>
                  </select>
                  <input id="jabatanShadow" type="hidden" name="jabatanShadow" value="<?php echo $user['jabatan_id']; ?>" />
                </div>
                <div class="form-group">
                  <label for="workunit">Unit Kerja</label>
                  <select class="form-control" id="workunit" name="workunit">
                    <option value="-1">-- Please Select --</option>
                    <?php foreach($listsWorkunit as $keys) { ?>
            <option value="<?php echo $keys->unit_kerja_id; ?>"><?php echo $keys->name; ?></option>
          <?php }?>
                  </select>
                  <input id="workunitShadow" type="hidden" name="workunitShadow" value="<?php echo $user['unit_kerja_id']; ?>" />
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo $user['username']; ?>">
                </div>
                <div class="form-group">
                  <label for="fullname">Fullname</label>
                  <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullname" value="<?php echo $user['fullname']; ?>">
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="fullname" name="address" placeholder="Enter address" value="<?php echo $user['address']; ?>">
                </div>
                <div class="form-group">
                  <label for="phoneno">Phone No</label>
                  <input type="text" class="form-control" id="phoneno" name="phoneno" placeholder="Enter phone no" value="<?php echo $user['phoneno']; ?>">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $user['email']; ?>">
                </div>
                <div class="form-group">
                  <label for="changePassword">Want to change password?</label>
                  <input id="changePassword" style="min-width:0px;" type="checkbox" />
                </div>
                <div class="form-group" id="forPassword" style="display:none;">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
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
              	<a href="<?=base_url('memberuser/memberuser');?>" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            <?php endforeach; ?>
          </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
	$(function () {
    $("#jabatan [value='"+$('#jabatanShadow').val()+"']").prop("selected", true);
    $("#workunit [value='"+$('#workunitShadow').val()+"']").prop("selected", true);
		$("#status [value='"+$('#statusShadow').val()+"']").prop("selected", true);
		$("#changePassword").click(function() {
			if ($('#changePassword').is(":checked")){
				$("#forPassword").show();
			} else {
				$("#forPassword").hide();
			}
		});
	});
</script>