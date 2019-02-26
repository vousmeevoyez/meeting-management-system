	<script type="text/javascript">
	$(document).ready(function() {
		// <![CDATA[
		var table = $("#listRolesForAdmin").dataTable({
			"aoColumnDefs": [{ "bSearchable": false, "aTargets": [ 2 ] }, {"bSortable": false, "aTargets": [ 2 ]}],
			"bLengthChange" : false,
			"bFilter" : true,
			"bInfo" : true,
			"sPaginationType" : "full_numbers",
			"sDom": '<"top">rt<"bottom"lp><"clear">',
			"sScrollX": "100%",
			"sScrollY": "310",
            "bPaginate" : false,
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				$.ajax( {
					"dataType": 'json',
					"type": "GET",
					"url": sSource,
					"data": aoData,
					"success": fnCallback
				} );
			}
		}).columnFilter({aoColumns:[
			null,
			{ sSelector: "#nameFilter"},
			{ sSelector: "#statusFilter", type:"select" },
			null
		]});
		// ]]>
	});
	</script>
	<!-- START OF CANVAS -->
    <div class="canvas_container">
        <div class="ttl">Settings</div>

    	<div class="canvas_ttl_container">
            <div class="canvas_ttl_top">&#160;</div>
            <div class="canvas_ttl"><h1 class="page-title">Roles of Users</h1>
           	<div class="spacer">&#160;</div>
            <div class="breadcrumbs left">Settings > Roles of Users ><span class="active">Roles of Users Page</span></div>
			</div>
            <div class="canvas_ttl_btm">&#160;</div>
        </div>
        <div class="canvas">
        	<div style="color: red;"><p><b><util:message message="${message}" messages="${messages}" /></b></p></div>
        	<!-- START OF FILTER -->
            <div class="filter_container">
     			<table>
					<tr>
						<td width="17%;"><strong>Name :</strong></td><td width="30%;"><p id="nameFilter"></p></td>
						<td width="15%;"><strong>Status :</strong></td><td><p id="statusFilter"></p></td>
					</tr>
				</table>
            </div>
            <div class="spacer2">&#160;</div>
            <!-- END OF FILTER -->
            <!-- START OF LISTING TABLE -->
            <div class="listing_container">
            	<table id="listRolesForAdmin" border="0" cellspacing="0" cellpadding="2" class="table table-striped">
				<thead>
					<tr>
						<th>No.</th>
						<th>Role Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tfoot>
			        <tr>
			            <th></th>
			            <th></th>
			            <th></th>
			            <th></th>
			        </tr>
			    </tfoot>
				<tbody>
					<?php $index=1; foreach($listRolesForAdmin as $keys) { ?>
						<tr>
							<td valign="middle" align="center" width="5%"><?php echo $index; ?></td>
							<td><?php echo $keys->admin_role_name; ?></td>
							<td><?php if($keys->admin_role_status == 1) echo "Aktif"; else echo "Non Aktif"; ?></td>
							<td valign="middle" align="center" width="10%">
								<a href="<?php echo base_url() ?>role/rolePage/edit/<?php echo $keys->admin_role_id; ?>">Edit</a> | 
								<a role="button" href="#!" name="#deletion" class="showoverlay" onClick="javascript:showOverlay_new(this);setDeletionURL('rolePage/delete/<?php echo $keys->admin_role_id; ?>');">Delete</a>
							</td>
						</tr>
					<?php $index++; } ?>
				</tbody>
			</table>
			<input type="hidden" name="iddelete" />
            </div>
            <div class="spacer2">&#160;</div>
            <!-- END OF LISTING TABLE -->
            <!-- START OF ACTION BUTTON -->
	            <table width="100%" border="0" cellpadding="2" cellspacing="0">
	              <tr>
	                <td width="85%">
					<a class="btn" href="<?php echo base_url() ?>role/rolePage/add">Add</a>
	                </td>
	                <td width="15%" align="right">&#160;</td>
	              </tr>
	            </table>
            <div class="spacer2">&#160;</div>
            <!-- END OF ACTION BUTTON -->
   	  </div>
        <div class="canvas_btm">&#160;</div>
    </div>
    <!-- END OF CANVAS -->