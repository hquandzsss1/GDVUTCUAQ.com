<?php require_once('../include/head.php'); ?>
<?php require_once('../include/nav.php'); 
if (isset($_GET['code'])) {
    $id = $_GET['code'];
}
$result = mysqli_query($ketnoi,"SELECT * FROM `cards` WHERE `code` = '".$id."' ORDER BY id desc limit 0, 1");
while($row = mysqli_fetch_assoc($result))
{
?>
<title><?=$row['username'];?> | Bảo Hiểm Hồ Sơ Uy Tín</title>
<div id="main" class="main">
    
    
        <div class="section-gap section-profile">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="profile-inner">
                        <div class="profile-avatar">
                            <img src="https://graph.facebook.com/<?=$row['id_fb'];?>/picture?width=100&height=100&access_token=6628568379|c1e620fa708a1d5696fb991c1bde5662" alt="">
                        </div>
                        <div class="profile-title">
                            <?=$row['username'];?>
                        </div>
                        <div class="profile-buttons">
                            <div class="btn-checkmess">
                                <a href="https://m.me/<?=$row['id_fb'];?>/" class="btn-theme btn-theme_primary" target="_blank">
                                    <i class="fab fa-facebook-messenger"></i>
                                    Check Mess
                                    <span></span>
                                </a>
                                <a href="http://m.me/<?=$row['id_fb'];?>/" class="description-hidden">
                                    <span>Ấn vào "Check Mess" nhắn tin cho GDV để chắc chắn rằng bạn đang giao dịch với Real</span>
                                    <button>
                                        Ok
                                    </button>
                                </a>
                                <div class="description-overlay"></div>
                            </div>
                            <a href="tel:<?=$row['sdt'];?>" class="btn-theme btn-theme_primary">
                                <i class="fas fa-phone-alt"></i>
                                Check Phone
                                <span></span>
                            </a>
                        </div>
                        <div class="profile-boxs">
                            <div class="row row-col-15">
                                <div class="col-md-6">
                                    <div class="profile-box">
                                        <div class="profile-box_content">
                                            <div class="profile-box_content__title">
                                                Thông tin liên hệ
                                            </div>
                                            <div class="profile-box_content__list">
                                                <p>
                                                    <span>
                                                        <i class="fab fa-facebook-f"></i>
                                                    </span>
                                                    Check Facebook:
                                                    <a href="https://fb.com/<?=$row['id_fb'];?>" target="_blank">
                                                        <?=$row['id_fb'];?>
                                                    </a>
                                                </p>
                                                <p>
                                                    <span>
                                                        <img src="/assets/default/images/zalo.webp" alt="">
                                                    </span>
                                                    Check Zalo:
                                                    <a href="https://zalo.me/<?=$row['sdt'];?>/" target="_blank">
                                                        <?=$row['sdt'];?>
                                                    </a>
                                                </p>
                                                <p>
                                                    <span>
                                                        <i class="far fa-globe"></i>
                                                    </span>
                                                    Website:
                                                    <a href="//<?=$row['website'];?>/">
                                                        <?=$row['website'];?>
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="profile-box_content__image">
                                                <img src="/assets/default/images/info.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-box">
                                        <div class="profile-box_content">
                                            <div class="profile-box_content__title">
                                                Quỹ Bảo Hiểm <?=$site_tenweb;?>
                                            </div>
                                            <div class="profile-box_content__desc">
                                                <p>Khách hàng sẽ được <b><?=$site_tenweb;?> bảo hiểm an toàn giao dịch</b> với số
                                                    tiền trong quỹ bảo hiểm <strong><?=format_cash($row['money']);?> VND</strong> của <strong><?=$row['username'];?></strong></p>
                                            </div>
                                            <div class="profile-box_content__image">
                                                <img src="/assets/default/images/shield.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-boxs">
                            <div class="profile-box profile-box_nopr">
                                <div class="profile-box_content">
                                    <div class="profile-box_content__title">
                                        Vui lòng kiểm tra kỹ thông tin trước khi giao dịch tránh
                                        Fake:
                                    </div>
                                    <div class="profile-box_content__subtitle">
                                        TK ngân hàng
                                    </div>
                                    <ul>
                                    <li class="oo9gr5id" dir="auto">
                                        <strong>Ngân Hàng:</strong>
                                        <ul class="atm_list">
                                        <?php
                                        $atm = $row['ngan_hang'];
                                        $delimiters = array("|");
                                        $atm = str_replace($delimiters, $delimiters[0], $atm);
                                        $arrKeyword= explode($delimiters[0], $atm);
                                        foreach ($arrKeyword as $key)
                                        {
                                           echo '<li>'.$key.'</li>';
                                        }
                                        ?>
                                        </ul>
                                    </li>
                                    <li class="oo9gr5id" dir="auto"><strong>Momo:</strong><?=$row['vi_momo'];?></li>
                                    <li dir="auto"><strong>Facebook:</strong> <a href="https://fb.com/<?=$row['id_fb'];?>" target="_blank" rel="noopener"><?=$row['id_fb'];?></a></li>
                                    </ul>
                                    <div class="profile-box_content__subtitle">
                                        Mô tả
                                    </div>
                                    <div class="mb-3">
                                        <?=$row['mo_ta'];?>
                                    </div>
                                    <div class="profile-box_content__desc">
                                        <p><strong>Lưu Ý:</strong> Tránh trường hợp Nick Fake, Ảnh Fake, Link Fake, Rửa
                                            Tiền…. Người dùng hãy nhớ Chát đúng Facebook, Gọi đúng SĐT, Chuyển khoản
                                            đúng những STK có ở trong trong link bảo hiểm này <?=$site_tenweb;?> cam kết bạn sẽ
                                            an toàn trong mọi giao dịch..!!!</p>
                                    </div>
                                    <div class="profile-box_content_watermark">
                                        <img src="<?=$site_logo;?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-desc">
                            Mọi giao dịch của bạn với <b>"<?=$row['username'];?>"</b> sẽ được <b><?=$site_tenweb;?>
                                Bảo vệ</b> với số tiền nằm trong <strong>Quỹ bảo hiểm <?=format_cash($row['money']);?> VND</strong> khi bạn
                            tuân theo
                            <a href="">Điều Khoản Sử Dụng</a>
                            của <?=$site_tenweb;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('../include/foot.php'); ?>
<?php } ?>