<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Dashbord</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="css/clndr.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="js/morris-chart/morris.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
        <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <section id="container">
        <!--sidebar start-->
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.php" class="logo">
                    <h2>Dashbord</h2>
                </a>
            </div>
            <div class="col-md-offset-4">
                <h2><?php echo date('Y F, l d, H:i'); ?></h2>
            </div>
            <!--logo end-->
        </header>
        <!--header end-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="index.php">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>            
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <!--mini statistics start-->
                <div class="row">
                    <div class="col-md-3 col-md-offset-3">
                        <form method="post"  role="form" enctype="multipart/form-data">
                            <input type="file" name="pro" accept=".csv" required><br>
                            <input type="text" name="Produit" hidden value="Produits">
                            <button class="btn btn-info btn-block" type="submit" name="prod">Produit (s)</button><br>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form method="post" role="form" enctype="multipart/form-data">
                            <input type="file" name="util" accept=".csv" required><br>
                            <input type="text" name="Utilisateurs" hidden="" value="Utilisateurs">
                            <button class="btn btn-info btn-block" type="submit" name="user">Utilisateur (s)</button><br>
                        </form>
                    </div>
                    <?php
                        if (isset($_POST['prod'])) {
                        $name = $_FILES['pro']['tmp_name'];
                        $contents = file($name);
                        $col[] = "";
                    ?>
                    <div class="col-md-12">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="top-stats-panel">
                                    <h4 class="widget-h" style="font-size: 35px"><?php echo $_POST['Produit'];?></h4>
                                    <div class="bar-stats">
                                        <ul class="progress-stat-bar clearfix">
                                            <?php
                                                foreach($contents as $line) {
                                                    $line = preg_replace( "/\r|\n/", "", $line );
                                                    $line_array = explode(",",$line);
                                                    if(!in_array($line_array[0],$col)){
                                                        $col[] = $line_array[0];
                                                    }
                                                    $row[$line_array[1]][$line_array[0]]=$line_array[2];
                                                }
                                                unset($col[0]);

                                                foreach($row as $key=>$row_val)
                                                {
                                                    foreach($col as $col_val)
                                                    {
                                                        if(!isset($row_val[$col_val]))
                                                        {
                                                            $row_val[$col_val] = "";
                                                        }
                                                    }
                                                }
                                            ?>
                                            <?php 
                                                foreach($col as $key => $val){ 
                                                $val1 = str_replace('"','',$val); 
                                                if ($val1 < 30 ) { 
                                            ?>
                                            <li  style="width:48px;" data-percent="<?php echo $val1; ?> %"  >
                                                <span class="progress-stat-percent pink" style="height: <?php echo $val1.'%' ; ?>;"></span>                                                
                                                <?php echo $val1; ?><br>
                                            </li>
                                            <?php }} ?>
                                        </ul>
                                        <div class="daily-sales-info">
                                            <span class="sales-count"><?php echo $nbreR = count($row); ?></span> <span class="sales-label">au total, mais sont les 30 dernier <?php echo $_POST['Produit'];?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <?php } ?>
                    <?php
                        if (isset($_POST['user'])) {
                        $name = $_FILES['util']['tmp_name'];
                        $contents = file($name);
                        $col[] = "";
                    ?>
                    <div class="col-md-12">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="top-stats-panel">
                                    <h1 class="widget-h" style="font-size: 35px"><?php echo $_POST['Utilisateurs'];?></h1>
                                    <div class="bar-stats">
                                        <ul class="progress-stat-bar clearfix">
                                            <?php
                                                foreach($contents as $line) {
                                                    $line = preg_replace( "/\r|\n/", "", $line );
                                                    $line_array = explode(",",$line);
                                                    if(!in_array($line_array[0],$col)){
                                                        $col[] = $line_array[0];
                                                    }
                                                    $row[$line_array[1]][$line_array[0]]=$line_array[2];
                                                }
                                                unset($col[0]);

                                                foreach($row as $key=>$row_val)
                                                {
                                                    foreach($col as $col_val)
                                                    {
                                                        if(!isset($row_val[$col_val]))
                                                        {
                                                            $row_val[$col_val] = "";
                                                        }
                                                    }
                                                }
                                            ?>
                                            <?php 
                                                foreach($col as $key => $val){ 
                                                $val1 = str_replace('"','',$val); 
                                                if ($val1 < 30 ) { 
                                            ?>
                                            <li  style="width:48px;" data-percent="<?php echo $val1; ?> %"  >
                                                <span class="progress-stat-percent pink" style="height: <?php echo $val1.'%' ; ?>;"></span>                                                
                                                <?php echo $val1; ?><br>
                                            </li>
                                            <?php }} ?>
                                        </ul>
                                        <div class="daily-sales-info" style="font-size: 20px">
                                            <span class="sales-count"><?php echo $nbreR = count($row); ?></span> <span class="sales-label">au total, mais sont les 30 dernier <?php echo $_POST['Utilisateurs'];?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <?php } ?>
                </div>
                <!--mini statistics end-->
            </section>
        </section>
        <!--main content end-->
    </section>
    <!-- Placed js at the end of the document so the pages load faster -->
    <!--Core js-->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
    <script src="bs3/js/bootstrap.min.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="js/skycons/skycons.js"></script>
    <script src="js/jquery.scrollTo/jquery.scrollTo.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/calendar/clndr.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
    <script src="js/calendar/moment-2.2.1.js"></script>
    <script src="js/evnt.calendar.init.js"></script>
    <script src="js/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
    <script src="js/gauge/gauge.js"></script>
    <!--clock init-->
    <script src="js/css3clock/js/css3clock.js"></script>
    <!--Easy Pie Chart-->
    <script src="js/easypiechart/jquery.easypiechart.js"></script>
    <!--Sparkline Chart-->
    <script src="js/sparkline/jquery.sparkline.js"></script>
    <!--Morris Chart-->
    <script src="js/morris-chart/morris.js"></script>
    <script src="js/morris-chart/raphael-min.js"></script>
    <!--jQuery Flot Chart-->
    <script src="js/flot-chart/jquery.flot.js"></script>
    <script src="js/flot-chart/jquery.flot.tooltip.min.js"></script>
    <script src="js/flot-chart/jquery.flot.resize.js"></script>
    <script src="js/flot-chart/jquery.flot.pie.resize.js"></script>
    <script src="js/flot-chart/jquery.flot.animator.min.js"></script>
    <script src="js/flot-chart/jquery.flot.growraf.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/jquery.customSelect.min.js" ></script>
    <!--common script init for all pages-->
    <script src="js/scripts.js"></script>
    <!--script for this page-->
</body>
</html>