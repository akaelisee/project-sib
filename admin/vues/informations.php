<!DOCTYPE html>
<html>

<head>
    <?php include_once ROOT. 'vues/includes/default-head.inc.php' ?>
</head>

<body>
<div class="app">
    <div class="layout">
        <!-- Side Nav START -->
        <?php include_once ROOT . 'vues/includes/nav.inc.php' ?>
        <!-- Side Nav END -->

        <!-- Page Container START -->
        <div class="page-container">
            <!-- Header START -->
            <?php include_once ROOT . 'vues/includes/header.inc.php' ?>
            <!-- Header END -->

            <!-- Content Wrapper START -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="page-title" style="position: relative;">
                        <h4><?= $title ?></h4>
                        <a href="?/account/new-info" class="btn btn-info btn-xs" style="position:absolute;right:0;top:0;">
                            <i class="ti-export pdd-right-5"></i>
                            <span style="font-size: 12px;">Passez une information</span>
                        </a>
                    </div>
                    <div class="row">
                        <?php include_once ROOT . 'vues/includes/info-card.inc.php' ?>
                    </div>
                </div>
            </div>
            <!-- Content Wrapper END -->

            <!-- Footer START -->
            <?php include_once ROOT . 'vues/includes/footer.inc.php' ?>
            <!-- Footer END -->

        </div>
        <!-- Page Container END -->

    </div>
</div>

<?php include_once ROOT . 'vues/includes/default-scripts.inc.php' ?>
<script>
    $('.infodelter').on('click', function (e) {
        e.preventDefault();
        var infoid = $(this).data('id');

        swal({
                title: "Êtes vous sure?",
                text: "Vous allez supprimer cette information pour de bon.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, effacer!",
                cancelButtonText: "Non, Annuler!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm){
                if (isConfirm) {
                    $.get({
                        url: '?/infos/delete-info/info='+infoid,
                        dataType: 'json'
                    })
                    .done(function (response) {
                        swal(response.error ? "Erreur !":"Succès", response.message, response.error ? "error":"success");
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500);

                    })
                    .fail(function () {
                        swal("Erreur !", "Une erreur est survenue !", "error");
                    });
                }
            });
    });
</script>

</body>

</html>