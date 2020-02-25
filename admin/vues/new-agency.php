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
                    <div class="page-title">
                        <h4><?= $title ?></h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="form-group" style="margin-bottom: 100px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Nom de l'agence</label>
                                            <div class="col-md-12">
                                                <input class="form-control agence_nom" id="form-1-1" placeholder="Nom de l'agence" type="text" value="<?= isset($agence) ? $agence['nom']:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 200px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Code de l'agence</label>
                                            <div class="col-md-12">
                                                <input class="form-control agence_code" id="form-1-1" placeholder="Nom de l'agence" type="text" value="<?= isset($agence) ? $agence['code']:$nextcode ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:300px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Commune ou ville</label>
                                            <div class="col-md-12">
                                                <input class="form-control agence_ville" id="form-1-1" placeholder="Commune de l'agence" type="text" value="<?= isset($agence) ? $agence['commune']:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 400px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Description</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control agence_desc" id="form-1-1" placeholder="Description" required><?= isset($agence) ? $agence['description']:'' ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border top">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" id="saveinfo">Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    $('#saveinfo').on('click', function () {
        $.ajax({
            url: '?/agences/<?= isset($agence) ? "edit":"add" ?>-agence',
            method: 'post',
            data: {nom: $('.agence_nom').val(), description: $('.agence_desc').val(), code: $('.agence_code').val(), ville: $('.agence_ville').val(), <?= isset($agence) ? "codeid: '".$agence['code']."'":"" ?>},
            dataType: 'json'
        })
        .done(function (response) {
            if (response.error) {
                swal("Erreur!", response.message, "error");
            }
            else {
                swal("Succès", response.message, "success");
                setTimeout(function () {
                    window.location.href = '<?= BASE_URI ?>?/account/agency';
                }, 1500);
            }
        })
        .fail(function () {
            swal("Erreur !", "Une erreur est survenue !", "error");
        });
    });
</script>

</body>

</html>