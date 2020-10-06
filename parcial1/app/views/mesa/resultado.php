<?php
require_once('../app/views/template/header.php');
?>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        <?php 
        $varr=$_SESSION['resultadosMesa'];
        foreach ($varr as $key => $value) {?>
           data.addRow(["<?php echo Partido::getNombre($value->idPartido) ?>",<?php echo $value->cantidad ?>]); 
        <?php } ?>
        
       

        // Set chart options
        var options = {'title':'',
                       'width':600,
                       'height':500};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Resultados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
            <div class="card card-default">
                <form method="post" action="?controller=jurado&action=guardar">
                    <div class="card-header">
                        <h3 class="card-title">Mesa: <?php echo $_SESSION['mesaactual'] ?></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div id="chart_div"></div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    

                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>


   

</div>


<?php
require_once('../app/views/template/footer.php');
?>


