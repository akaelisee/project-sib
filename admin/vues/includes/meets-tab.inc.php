<div class="col-md-12">
    <div class="card">
        <div class="card-block">
            <h4 class="card-title">Les rendez-vous</h4>
            <div class="tab-info">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="tabs.html#default-tab-1" onclick="toogleTabs(this)" class="nav-link active" role="tab" data-toggle="tab">Mes rendez-vous</a>
                    </li>
                    <li class="nav-item">
                        <a href="tabs.html#default-tab-2" onclick="toogleTabs(this)" class="nav-link" role="tab" data-toggle="tab">Autres rendez-vous</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="default-tab-1">
                        <div class="pdd-horizon-15 pdd-vertical-20">
                            <ul class="list-info ps-container ps-theme-default ps-active-y" style="" data-ps-id="f6a0e9bd-cc9f-d9d2-a636-89f7f2e05529">
                                <?php foreach ($clientsmeets as $k => $meet): ?>
                                    <li class="border bottom mrg-btm-10">
                                        <div class="pdd-vertical-10">
                                            <span class="thumb-img bg-primary">
                                                <img src="<?= Files::image('images.png') ?>" alt="" style="float: left; width: 40px; border-radius:100%;">
                                            </span>
                                            <div class="info">
                                                <a href="#" class="text-link"><span class="title"><b class="font-size-15"><?= $meet['account'] ?></b></span></a>
                                                <span class="sub-title"><?= $meet['date'] ?></span>
                                            </div>
                                            <div class="mrg-top-10">
                                                <p class="no-mrg-btm" style="margin-left: 55px;"><?= $meet['problem'] ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="default-tab-2">
                        <div class="pdd-horizon-15 pdd-vertical-20">
                            <ul class="list-info ps-container ps-theme-default ps-active-y" style="" data-ps-id="f6a0e9bd-cc9f-d9d2-a636-89f7f2e05529">
                                <?php foreach ($othersmeets as $k => $meet): ?>
                                    <li class="border bottom mrg-btm-10">
                                        <div class="pdd-vertical-10">
                                                <span class="thumb-img bg-primary">
                                                    <img src="<?= Files::image('images.png') ?>" alt="" style="float: left; width: 40px; border-radius:100%;">
                                                </span>
                                            <div class="info">
                                                <a href="#" class="text-link"><span class="title"><b class="font-size-15"><?= $meet['person'] ?></b></span></a>
                                                <span class="sub-title"><?= $meet['date'] ?></span>
                                            </div>
                                            <div class="mrg-top-10">
                                                <p class="no-mrg-btm" style="margin-left: 55px;"><?= $meet['problem'] ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>