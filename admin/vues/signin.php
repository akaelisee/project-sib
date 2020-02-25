<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>SIB - Côte d'Ivoire</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= WROOT . 'THEME/' ?>assets/images/logo/favicon.png">

    <!-- plugins css -->
    <link rel="stylesheet" href="<?= WROOT . 'THEME/' ?>assets/bower_components/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= WROOT . 'THEME/' ?>assets/bower_components/PACE/themes/blue/pace-theme-minimal.css" />
    <link rel="stylesheet" href="<?= WROOT . 'THEME/' ?>assets/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" />

    <!-- core css -->
    <link href="<?= WROOT . 'THEME/' ?>assets/css/ei-icon.css" rel="stylesheet">
    <link href="<?= WROOT . 'THEME/' ?>assets/css/themify-icons.css" rel="stylesheet">
    <link href="<?= WROOT . 'THEME/' ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= WROOT . 'THEME/' ?>assets/css/animate.min.css" rel="stylesheet">
    <link href="<?= WROOT . 'THEME/' ?>assets/css/app.css" rel="stylesheet">
</head>

<body>
<div class="app">
    <div class="authentication">
        <div class="sign-in">
            <div class="row no-mrg-horizon">
                <div class="col-md-8 no-pdd-horizon hidden-xs">
                    <div class="full-height bg" style="background-image: url('<?= WROOT . 'THEME/' ?>assets/images/others/img-29.jpg')">
                        <div class="img-caption">
                            <h1 class="caption-title">SIB Côte d'Ivoire</h1>
                            <p class="caption-text">Société Ivoirienne de Banque. Siège social Abidjan plateau - Cote d'Ivoire</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 no-pdd-horizon">
                    <div class="full-height bg-white height-100">
                        <div class="vertical-align full-height pdd-horizon-70">
                            <div class="table-cell">
                                <div class="pdd-horizon-15" style="margin-top: 30%;">
                                    <h2>Login</h2>
                                    <p class="mrg-btm-15 font-size-13">Entrez votre login et vote mot de passe.</p>
                                    <form action="?/users/login" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Nom d'utilisateur" name="username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Mot de passe" name="password">
                                        </div>
                                        <div class="checkbox font-size-12">
                                            <!--<input id="agreement" name="agreement" type="checkbox">-->
                                            <!--<label for="agreement">Keep Me Signed In</label>-->
                                        </div>
                                        <?= Posts::getCSRF() ?>
                                        <button class="btn btn-info">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="login-footer">
                            <img class="img-responsive inline-block" src="<?= WROOT . 'THEME/' ?>assets/images/logo/logosib.png" width="45" alt="">
                            <span class="font-size-13 pull-right pdd-top-10">&copy; SIB Cote d'Ivoire.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= WROOT . 'THEME/' ?>assets/js/vendor.js"></script>

<script src="<?= WROOT . 'THEME/' ?>assets/js/app.min.js"></script>

<!-- page js -->

</body>

</html>