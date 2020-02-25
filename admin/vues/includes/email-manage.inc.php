<div class="full-container">
    <div class="email-app">
        <div class="email-wrapper row">
            <div class="email-list">
                <div class="email-list-tools">
                    <ul class="tools pull-left">
                        <li class="d-lg-none">
                            <a class="side-nav-2-toggle" href="javascript:void(0)">
                                <i class="ti-menu"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="font-size-14">Liste des messages</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="tools text-right">
                        <li>
                            <a href="#">
                                <i class="ti-star"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ti-timer"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="delmessage" data-id="">
                                <i class="ti-trash"></i>
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="email-list-wrapper">
                    <div class="list-view-group-container">
                        <ul class="email-list-item">
                            <?php foreach ($messages as $k => $message): ?>
                                <li class="email-item" id="<?= $k ?>">
                                    <div class="email-tick">
                                        <div class="checkbox">
                                            <input type="checkbox" class="messagelist">
                                            <label for="email-12"></label>
                                        </div>
                                    </div>
                                    <div class="open-mail">
                                        <div class="email-detail">
                                            <p class="from"><?= $message['person'] ?></p>
                                            <p class="subject">
                                                Message à SIB Côte d'ivoire
                                            </p>
                                            <p class="">
                                                <?= substr($message['message'], 0, 25) . '...' ?>
                                            </p>
                                            <span class="datetime"></span>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="email-content">
                <!--
                <div class="email-content-tools">
                    <ul>
                        <li>
                            <a class="back-to-mailbox" href="javascript:void(0)">
                                <i class="ti-arrow-circle-left"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="pull-right">
                        <li>
                            <a href="email.html">
                                <i class="fa fa-reply"></i>
                            </a>
                        </li>
                        <li>
                            <a href="email.html">
                                <i class="ti-star"></i>
                            </a>
                        </li>
                        <li>
                            <a href="email.html">
                                <i class="ti-flag"></i>
                            </a>
                        </li>
                        <li>
                            <a href="email.html">
                                <i class="ti-more-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                -->
                <div class="email-content-wrapper">
                    <div class="email-content-detail" id="messageshowdiv" style="display: none;">
                        <div class="detail-head">
                            <ul class="list-unstyled list-info">
                                <li>
                                    <div class="pdd-vertical-10 pdd-horizon-20">
                                        <img class="thumb-img img-circle" alt="" src="<?= Files::image('images.png') ?>">
                                        <div class="info">
                                            <span class="title font-size-16" id="messagesender">Nom d'utilisateur</span>
                                            <span class="sub-title">
                                                <span>To: SIB Côte d'Ivoire</span>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="tools">
                                <li class="font-size-13" id="messagedate">Fri 8:40 AM</li>
                                <li class="d-none d-md-inline-block">
                                    <a href="#">
                                        <i class="fa fa-reply"></i>
                                    </a>
                                </li>
                                <li class="d-none d-md-inline-block">
                                    <a href="#">
                                        <i class="ti-more-alt"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="detail-body">
                            <h4 class="">Objet du message</h4>
                            <div class="mrg-top-15">
                                <p id="messagecontent">
                                    Run! Yes. A Jedi's strength flows from the Force. But beware of the dark side. Anger...fear...aggression. The dark side of the Force are they. Easily they flow, quick to join you in a fight. If once you start down the dark path, forever will it dominate your destiny, consume you it will, as it did Obi-Wan's apprentice. Vader. Is the dark side stronger? No...no...no. Quicker, easier, more seductive. But how am I to know the good side from the bad? You will know. When you are calm, at peace. Passive. A Jedi uses the Force for knowledge and defense, never for attack. But tell me why I can't... No, no, there is no why. Nothing more will I teach you today. Clear your mind of questions. Mmm. Mmmmmm.
                                </p>
                            </div>
                        </div>
                        <div class="detail-foot">
                            <ul class="attachments">
                                <!--
                                <li>
                                    <a href="javascript:;">
                                        <div class="file-icon">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </div>
                                        <div class="file-info">
                                            <span class="file-name ">Battle_Report.pdf</span>
                                            <span class="file-size "> 18Mb</span>
                                        </div>
                                    </a>
                                </li>
                                -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>