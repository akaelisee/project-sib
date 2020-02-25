<?php
    if ($oneinfo):
?>
        <div class="col-md-12 col-md-offset-0">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title"><?= $oneinfo['title'] ?></h4>
                    <div class="mrg-top-20">
                        <p><?= $oneinfo['content'] ?></p>
                    </div>
                </div>
                <div class="card-footer border top">
                    <ul class="list-unstyled list-inline pull-right">
                        <li class="list-inline-item">
                            <a href="?/account/info-edit/info=<?= $oneinfo['id'] ?>" class="btn btn-icon btn-flat btn-rounded">
                                <i class="ti-pencil"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn btn-icon btn-flat btn-rounded infodelter" data-id="<?= $oneinfo['id'] ?>">
                                <i class="ti-trash"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<?php
    endif;
    foreach ($infos as $k => $info):
?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title"><?= $info['title'] ?></h4>
                    <div class="mrg-top-20">
                        <p><?= $info['description'] ?></p>
                    </div>
                </div>
                <div class="card-footer border top">
                    <ul class="list-unstyled list-inline pull-right">
                        <li class="list-inline-item">
                            <a href="?/account/infos/info=<?= $info['id'] ?>" class="btn btn-icon btn-flat btn-rounded">
                                <i class="ti-eye"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="?/account/info-edit/info=<?= $info['id'] ?>" class="btn btn-icon btn-flat btn-rounded">
                                <i class="ti-pencil"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn btn-icon btn-flat btn-rounded infodelter" data-id="<?= $info['id'] ?>">
                                <i class="ti-trash"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<?php
    endforeach;
?>