<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manajemen Rapat
            <small>Data QR Code / Session</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Manajemen Rapat</a></li>
            <li class="active">Data QR Code / Session</li>
        </ol>
    </section>
        
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h2 class="infoLanding"><?php echo $info; ?></h2>
                <h3 class="box-title">Data QR Code / Session</h3>
            </div>
            <!-- <div class="box-header">
                <a href="<?=base_url('absent/absentland/add');?>" class="btn btn-primary">Tambah Data</a>
            </div> -->
            <!-- /.box-header -->

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>File</th>
                    <th>Section</th>
                    <th>Status</th>
                    <th>Action</th>                    
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>File</th>
                    <th>Section</th>
                    <th>Status</th>
                </tr>
                </tfoot>
                <tbody>
                    <?php $index=1; foreach($lists as $keys) { ?>
                    <tr>
                      <td valign="middle" align="center" width="5%"><?php echo $index; ?></td>
                      <td class="wordWrap"><?php echo $keys->event_name; ?></t>
                      <td class="wordWrap"><a href="<?php echo $keys->file; ?>" target="_blank"><?php echo $keys->file; ?></a></td>
                      <td class="wordWrap"><?php echo $keys->section; ?></td>
                      <td><?php if($keys->status == 1) echo "Active"; else echo "Non Active"; ?></td>
                      <td valign="middle" align="center" width="13%">
                        <a href="<?php echo base_url() ?>absent/absentland/viewqrcodedetail/<?php echo $keys->qrcode_id; ?>">Lihat Absen</a> | 
                        <a href="#" onclick="javascript:myPrint('boxprint'+<?php echo $keys->qrcode_id; ?>)">Print</a>
                        <!-- <a href="<?php echo base_url() ?>absent/absentland/edit/<?php echo $keys->event_id; ?>">Edit</a> | 
                        <a href="#!" onClick="dodelete('<?php echo base_url() ?>absent/absentland/doDelete/<?php echo $keys->event_id; ?>');">Delete</a> -->
                        <div style="display: none;" id="boxprint<?php echo $keys->qrcode_id; ?>">
                        <table align="center" border="0" style="border-spacing: 20px;border-collapse: separate;">
                          <tr>
                            <td><b>Name</b></td>
                            <td>:</td>
                            <td><?php echo $keys->event_name; ?></td>
                          </tr>
                          <tr>
                            <td><b>Section</b></td>
                            <td>:</td>
                            <td><?php echo $keys->section; ?></td>
                          </tr>
                          <tr>
                            <td><b>Start Date</b></td>
                            <td>:</td>
                            <td><?php echo $keys->start_date; ?></td>
                          </tr>
                          <tr>
                            <td><b>End Date</b></td>
                            <td>:</td>
                            <td><?php echo $keys->end_date; ?></td>
                          </tr>                          
                          <tr>
                            <td colspan="3">
                               <img src="<?php echo $keys->file; ?>">
                            </td>                      
                          </tr>
                        </table>
                        </div>
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

  function myPrint(id) {
        var myPrintContent = document.getElementById(id);
        var myPrintWindow = window.open("", "test", 'left=500,top=500,width=1000,height=1000');
        myPrintWindow.document.write(myPrintContent.innerHTML);       
        myPrintWindow.document.close();
        myPrintWindow.focus();
        myPrintWindow.print();
        myPrintWindow.close();    
        return false;
  }

  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false      
    });
  });
</script>