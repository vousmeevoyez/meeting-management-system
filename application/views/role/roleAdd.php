	<div class="canvas_container">
		<div class="ttl">Settings</div>
		<div class="canvas_ttl_container">
			<div class="canvas_ttl_top"></div>
			<div class="canvas_ttl"><h1 class="page-title">Roles of Users</h1>
				<div class="spacer"></div>
				<div class="breadcrumbs left">Settings > Roles of Users ><span class="active">Add</span></div>
			</div>
			<div class="canvas_ttl_btm"></div>
		</div>
		<div class="canvas">
			<div class="content_container">
				<span class="errorlanding" id="error"><?php echo validation_errors(); ?></span>
				<?php $attributes = array('id' => 'insertFormRole'); ?>
				<?php echo form_open('role/rolePage/doAddRole', $attributes); ?>
				<table  width="35%" border="0" cellpadding="5" cellspacing="0">
					<tr>
						<td><strong><label>Role Name<span class="red">*</span></label></strong></td>
						<td><input type="text" name="rolename" id="rolename" style="width:150px;" value="<?php echo set_value('rolename'); ?>" /></td>
					</tr>
					<tr>
						<td><strong>Status <span class="red">*</span></strong></td>
						<td width="30%" valign="top">
							<select name="status" style="width:150px;">
								<option value="-1">-- Silahkan Pilih --</option>
								<option value="1">Aktif</option>
								<option value="0">Non Aktif</option>
							</select>
						</td>
					</tr>
                </table>
				<div class="spacer2"></div>
				<div>
					<a id="btnSaveUser" href="#" class="btn" onclick="javascript:insertFunction();">Save</a>
					<a id="btnCancelUser" href="<?php echo base_url() ?>role/rolePage" class="btn">Cancel</a>
				</div>
				<div class="spacer2"></div>
			</div>
   	  </div>
      <div class="canvas_btm"></div>
		<script>
			function insertFunction(){
				document.getElementById('insertFormRole').submit();
			}
		</script>