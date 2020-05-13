<!-- Main Content -->
<section class="content-wrap full youplay-login">

<!-- Banner -->
<div class="youplay-banner banner-top">
    <div class="image" style="background-image: url('assets/images/banner-bg.jpg')"></div>

    <div class="info">
        <div class="container">
            <div class="youplay-form">
                <h3 class="align-center" style="color: yellow;">K-NIGHTZ Season2</h3>
                <h4 class="align-center">( เปลี่ยนรหัสผ่าน )</h4>
                <form action="./storage/system/process.php" method="POST">
                    <div class='form-group'>
                        <label for='oldpass'><i class="fas fa-key"></i> Old Password :</label>
                        <input class="form-control" type="password" name="oldpass" placeholder="กรอกรหัสผ่านเก่า">
                    </div>
                    <div class='form-group'>
                        <label for='accountname'><i class="fas fa-key"></i> New Password :</label>
                        <input class="form-control" type="password" name="newpass" placeholder="กรอกรหัสผ่านใหม่">
                    </div>
                    <div class='form-group'>
                        <label for='password'><i class="fas fa-key"></i> Confirm Password :</label>
                        <input class="form-control" type="password" name="newpass_cf" placeholder="ยืนยันรหัสผ่านใหม่">
                    </div>
                    <button type="button" class="btn btn-default btn-md" onclick="sweet('success', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')"><i class="fas fa-sign-in-alt"></i> เปลี่ยนรหัสผ่าน</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Banner -->

</section>
<!-- /Main Content -->