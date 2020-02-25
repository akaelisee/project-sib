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
                                            <label for="form-1-1" class="col-md-12 control-label">Nom</label>
                                            <div class="col-md-12">
                                                <input class="form-control user_nom" id="form-1-1" placeholder="" type="text" value="<?= $user->nom ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 200px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Prenoms</label>
                                            <div class="col-md-12">
                                                <input class="form-control user_prenoms" id="form-1-1" placeholder="" type="text" value="<?= $user->prenoms ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 300px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Email</label>
                                            <div class="col-md-12">
                                                <input class="form-control user_email" id="form-1-1" placeholder="" type="email" value="<?= $user->email?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 400px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Nom d'utilisateur</label>
                                            <div class="col-md-12">
                                                <input class="form-control user_username" id="form-1-1" placeholder="" type="text" value="<?= $user->username?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 500px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Mot de passe</label>
                                            <div class="col-md-12">
                                                <input class="form-control user_pass" id="form-1-1" placeholder="" type="password" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border top">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-success" id="saveuser">Enregistrer</button>
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
    $('#saveuser').on('click', function () {
        $.ajax({
            url: '?/users/edit-user',
            method: 'post',
            data: {nom: $('.user_nom').val(), prenoms: $('.user_prenoms').val(), email: $('.user_email').val(), username: $('.user_username').val(), password: $('.user_pass').val()},
            dataType: 'json'
        })
            .done(function (response) {
                if (response.error) {
                    swal("Erreur!", response.message, "error");
                }
                else {
                    swal("Succès", response.message, "success");
                }
            })
            .fail(function () {
                swal("Erreur !", "Une erreur est survenue !", "error");
            });
    });
</script>

</body>

</html>