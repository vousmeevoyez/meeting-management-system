<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengguna Admin
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li class="active">Pengguna Admin</li>
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
			<?php $attributes = array('id' => 'updateFormUser'); ?>
			<?php echo form_open('adminuser/adminuser/doEdit', $attributes); ?>
            <form role="form">
              <div class="box-body">
              	<span class="errorlanding" id="error"><?php echo validation_errors(); ?></span>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo $user['username']; ?>">
                </div>
                <div class="form-group">
                  <label for="fullname">Fullname</label>
                  <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullname" value="<?php echo $user['fullname']; ?>">
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
                  <label for="role">Role</label>
                  <select class="form-control" id="role" name="role">
                    <option value="-1">-- Please Select --</option>
                    <?php foreach($listsRole as $keys) { ?>
						<option value="<?php echo $keys->role_id; ?>"><?php echo $keys->name; ?></option>
					<?php }?>
                  </select>
                  <input id="roleShadow" type="hidden" name="roleShadow" value="<?php echo $user['role_id']; ?>" />
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
              	<a href="<?=base_url('adminuser/adminuser');?>" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            <?php endforeach; ?>
          </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
	$(function () {
		$("#role [value='"+$('#roleShadow').val()+"']").prop("selected", true);
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