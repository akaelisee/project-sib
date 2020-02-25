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
                <?php include_once ROOT . 'vues/includes/email-manage.inc.php'?>
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
    $('.email-item').on('click', function (e) {
        $.get({
            url: '?/messages/get-message/msg=' + $(this).attr('id'),
            dataType: 'json'
        })
        .done(function (response) {
            if (response.message) {
                $('#messagesender').html(response.person);
                $('#messagedate').html(response.date || 'Inconnu');
                $('#messagecontent').html(response.message);
                $('#messageshowdiv').show();
                $('.delmessage').attr({'data-id': response.id});
            }
            else {
                swal("Erreur", "Aucun contenu trouvé pour ce \"message\"", "error");
            }
        })
        .fail(function () {
            swal("Erreur", "Une erreur est survenue !", "error");
        });
    });

    $('.delmessage').on('click', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var $el = $(this);

        if (id.length === 0) {
            swal("Erreur", "Vous devez en premier ouvrir le message à effacer", "error");
        }
        else {
            swal({
                    title: "Êtes vous sure?",
                    text: "Vous allez supprimer ce messaege pour de bon.",
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
                            url: '?/messages/delete-message/msg=' + id,
                            dataType: 'json'
                        })
                        .done(function (response) { console.log("gone");
                            if (response.error) {
                                swal("Erreur", message.response, "error");
                            }
                            else {
                                swal('Succès', "Le message a bien été supprimé !", 'success');
                                $('.email-item#' + id).remove();
                                $('#messageshowdiv').fadeOut();
                                $el.attr('data-id', '');
                            }
                        })
                        .fail(function () {
                            swal("Erreur", "Une erreur est survenue", "error");
                        });
                    }
                });
        }
    });
</script>

</body>

</html>