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
                                            <label for="form-1-1" class="col-md-12 control-label">Titre</label>
                                            <div class="col-md-12">
                                                <input class="form-control info_title" id="form-1-1" placeholder="Le titre de l'information" type="text" value="<?= isset($info) ? $info['title']:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 200px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Description</label>
                                            <div class="col-md-12">
                                                <input class="form-control info_desc" id="form-1-1" placeholder="De quoi parle l'information" type="text" value="<?= isset($info) ? $info['description']:'' ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 200px;">
                                            <label for="form-1-1" class="col-md-12 control-label">Description</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control info_content" id="form-1-1" placeholder="De quoi parle l'information" required><?= isset($info) ? $info['content']:'' ?></textarea>
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
            url: '?/infos/<?= isset($info) ? "edit":"add" ?>-info',
            method: 'post',
            data: {title: $('.info_title').val(), description: $('.info_desc').val(), content: $('.info_content').val(), <?= isset($info) ? "infoid: '".$info['id']."'":"" ?>},
            dataType: 'json'
        })
        .done(function (response) {
            if (response.error) {
                swal("Erreur!", response.message, "error");
            }
            else {
                swal("Succès", response.message, "success");
                setTimeout(function () {
                    window.location.href = '<?= BASE_URI ?>?/account/infos';
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