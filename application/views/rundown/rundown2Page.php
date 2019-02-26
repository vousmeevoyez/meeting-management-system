<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rundown Rapat
            <small>Daftar Rundown Rapat</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li><a href="#">Rundown Rapat</a></li>
            <li class="active">Daftar Rundown Rapat</li>
        </ol>
    </section>
        
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h2 class="infoLanding"><?php echo urldecode($info); ?></h2>
                <h3 class="box-title">Daftar Rundown Rapat</h3>
            </div>
            <div class="box-header">
                <a href="<?=base_url('rundown/rundownland/add'); echo "/".$event_id;?>" class="btn btn-primary">Tambah Data</a>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Meeting Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Rundown Name</th>
                    <th>Speaker</th>
                    <th>Status</th>                    
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Meeting Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Rundown Name</th>
                    <th>Speaker</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                    <?php $index=1; foreach($lists as $keys) { ?>
                    <tr>
                      <td valign="middle" align="center" width="5%"><?php echo $index; ?></td>
                      <td class="wordWrap"><?php echo $keys->meeting_name; ?></td>
                      <td class="wordWrap"><?php echo $keys->date; ?></td>
                      <td class="wordWrap"><?php echo $keys->rundown_time; ?></td>
                      <td class="wordWrap"><?php echo $keys->rundown_name; ?></td>
                      <td class="wordWrap"><?php echo $keys->rundown_speaker; ?></td>
                      <td><?php if($keys->status == 1) echo "Active"; else echo "Non Active"; ?></td>                      
                      <td valign="middle" align="center" width="10%">
                        <a href="<?php echo base_url() ?>rundown/rundownland/edit/<?php echo $keys->rundown_id; ?>">Edit</a> | 
                        <a href="#!" onClick="dodelete('<?php echo base_url() ?>rundown/rundownland/doDelete/<?php echo $keys->rundown_id; ?>/<?php echo $keys->event_id; ?>');">Delete</a>
                      </td>
                    </tr>
                  <?php $index++; } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
  function dodelete(url) {
      if(confirm("Do u want to delete data?")) {
          window.location.href = url;
      }
  }

  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "responsive" : true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>