<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Unindra Kas | Login Mahasiswa</title>
    <link rel="icon" href="<?php echo media_url('images/favicon.png'); ?>" type="image/x-icon">

    <!-- Bootstrap core CSS --> 
    <link href="<?php echo media_url() ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo media_url() ?>/css/login.css" rel="stylesheet" type="text/css">
    <link href="<?php echo media_url() ?>/fonts/css/font-awesome.min.css" rel="stylesheet">

    <!--  Java Script  -->
    <script src="<?php echo media_url() ?>/js/jquery.min.js"></script>
    <link href="<?php echo media_url() ?>/css/animate.min.css" rel="stylesheet">
    <script src="<?php echo media_url() ?>/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Style body -->
    <style type="text/css" media="screen">
        html {
        }

        html, body {
            background-color: #fff;
            color: #000;
            font-family:"Open Sans";
            overflow-x: hidden;
        }

        a {
            color: #FF6F69;
        }
        a:hover {
            text-decoration: none;
            color: #E0625C;
        }
        
    </style>

</head>

<body>

    <div class="container-fluid headerr">
        <div class="row">
            <div class="col-md-4 col-md-offset-4"><br>
                <center>
                    <img src="<?php echo media_url() ?>/images/informatika.png" height="400" width="150" class="img-responsive">
                    <p class="textjudul">Login Mahasiswa Unindra Teknik Informatika Kelas E</p>
                </center>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="spasi">
                    <?php echo form_open('student/auth/login'); ?>
                    <?php
                    if (isset($_GET['location'])) {
                        echo '<input type="hidden" name="location" value="';
                        if (isset($_GET['location'])) {
                            echo htmlspecialchars($_GET['location']);
                        }
                        echo '" />';
                    } ?>
                    <!-- Jika error -->
                    <?php if ($this->session->flashdata('failed')) { ?>
                        <div class="warning">
                        <center><h5><i class="fa fa-exclamation-triangle"></i> <?php echo $this->session->flashdata('failed') ?></h5></center>
                        </div>
                        <?php } ?>

                    <div class="form-group">
                        <input type="text" autofocus name="nip" required class="kotak form-control" placeholder="NPM">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" required class="kotak form-control" placeholder="Password">
                    </div>
                    <button class="btn btn-login btn-lg col-sm-12 col-xs-12" type="submit">LOGIN</button>
                    <?php echo form_close(); ?>

                        <!-- Footer -->
                        <div class="row spasibawah">
                            <div class="col-md-12">                            
                                <center>&copy; <?php echo pretty_date(date('Y-m-d'), 'Y',FALSE) ?> All Rights Reserved. TI Unindra&trade;</center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
