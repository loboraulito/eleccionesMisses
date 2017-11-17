<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Catec Sistema Elecciones Miss Oruro</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="<?php echo base_url();?>css/fonts.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>css/icon.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url();?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url();?>plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url();?>plugins/animate-css/animate.css" rel="stylesheet" />
    
    <!-- Morris Chart Css-->
    <link href="<?php echo base_url();?>plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url();?>css/themes/all-themes.css" rel="stylesheet" />

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url();?>plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url();?>plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo base_url();?>plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url();?>plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url();?>plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="<?php echo base_url();?>plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Light Gallery Plugin Css -->
    <link href="<?php echo base_url();?>plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
    
    <!-- Jquery knob-->
    <script src="<?php echo base_url();?>plugins/jquery-knob/jquery.knob.min.js"></script>
    
    <!-- Light Gallery Plugin Js -->
    <script src="<?php echo base_url();?>plugins/light-gallery/js/lightgallery-all.js"></script>
</head>

<body class="theme-red">
    
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>

                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html"><img src="<?php echo base_url();?>images/catec.jpg" style="height: 35px; float: left;">Eleccion Miss Oruro (<?php echo $this->session->nombre;?>)</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">                
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">           
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Participantes</li>
                    <?php if(!$participantes):?>
                    <li class="active">
                        <a href="#">
                        </a>
                    </li>
                    <?php else:?>
                        <?php foreach ($participantes as $participante):?>
                            <li>
                                <a href="<?php echo base_url('index.php/votacion/participante/'.$participante->idparticipante);?>">
                                    <i class="material-icons">account_circle</i>
                                    <span><?php echo $participante->idparticipante.' '.$participante->apellidos.' '.$participante->nombres?></span>
                                </a>
                            </li>
                        <?php endforeach;?> 
                    <?php endif;?>
                    
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        
    </section>

    <section class="content">
        
    