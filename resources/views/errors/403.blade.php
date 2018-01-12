<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="author" content="Mosaddek" />
    <meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina" />
    <meta name="description" content="" />
    <link rel="shortcut icon" href="javascript:;" type="image/png">

    <title>Stratus</title>

    <!--easy pie chart-->
    <link href="{{ url('/resources/assets/js/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css" media="screen" />

    <!--vector maps -->
    <link rel="stylesheet" href="{{ url('/resources/assets/js/vector-map/jquery-jvectormap-1.1.1.css') }}">

    <!--right slidebar-->
    <link href="{{ url('/resources/assets/css/slidebars.css') }}" rel="stylesheet">

    <!--switchery-->
    <link href="{{ url('/resources/assets/js/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" media="screen" />

    <!--jquery-ui-->
    <link href="{{ url('/resources/assets/js/jquery-ui/jquery-ui-1.10.1.custom.min.css') }}" rel="stylesheet" />

    <!--iCheck-->
    <link href="{{ url('/resources/assets/js/icheck/skins/all.css') }}" rel="stylesheet">

    <link href="{{ url('/resources/assets/css/owl.carousel.css') }}" rel="stylesheet">

    <!--Data Table-->
    <link href="{{ url('/resources/assets/js/data-table/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ url('/resources/assets/js/data-table/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ url('/resources/assets/js/data-table/css/dataTables.colVis.min.css') }}" rel="stylesheet">
    <link href="{{ url('/resources/assets/js/data-table/css/dataTables.responsive.css') }}" rel="stylesheet">
    <link href="{{ url('/resources/assets/js/data-table/css/dataTables.scroller.css') }}" rel="stylesheet">


    <!--common style-->
    <link href="{{ url('/resources/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('/resources/assets/css/style-responsive.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
        
    <style>
        
     /*----------------------
   404 page
-----------------------*/

.body-404, .body-500 {
   background: #2b2b2d ;
   color: #fff;
}

.error-wrapper {
   text-align: center;
   margin-top: 10%;
}

.error-wrapper .icon-404{
   background: url("../img/404.png") no-repeat;
   width: 337px;
   height: 218px;
   display: inline-block;
   margin-left: 30px;
}

.error-wrapper .icon-403{
   background: url("../img/403.png") no-repeat;
   width: 337px;
   height: 218px;
   display: inline-block;
   margin-left: 30px;
}

.error-wrapper h2 {
   font-size: 20px;
   font-weight: normal;
   margin: -5px 0 30px -70px;
   display: inline-block;
   width: 245px;
   padding: 20px;
   border-radius: 4px;
   text-transform: capitalize;
}

.error-wrapper .green-bg {
   background: #5bc690 ;
}


.error-wrapper a.back-btn:hover {
   color: #5bc690 ;
}

.error-wrapper p, .error-wrapper a {
   font-size: 18px;
}

.error-wrapper p   {
   color: #a978d1 ;
}

.error-wrapper a.back-btn {
   color: #fff;
}


/*-----------------
   500 page
------------------*/


.error-wrapper .purple-bg {
   background: #a978d1 ;
}

.body-500 .error-wrapper p a {
   color: #a978d1 ;
}

.body-500 .error-wrapper p {
   color: #63c18d ;
}

.error-wrapper .icon-500{
   background: url("../img/500.png") no-repeat;
   width: 331px;
   height: 219px;
   display: inline-block;
}

.body-500 .error-wrapper h2 {
   margin: -5px 0 30px -50px;
   width: 300px;
}   
        
        
    </style>
</head>
<body class="sticky-header">

    <section>

  <body class="body-404">

      <section class="error-wrapper">
          <i class="icon-404"></i>
          <div class="text-center">
              <h2 class="green-bg">page not found</h2>
          </div>
          <!-- <p>Record not found or that page doesn’t exist yet.</p> -->
          <p>Sorry the page you are looking for could not be found <br/> Not Found HTTP Exception in Route Collection</p>
          <a href="{{ url('/') }}" class="back-btn">Back to Home</a>
      </section>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>
</html>