<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rundown Rapat
            <small>Daftar Rapat</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Data Master</a></li>
            <li><a href="#">Rundown Rapat</a></li>
            <li class="active">Daftar Rapat</li>
        </ol>
    </section>
        
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h2 class="infoLanding"><?php echo $info; ?></h2>
                <h3 class="box-title">Daftar Rapat</h3>
            </div>            
            <!-- /.box-header -->

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Meeting Name</th>
                    <!-- <th>Time</th> -->
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Meeting Name</th>
                    <!-- <th>Time</th> -->
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                    <?php $index=1; foreach($lists as $keys) { ?>
                    <tr>
                      <td valign="middle" align="center" width="5%"><?php echo $index; ?></td>
                      <td class="wordWrap"><?php echo $keys->name; ?></td>
                      <!-- <td class="wordWrap"><?php echo $keys->time; ?></td> -->
                      <td class="wordWrap"><?php echo $keys->start_date; ?></td>
                      <td class="wordWrap"><?php echo $keys->end_date; ?></td>
                      <td class="wordWrap"><?php echo $keys->place; ?></td>
                      <td><?php if($keys->status == 1) echo "Active"; else echo "Non Active"; ?></td>
                      <td valign="middle" align="center" width="10%">
                        <a href="<?php echo base_url() ?>rundown/rundownland/showrundown/<?php echo $keys->event_id; ?>">Lihat Rundown</a>
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