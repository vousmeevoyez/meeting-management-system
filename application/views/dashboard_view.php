Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Halaman</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
        
    <!-- Main content -->
    <section class="content">
    <!-- Info boxes -->
        <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div> -->
        <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">VISI PERUSAHAAN</h2>
                    <hr class="primary">
                    <p>Menjadi Perusahaan Penjaminan Terdepan yang Mendukung Perkembangan Perekonomian Nasional</p>
          
          <h2 class="section-heading">MISI PERUSAHAAN</h2>
                    <hr class="primary">
                    <p>Dan untuk mencapai cita-cita ideal perusahaan sebagaimana tersebut di atas,  maka visi perusahaan dijabarkan dalam misi-misi yang merupakan <b>TRIDHARMA JAMKRINDO</b> sebagai berikut:</p>
          <p><b>Dharma Pertama</b> : Melakukan kegiatan penjaminan bagi perkembangan bisnis UMKM dan Koperasi</p>
          <p><b>Dharma Kedua</b> : Memberikan pelayanan yang luas dan berkualitas</p>
          <p><b>Dharma Ketiga</b> : Memberikan manfaat bagi stakeholders sesuai prinsip bisnis yang sehat</p>
          
          <h2 class="section-heading">BUDAYA PERUSAHAAN</h2>
          <hr class="primary">
          <p>Budaya Perusahaan Perum Jamkrindo terdiri dari 5 (lima) butir nilai-nilai budaya yang dianut perusahaan, yaitu budaya <b>TRUST</b>, sebagai berikut:</p>
          <p><b>TERPERCAYA</b> : bekerja jujur dengan Integritas tinggi</p>
          <p><b>RESPONSIF</b> : selalu tanggap menghadapi kebutuhan mitra usaha dan segenap Stakeholder</p>
          <p><b>UNGGUL</b> : selalu meningkatkan profesionalisme demi pencapaian nilai tambah bagi perusahaan</p> 
          <p><b>SEHAT</b> : selalu bekerja dengan tekun untuk mendukung tatakelola perusahaan yang sehat</p>
          <p><b>TERKEMUMKA</b> : selalu terdepan dalam memberikan pelayanan dan kinerja untuk menjadi pemimpin dalam industri penjaminan</p>
          
          <h2 class="section-heading">KREDO PERUSAHAAN</h2>
          <hr class="primary">
          <p>Kredo perushaan Perum Jamkrindo terdiri dari 5 (lima) butir sebagai berikut :</p>
          <p>- Terpercaya dalam melaksanakan usaha penjaminan</p>
          <p>- Responsif terhadap perubahan lingkungan bisnis</p>
          <p>- Unggul dan profesional dalam pelayanan</p> 
          <p>- Sehat dalam tata kelola perusahaan</p>
          <p>- Terkemuka dalam memberikan kepuasan pelanggan</p>
          
          <h2 class="section-heading">MOTTO PERUSAHAAN</h2>
          <hr class="primary">
          <p>"Solusi UMKMK menuju sukses"</p>
          
          <h2 class="section-heading">TAGLINE</h2>
          <hr class="primary">
          <p>"Mitra terpercaya dalam penjaminan"  <i>(Your TRUSTed Guarantee Partner)</i></p>
          
                </div>
    </section><!-- /.content -->
</div>
<script>
    $(function () {
        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
          labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
          datasets: [
            {
              label: "Instant Access",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [65, 59, 80, 81, 56, 55, 40, 32, 12, 56, 88, 5]
            },
            {
              label: "Regular",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [28, 48, 40, 19, 86, 27, 90, 66, 32, 13, 5, 9]
            }
          ]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);

         //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
          {
            value: 700,
            color: "#f56954",
            highlight: "#f56954",
            label: "Matematika"
          },
          {
            value: 500,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "Fisika"
          },
          {
            value: 400,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "Kimia"
          },
          {
            value: 600,
            color: "#00c0ef",
            highlight: "#00c0ef",
            label: "Biologi"
          },
          {
            value: 300,
            color: "#3c8dbc",
            highlight: "#3c8dbc",
            label: "Bahasa Inggris"
          },
          {
            value: 100,
            color: "#d2d6de",
            highlight: "#d2d6de",
            label: "Bahasa Indonesia"
          }
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
    });
</script>