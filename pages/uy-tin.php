<?php require_once('../include/head.php'); ?>
<title>Dịch vụ uy tín</title>
<?php require_once('../include/nav.php'); ?>
<div id="main" class="main">
    
    
        <div class="section-gap section-shield">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <div class="title">
                            QUỸ BẢO HIỂM MMO
                        </div>
                        <div class="line"></div>
                        <div class="tab">
                            <div class="subtitle">
                                Ấn vào "Tab dịch vụ" để lọc admin !!!
                            </div>
                            <ul class="nav nav-tabs tab-theme" role="tablist">
                                
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cate-index" role="tab" aria-controls="cate-index" aria-selected="true">
                                        Tất cả
                                    </a>
                                </li>
<?PHP foreach($ketnoi->query("SELECT * FROM `category` ORDER BY `id` desc") as $cate){ ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cate-<?=$cate['id'];?>" role="tab" aria-controls="cate-<?=$cate['id'];?>" aria-selected="false">
                                        <?=ucfirst($cate['code']);?>
                                    </a>
                                </li>
<?PHP } ?>                                                                    
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="cate-index" role="tabpanel" aria-labelledby="cate-index-tab">
<?PHP foreach($ketnoi->query("SELECT * FROM `category` ORDER BY id desc") as $lmg){ ?>
                                       <div class="shield-inner">
                                        <div class="shield-list">
                                            <div class="shield-title">
                                                <i class="fas fa-star"></i>
                                                <?=$lmg['code'];?>:
                                                <i class="fas fa-star"></i>
                                            </div>
<?php foreach($ketnoi->query("SELECT * FROM `cards` ORDER BY id desc") as $check){
    if($check['dich_vu'] == $lmg['code']) {
?>
                                                    <div class="shield-item">
                                                        <a href="/profile/<?=$check['code'];?>" class="shield-item_link">
                                                            <img src="https://graph.facebook.com/<?=$check['id_fb'];?>/picture?width=100&height=100&access_token=6628568379|c1e620fa708a1d5696fb991c1bde5662" alt="">
                                                            <?=$check['username']?>
                                                        </a>
                                                    </div>
    <?php  } } ?>                                                
                                        </div>
                                    </div>
                                    <?php } ?>
                        </div>
                        <?PHP foreach($ketnoi->query("SELECT * FROM `category` ORDER BY `id` desc") as $cate){ ?>
                        <div class="tab-pane fade" id="cate-<?=$cate['id'];?>" role="tabpanel" aria-labelledby="cate-<?=$cate['id'];?>-tab">
                            <div class="shield-inner">
                                <div class="shield-list">
                                    <div class="shield-title">
                                        <i class="fas fa-star"></i>
                                        <?=$cate['code'];?>:
                                        <i class="fas fa-star"></i>
                                    </div>
                                <?PHP $catee = $cate['code'];  foreach($ketnoi->query("SELECT * FROM `cards` WHERE `dich_vu` = '$catee' ORDER BY `id` desc") as $userr){ ?>    
                                    <div class="shield-item">
                                        <a href="/profile/<?=$userr['code'];?>" class="shield-item_link">
                                            <img src="https://graph.facebook.com/<?=$userr['id_fb'];?>/picture?width=100&height=100&access_token=6628568379|c1e620fa708a1d5696fb991c1bde5662" alt="" />
                                            <?=$userr['username']?>
                                        </a>
                                    </div>
                                <?PHP } ?>    
                                </div>
                            </div>
                        </div>
                        <?PHP } ?>                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('../include/foot.php'); ?>