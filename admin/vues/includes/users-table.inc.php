<div class="col-md-12">
    <div class="card">
        <div class="card-block">
            <div class="table-overflow">
                <table id="dt-opt" class="table table-lg table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th>Prénoms</th>
                        <th>Email</th>
                        <th>Nom d'utilisateur</th>
                        <th class="text-right">Agence</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $k => $user): ?>
                            <tr>
                                <td>
                                    <div class="checkbox mrg-left-20">
                                        <input id="task12" name="task12" type="checkbox">
                                        <label for="task12"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="list-info mrg-top-10">
                                        <img class="thumb-img" src="<?= WROOT . 'THEME/' ?>assets/images/logo/logosib.png" alt="">
                                        <div class="info">
                                            <span class="title"><?= $user['nom'] ?></span>
                                            <span class="sub-title"><?= $user['role'] ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="relative mrg-top-15">
                                        <span class="status away"></span>
                                        <span class="pdd-left-20"><?= $user['prenoms'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="mrg-top-15">
                                        <span class="text-info"><b><?= $user['email'] ?></b></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="mrg-top-15">
                                        <span><?= $user['username'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="mrg-top-15 text-right">
                                        <b class="text-dark font-size-16"><?= $user['agence'] ?></b>
                                    </div>
                                </td>
                                <td>
                                    <div class="mrg-top-10 text-center">
                                        <button class="btn btn-icon btn-flat btn-rounded dropdown-toggle deluser" data-id="<?= $k ?>">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>