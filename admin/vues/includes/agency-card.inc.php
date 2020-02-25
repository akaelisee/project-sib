<?php foreach ($agences as $k => $agence): ?>
    <div class="col-lg-3">
        <div href="#" class="card">
            <div class="card-header">
                <ul class="list-unstyled list-info">
                    <li>
                        <div class="pdd-vertical-10 pdd-horizon-20">
                            <img class="thumb-img img-circle" src="<?= WROOT . 'THEME/' ?>assets/images/logo/logosib.png" alt="">
                            <div class="info">
                                <span class="title"><?= $agence['nom'] ?></span>
                                <span class="sub-title">
                                    <i class="ti-location-pin pdd-right-5"></i>
                                    <span><?= $agence['commune'] ?></span>
                                </span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-media">
                <img class="img-responsive" src="http://news.abidjan.net/photos/photos/INAUGURATION-AGENCE-SIB-MARCORY-SQUARE-CENTER-0000.jpg" alt="">
            </div>
            <!--
            <div class="card-block">
                <h4>Card With Image</h4>
                <p><?= substr($agence['description'], 0, 50) ?></p>
            </div>
            -->
            <div class="card-footer border top">
                <ul class="list-unstyled list-inline pull-right">
                    <li class="list-inline-item">
                        <a href="?/account/agency-edit/agency=<?= $k ?>" class="btn btn-icon btn-flat btn-rounded">
                            <i class="ti-pencil"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="btn btn-icon btn-flat btn-rounded agencydelter" data-id="<?= $agence['code'] ?>">
                            <i class="ti-trash"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php endforeach; ?>