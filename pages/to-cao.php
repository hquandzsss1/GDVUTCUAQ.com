<?php require_once('../include/head.php'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Tố cáo lừa đảo</title>
<?php require_once('../include/nav.php'); ?>
<?php
$time = date("h:i:s");
$site = $_SERVER['SERVER_NAME'];
if (isset($_POST["submit"])) {
    $name = [];
    $tmp_name = [];
    $error = [];
    $ext = [];
    $size = [];

    foreach ($_FILES['file']['name'] as $file) {
        $name[] = $file;
    }
    foreach ($_FILES['file']['tmp_name'] as $file) {
        $tmp_name[] = $file;
    }

    for ($i = 0; $i < count($name); $i++) {
        $number_random = random('1234567890', 4);
        $hoten = htmlspecialchars($_POST['hoten']);
        $sdt = htmlspecialchars($_POST['sdt']);
        $nganhang = htmlspecialchars($_POST['nganhang']);
        $stk = htmlspecialchars($_POST['stk']);
        $lydo = htmlspecialchars($_POST['lydo']);
        $nguoi_phot = htmlspecialchars($_POST['hotennp']);
        $sdt_nguoip = $_POST['sdtnp'];

        if (!$hoten || !$sdt || !$nganhang || !$stk || !$lydo || !$nguoi_phot || !$sdt_nguoip) {
            die('<script>swal.fire("Thông Báo", "Vui lòng nhập đầy đủ!", "error");setTimeout(function(){ location.href = "/service/denounce" },2000);</script>');
        }

        $ngay = date('d-m-Y');
        $random = random('1234567890', 1);
        $code = xoadau($hoten);

        $temp = preg_split('/[\/\\\\]+/', $name[$i]);
        $filename = $temp[count($temp) - 1];
        $upload_dir = "../storage/";
        $upload_file = $upload_dir . "BC_" . $number_random . ".png";
        if (file_exists($upload_file)) {
            die('<script>swal.fire("Thông Báo", "Ảnh đã tồn tại! Vui lòng thử lại", "error");setTimeout(function(){ location.href = "/service/denounce" },2000);</script>');
        }
        if (move_uploaded_file($tmp_name[$i], $upload_file)) {
            $duong_lik = "/storage/BC_" . $number_random . ".png";
            $getanh = explode(PHP_EOL, $duong_lik);
            $countupdate = 0;

            foreach ($getanh as $row) {
            $ketnoi->query("INSERT INTO `bangchung` SET 
            `code` = '$code',
            `image` = '$row' ");
                $countupdate++;
            }
        }
    }
    $create = $ketnoi->query("INSERT INTO `ticket` SET 
    `username` = '".$hoten."',
    `ly_do` = '".$lydo."',
    `status` = 'xuly',
    `sdt` = '".$sdt."',
    `ngan_hang` = '".$nganhang."',
    `stk` = '".$stk."',
    `code` = '$code',
    `hoten_np` = '".$nguoi_phot."',
    `sdt_np` = '".$sdt_nguoip."',
    `view` = '0',
    `ngay` = '".$ngay."' ");
    sendTele(templateTele('Scamer Bị tố cáo: ' . $hoten . ' Bởi ' . $nguoi_phot));

    die('<script>swal.fire("Thông Báo", "Đã Gửi Thông Tin Thành Công! Chờ Duyệt", "success");setTimeout(function(){ location.href = "/service/denounce" },2000);</script>');
}
?>
<div id="main" class="main">
        <div class="section-gap section-report">
        <form method="post" class="form-theme" enctype="multipart/form-data">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="section-heading">
                            <div class="title">
                                THÔNG TIN KẺ LỪA ĐẢO
                            </div>
                            <div class="line"></div>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-8">
                        <div class="row row-col-10">
                            <div class="col-md-6 col-12">
                                <div class="form-theme_item">
                                    <input type="text" value="" class="form-theme_item__input"
                                           name="hoten" required>
                                    <label class="form-theme_item__label" for="">
                                        Họ và tên
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-theme_item">
                                    <input type="text" value="" class="form-theme_item__input"
                                           name="sdt" required>
                                    <label class="form-theme_item__label" for="">
                                        Số điện thoại
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-theme_item">
                                    <input type="text" class="form-theme_item__input" name="stk" required>
                                    <label class="form-theme_item__label" for="">
                                        Số tài khoản <span class="font-weight-bold text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-theme_item">
                                    <input type="text" class="form-theme_item__input" name="nganhang" required>
                                    <label class="form-theme_item__label" for="">
                                        Ngân hàng <span class="font-weight-bold text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-theme_item">
                                    <div class="form-theme_item__upload">
                                        <div class="form-theme_item__upload-images">
                                            <div id="dropzone_files" class="dropzone">
                                                <input type="file" name="file[]" id="uploadfile" multiple style="display: none;" />
                                            </div>
                                            <ul id="file-upload-list" class="list-unstyled"></ul>
                                        </div>
                                        <div class="form-theme_item__upload-desc" id="dropfile">
                                            Upload Bill chuyển tiền &amp; ảnh đoạn chát lừa đảo.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 py-0">
                                <div class="form-theme_item">
                                    <div class="form-theme_item__desc px-1 text-muted">
                                        LƯU Ý: Chờ khoảng 15s để Upload ảnh lên sever, bài tố cáo sẽ bị gỡ nếu không
                                        đủ
                                        bằng chứng thuyết phục,
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-theme_item">
                                     <textarea class="form-theme_item__input"
                                               name="lydo" rows="4"></textarea>
                                    <label class="form-theme_item__label" for="" required>
                                        Nội dung tố cáo <span class="font-weight-bold text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-line"></div>
                    <div class="col-12">
                        <div class="section-heading">
                            <div class="title">
                                THÔNG TIN NGƯỜI PHỐT
                            </div>
                            <div class="line"></div>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-8">
                        <div class="row row-col-10">
                            <div class="col-md-6 col-12 py-md-0">
                                <div class="form-theme_item">
                                    <input type="text" class="form-theme_item__input"
                                           name="hotennp" required>
                                    <label class="form-theme_item__label" for="">
                                        Họ & tên <span class="font-weight-bold text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 py-md-0">
                                <div class="form-theme_item">
                                    <input type="text" class="form-theme_item__input" name="sdtnp" required>
                                    <label class="form-theme_item__label" for="">
                                        Liên hệ zalo
                                    </label>
                                    <div class="form-theme_item__desc p-1 pb-0 text-muted">
                                        Đơn tố cáo sẽ bị gỡ nếu zalo ảo.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="form-theme_item text-center">
                                    <button type="submit" name="submit" class="btn-theme btn-theme_primary">
                                        GỬI DUYỆT
                                        <span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require_once('../include/foot.php'); ?>