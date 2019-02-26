      <script type="text/javascript">
			   CKEDITOR.config.mathJaxLib = '//cdn.mathjax.org/mathjax/2.6-latest/MathJax.js?config=TeX-AMS_HTML';
         $(function () {
            var active = '<?php echo $active; ?>';            
            $('#'+active).attr("class","active");
            if (active != "dashboard") {
               $('#'+active).parent().parent().attr("class","active");
            }
            $("#start_date").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd MM yy',
                onClose: function(selectedDate){
                    $("#end_date").datepicker( "option", "minDate", selectedDate );
                }
            });

            $("#end_date").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd MM yy',
                onClose: function(selectedDate){
                    $("#start_date").datepicker( "option", "maxDate", selectedDate );
                }
            });

            $("#date").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd MM yy'                
            });
         })
      </script>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          Halaman ini dimuat dalam {elapsed_time} detik, Penggunaan memory {memory_usage}
        </div>
        <strong>Copyright &copy; 2014-2017 <a href="http://almsaeedstudio.com" target="_blank">Almsaeed Studio</a>.</strong> All rights reserved. Customized by <b>Jamkrindo</b>
      </footer>
    </div><!-- ./wrapper -->
  </body>
</html>