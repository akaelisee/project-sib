<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li>
                <a class="side-nav-toggle" href="javascript:void(0);">
                    <i class="ti-view-grid"></i>
                </a>
            </li>
            <li class="search-box">
                <a class="search-toggle no-pdd-right" href="javascript:void(0);">
                    <i class="search-icon ti-search pdd-right-10"></i>
                    <i class="search-icon-close ti-close pdd-right-10"></i>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
            <li class="user-profile dropdown">
                <a href="form-layouts.html" class="dropdown-toggle" data-toggle="dropdown">
                    <img class="img-fluid" style="width:27px;" src="<?= Files::image('images.png') ?>" alt="">
                    <div class="user-info">
                        <span class="name pdd-right-5"><?= $user->nom ?></span>
                        <i class="ti-angle-down font-size-10"></i>
                    </div>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="?/account/settings">
                            <i class="ti-settings pdd-right-10"></i>
                            <span>Paramètres</span>
                        </a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="?/account/logout">
                            <i class="ti-power-off pdd-right-10"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="notifications dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="ti-bell"></i>
                </a>

                <ul class="dropdown-menu ">
                    <li class="notice-header">
                        <i class="ti-bell pdd-right-10"></i>
                        <span>Notifications</span>
                    </li>
                    <li>
                        <ul class="list-info overflow-y-auto relative scrollable">
                            <li>
                                <a href="form-layouts.html">
                                    <span class="thumb-img bg-info">
                                        <span class="text-white"><i class="ti-user"></i></span>
                                    </span>
                                    <div class="info">
                                        <span class="title">
                                            <span class="font-size-14 text-semibold">Admin</span>
                                            <span class="text-gray">Welcome on board</span>
                                        </span>
                                        <span class="sub-title">8 hours ago</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="notice-footer">
                        <span>
                            <a href="form-layouts.html" class="text-gray">Toutes les notifications <i class="ei-right-chevron pdd-left-5 font-size-10"></i></a>
                        </span>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>