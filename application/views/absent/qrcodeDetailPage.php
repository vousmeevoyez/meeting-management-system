<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manajemen Rapat
            <small>QR Code Detail</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Manajemen Rapat</a></li>
            <li class="active">QR Code Detail</li>
        </ol>
    </section>
        
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View Data</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php foreach ($singleData as $user): ?>
      <?php $attributes = array('id' => 'updateForm'); ?>
      <?php echo form_open('absent/absentland/doGenerateQrCode', $attributes); ?>
            <form role="form">
              <div class="box-body">
                <span class="errorlanding" id="error"><?php echo validation_errors(); ?></span>
                <div id="boxprint">
                  <table align="center" border="0" style="border-spacing: 20px;border-collapse: separate;">
                    <tr>
                      <td><b>Name</b></td>
                      <td>:</td>
                      <td><?php echo $user['name']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Section</b></td>
                      <td>:</td>
                      <td><?php echo $user['section']; ?></td>
                    </tr>
                    <!-- <tr>
                      <td><b>Time</b></td>
                      <td>:</td>
                      <td><?php echo $user['time']; ?></td>
                    </tr> -->
                    <tr>
                      <td><b>Start Date</b></td>
                      <td>:</td>
                      <td><?php echo $user['start_date']; ?></td>
                    </tr>
                    <tr>
                      <td><b>End Date</b></td>
                      <td>:</td>
                      <td><?php echo $user['end_date']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Place</b></td>
                      <td>:</td>
                      <td><?php echo $user['place']; ?></td>
                    </tr>
                    <!-- <tr>
                      <td><b>Speaker</b></td>
                      <td>:</td>
                      <td><?php echo $user['speaker']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Host</b></td>
                      <td>:</td>
                      <td><?php echo $user['host']; ?></td>
                    </tr> -->
                    <tr>
                      <td colspan="3">
                         <img src="<?php echo $user['file']; ?>">
                      </td>                      
                    </tr>
                  </table>
                  <input type="hidden" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>">
                  <input type="hidden" class="form-control" id="time" name="time" value="<?php echo $user['time']; ?>">
                   <input type="hidden" class="form-control" id="start_date" name="start_date" value="<?php echo $user['start_date']; ?>">
                   <input type="hidden" class="form-control" id="end_date" name="end_date" value="<?php echo $user['end_date']; ?>">
                   <input type="hidden" class="form-control" id="section" name="date" value="<?php echo $user['section']; ?>">
                   <input type="hidden" class="form-control" id="place" name="place" value="<?php echo $user['place']; ?>">

                 
                </div>
                  <div class="form-group" align="center">
                    <button type="button" onclick="printJS('boxprint', 'html')">
                        Print Qr Code
                    </button>
                  </div>
                <div id="dtPrintButton"></div>
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Unit Kerja</th>
                    <th>Kehadiran</th>
                    <!-- <th>Meeting Name</th> -->
                    <!-- <th>Section</th> -->
                    <!-- <th>Status</th> -->
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Unit Kerja</th>
                    <th>Kehadiran</th>
                    <!-- <th>Meeting Name</th> -->
                    <!-- <th>Section</th>  -->                   
                    <!-- <th>Status</th> -->
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                    <?php $index=1; foreach($lists as $keys) { ?>
                    <tr>
                      <td valign="middle" align="center" width="5%"><?php echo $index; ?></td>
                      <td class="wordWrap"><?php echo $keys->fullname; ?></td>
                      <td class="wordWrap"><?php echo $keys->jabatan_name; ?></td>
                      <td class="wordWrap"><?php echo $keys->unit_kerja_name; ?></td>
                      <td class="wordWrap"><?php if($keys->is_absent == 0) echo "Tidak Hadir"; else echo date("d-m-Y H:i:s", strtotime($keys->created_date)); ?></td>
                      <!-- <td><?php if($keys->status == 1) echo "Active"; else echo "Non Active"; ?></td> -->
                      <td valign="middle" align="center" width="10%">
                       <!--  <a href="<?php echo base_url() ?>absent/absentland/edit/<?php echo $keys->event_id; ?>">Generate QR</a> | 
                        <a href="<?php echo base_url() ?>absent/absentland/viewqrcode/<?php echo $keys->event_id; ?>">Lihat</a> -->
                        <!-- <a href="<?php echo base_url() ?>absent/absentland/edit/<?php echo $keys->event_id; ?>">Edit</a> |  -->
                        <a href="#!" onClick="dodelete('<?php echo base_url() ?>absent/absentland/doDeleteUser/<?php echo $keys->absent_id."/".$user['qrcode_id']; ?>');">Delete</a>
                      </td>
                    </tr>
                  <?php $index++; } ?>
                </tbody>
              </table>
              </div>
              <!-- /.box-body -->
              <div id="dtPrintButton" class="dropdowndownload" style="font:white"></div>
              <div class="box-footer" align="center">
                <a href="<?=base_url('absent/absentland/viewqrcode'); echo "/".$user['event_id']; ?>" class="btn btn-default">Back</a>
                <button type="button" onclick="window.location.href='<?=base_url('absent/absentland/viewadddata'); echo "/".$user['qrcode_id']."/".$event_id."/".$section; ?>'" class="btn btn-primary">
                        Tambah Data
                    </button>
              </div>
            </form>
            <?php endforeach; ?>
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
    var name = $("#name").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    var time = $("#time").val();
    var section = $("#section").val();
    var place = $("#place").val();
    var t = $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,      
      "buttons": [
                {
                  extend: 'print',
                  exportOptions: {
                      columns: [0,1,2,3,4]
                  },
                  text: 'Print Semua Data',
                  className:'dropbtn',
                  title:'<center>Daftar Hadir<br>Rapat '+name+'<br>Section '+section+'</center>',
                  message:'<center><br>Tanggal : '+start_date+' - '+end_date+'<br>Tempat : '+place+'</center>',
                  
                  customize: function ( win ) {             
                      var innerhtml = win.document.body.innerHTML;
                      var tbodyBefore = innerhtml.substring(0,innerhtml.indexOf("<tbody>"));
                      var tbodyAfter = innerhtml.substring(innerhtml.indexOf("</tbody>"));
                      var tbodyTable = innerhtml.substring(innerhtml.indexOf("<tbody>"),innerhtml.indexOf("</tbody>"));                      
                      win.document.body.innerHTML = '<img src="<?=base_url('assets/admin/images/perum-jamkrindo.png');?>">'+
                        tbodyBefore+tbodyTable+tbodyAfter;
                  }
                },

                {
                  extend: 'print',
                  exportOptions: {
                      columns: [0,1,2,3]
                  },
                  text: 'Print Data Tanpa Kolom Kehadiran',
                  className:'dropbtn',
                  title:'<center>Daftar hadir<br>Rapat '+name+'<br>Section '+section+'</center>',
                  message:'<center>Tanggal : '+start_date+' - '+end_date+'<br>Tempat : '+place+'</center>',
                  customize: function ( win ) {
             
                      var innerhtml = win.document.body.innerHTML;
                      var tbodyBefore = innerhtml.substring(0,innerhtml.indexOf("<tbody>"));
                      var tbodyAfter = innerhtml.substring(innerhtml.indexOf("</tbody>"));
                      var tbodyTable = innerhtml.substring(innerhtml.indexOf("<tbody>"),innerhtml.indexOf("</tbody>"));                      
                      win.document.body.innerHTML = '<img src="<?=base_url('assets/admin/images/perum-jamkrindo.png');?>">'+
                                      tbodyBefore+tbodyTable+tbodyAfter;
                  }
                }
          ]
    });
    t.buttons().container().appendTo('#dtPrintButton');
  });
</script>