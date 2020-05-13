<!-- Main Content -->
  <section class="content-wrap full youplay-login">

    <!-- Banner -->
    <div class="youplay-banner banner-top">
        <div class="image" style="background-image: url('assets/images/banner-bg.jpg')"></div>

        <div class="info">
            <div class="container">
                <div class="youplay-form">
                    <h3 class="align-center" style="color: yellow;">K-NIGHTZ Season2</h3>
                    <h4 class="align-center">( เข้าสู่ระบบ )</h4>
                    <form action="./storage/system/process.php" method="POST">
                        <div class='form-group'>
                            <label for='accountname'><i class="far fa-envelope"></i> Email :</label>
                            <input class="form-control" type="text" name="accountname" placeholder="กรอกอีเมล์">
                        </div>
                        <div class='form-group'>
                            <label for='password'><i class="fas fa-key"></i> Password :</label>
                            <input class="form-control" type="password" name="password" placeholder="กรอกรหัสผ่าน">
                        </div>
                        <input type="hidden" name="cmd" value="login">
                        <button type="submit" class="btn btn-default btn-md"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</button>
                        <br><br>
                        <p><a href="#">ลืมรหัสผ่าน?</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner -->

  </section>
  <!-- /Main Content -->