<?php
require_once('../include/head.php');
if (isset($_GET['code'])) {
    $code = $_GET['code'];
}
$result = $ketnoi->query("SELECT * FROM `ticket` WHERE `code` = '$code' AND `status` = 'scam' ");
while($row = mysqli_fetch_assoc($result)){
mysqli_query($ketnoi, "UPDATE `ticket` SET view = view + 1 WHERE `code` = '$code' ");
?>
<title>Scamer</title>
<?php require_once('../include/nav.php'); ?>
<div id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Lừa đảo</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Scamer - <?=$row['username'];?></a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="section-gap section-scammer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="scammer-box">
                        <div class="scammer-box_title">
                            <i class="fas fa-exclamation"></i>
                            Cảnh báo lừa đảo
                        </div>
                        <div class="scammer-box_wrap">
                            <div class="scammer-item">
                                <div class="scammer-item_icon">
                                    <i class="fas fa-user-alt"></i>
                                    Họ và tên:
                                </div>
                                <div class="scammer-item_content">
                                    <?=$row['username'];?>
                                </div>
                            </div>
                            <div class="scammer-item">
                                <div class="scammer-item_icon">
                                    <i class="fas fa-phone-alt"></i>
                                    Số điện thoại:
                                </div>
                                <div class="scammer-item_content">
                                    <?=$row['sdt'];?>
                                    <a href="javascript:void(0)" class="copy-text" data-text="<?=$row['sdt'];?>">
                                        <i class="fas fa-copy"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="scammer-item">
                                <div class="scammer-item_icon">
                                    <i class="fas fa-credit-card"></i>
                                    Số tài khoản
                                </div>
                                <div class="scammer-item_content">
                                    <?=$row['stk'];?>
                                    <a href="javascript:void(0)" class="copy-text" data-text="<?=$row['stk'];?>">
                                        <i class="fas fa-copy"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="scammer-item">
                                <div class="scammer-item_icon">
                                    <i class="fas fa-university"></i>
                                    Ngân hàng
                                </div>
                                <div class="scammer-item_content">
                                    <?=$row['ngan_hang'];?>
                                </div>
                            </div>
                            <div class="scammer-item flex-wrap flex-md-nowrap">
                                <div class="scammer-item_icon">
                                    <i class="fas fa-images"></i>
                                    Ảnh chụp bằng chứng
                                </div>
                                <div class="scammer-item_content">
                                    <div class="scammer-item_content__image">
    <?php $img = mysqli_query($ketnoi,"SELECT * FROM `bangchung` WHERE `code` = '$code' ORDER BY id desc");while($bc = mysqli_fetch_assoc($img)) { ?>
                                        <div class="scammer-item_content__image-item">
                                            <a href="<?=$bc['image'];?>" data-fancybox="image-scammer">
                                                <img src="<?=$bc['image'];?>" alt="" />
                                            </a>
                                        </div>
    <?php } ?>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="scammer-item flex-wrap flex-md-nowrap">
                                <div class="scammer-item_icon">
                                    <i class="fas fa-pen-square"></i>
                                    Mô tả hình thức
                                </div>
                                <div class="scammer-item_content">
                                    Scam
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scammer-box">
                        <div class="scammer-box_title">
                            <i class="fas fa-user-alt"></i>
                            Người tố cáo
                        </div>
                        <div class="scammer-box_wrap">
                            <div class="scammer-item">
                                <div class="scammer-item_icon">
                                    <i class="fas fa-user-alt"></i>
                                    Họ và tên:
                                </div>
                                <div class="scammer-item_content">
                                    <?=$row['hoten_np'];?>
                                </div>
                            </div>
                            <div class="scammer-item">
                                <div class="scammer-item_icon">
                                    <i class="fas fa-phone-alt"></i>
                                    Liên hệ:
                                </div>
                                <div class="scammer-item_content">
                                    <?=substr($row['sdt_np'], 0, 5).'*****';?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('../include/foot.php'); } ?>
