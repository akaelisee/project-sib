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
                                                <input class="form-control user_nom" id="form-1-1" placeholder="Nom de l'utilisateur" type="text" value="<?= isset($userE) ? $userE->nom:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 200px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Prénoms</label>
                                            <div class="col-md-12">
                                                <input class="form-control user_prenoms" id="form-1-1" placeholder="Prénoms de l'utilisateur" type="text" value="<?= isset($userE) ? $userE->prenoms:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 300px;">
                                            <label for="form-1-1" class="col-md-12 control-label">email</label>
                                            <div class="col-md-12">
                                                <input class="form-control user_email" id="form-1-1" placeholder="adresse électronique" type="text" value="<?= isset($userE) ? $userE->email:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 400px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Nom d'utilisation(Pour la connexion)</label>
                                            <div class="col-md-12">
                                                <input class="form-control user_username" id="form-1-1" placeholder="À utiliser pour se connecter" type="text" value="<?= isset($userE) ? $userE->username:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 500px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Mot de passe</label>
                                            <div class="col-md-12">
                                                <input class="form-control user_pass" id="form-1-1" placeholder="Mot de passe de l'utilisateur" type="text" value="<?= isset($userE) ? '':'0123456789' ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 600px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Agence</label>
                                            <div class="col-md-12">
                                                <select class="form-control user_agence" id="form-1-1" placeholder="Prénoms de l'utilisateur" type="text" value="<?= isset($userE) ? $userE->prenoms:'' ?>" required>
                                                    <option value="<?= isset($userE) ? $userE->agence : 'null' ?>"><?= isset($userE) ? $userE->nom_agence : 'Choisissez une agence' ?></option>
                                                    <?php foreach ($agences as $k => $agence): ?>
                                                        <option value="<?= $agence['code'] ?>"><?= $agence['nom'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 600px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Rôle</label>
                                            <div class="col-md-12">
                                                <select class="form-control user_role" id="form-1-1" placeholder="le role de l'utilisateur" required><?= isset($info) ? $info['content']:'' ?>
                                                    <option value="user">Utilisateur</option>
                                                    <option value="root">Administrateur</option>
                                                </select>
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
            url: '?/users/<?= isset($userE) ? "edit":"add" ?>-user',
            method: 'post',
            data: {nom: $('.user_nom').val(), prenoms: $('.user_prenoms').val(), email: $('.user_email').val(), username: $('.user_username').val(), password: $('.user_pass').val(), role: $('.user_role').val(), agence: $('.user_agence').val(), <?= isset($userE) ? "userid: '".$userE['id']."'":"" ?>},
            dataType: 'json'
        })
        .done(function (response) {
            if (response.error) {
                swal("Erreur!", response.message, "error");
            }
            else {
                swal("Succès", response.message, "success");
                setTimeout(function () {
                    window.location.href = '<?= BASE_URI ?>?/account/users';
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