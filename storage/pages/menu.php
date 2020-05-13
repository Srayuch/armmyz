<header>
  <!-- Navbar -->
  <nav class="navbar-youplay navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="./">
          <img src="assets/images/logo/logo-nav.png" alt="">
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">

        <?php
          if(isset($_SESSION['username'])) {
        ?>

          <!----------------------------- [ LOGIN SUCCESS : START CODE ] ----------------------------->
          <ul class="nav navbar-nav">
            <li>
              <a href="./"><i class="fa fa-home"></i> <?php echo $lang['page']['home']; ?>
                <span class="label">Home</span>
              </a>
            </li>
            <li>
              <a href="?cmd=topup"><i class="fa fa-credit-card"></i> <?php echo $lang['page']['topup']; ?>
                <span class="label">Topup</span>
              </a>
            </li>
            <li>
              <a href="?cmd=itemshop"><i class="fa fa-shopping-cart"></i> <?php echo $lang['page']['itemshop']; ?>
                <span class="label">Item Shop</span>
              </a>
            </li>
            <li class="dropdown dropdown-hover dropdown-user">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                <i class="fa fa-gift"></i> <?php echo $lang['page']['redeem']; ?>
                <span class="caret"></span>
                <span class="label">Redeem Items</span>
              </a>
              <div class="dropdown-menu">
                <ul>
                  <li>
                    <a href="?cmd=itemcode"><i class="fas fa-cubes"></i> <?php echo $lang['page']['itemcode']; ?></a>
                  </li>
                  <li>
                    <a href="?cmd=reward"><i class="fa fa-gift"></i> <?php echo $lang['page']['reward']; ?></a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="dropdown dropdown-hover dropdown-user">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
              <i class="fa fa-users"></i> <?php echo $lang['page']['managechar']; ?>
                <span class="caret"></span>
                <span class="label">Manage Characters</span>
              </a>
              <div class="dropdown-menu">
                <ul>
                  <li>
                    <a href="?cmd=charname"><i class="fas fa-user-edit"></i> <?php echo $lang['page']['charname']; ?></a>
                  </li>
                  <li>
                    <a href="?cmd=charcolor"><i class="fas fa-palette"></i> <?php echo $lang['page']['charcolor']; ?></a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-hover dropdown-user">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                <i class="fa fa-cogs" aria-hidden="true"></i> จัดการบัญชี
                <span class="caret"></span>
                <span class="label">Account Manager</span>
              </a>
              <div class="dropdown-menu">
                <ul>
                  <li>
                    <a href="?cmd=profile"><i class="fa fa-address-card"></i> ข้อมูลส่วนตัว</a>
                  </li>
                  <li>
                    <a href="?cmd=changepass"><i class="fas fa-key"></i> เปลี่ยนรหัสผ่าน</a>
                  </li>
                  <li>
                    <a href="?cmd=logout"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
          <!----------------------------- [ LOGIN SUCCESS : END CODE ] ----------------------------->

        <?php
          } else {
        ?>

          <!----------------------------- [ NOT LOGIN : START CODE ] ----------------------------->
          <ul class="nav navbar-nav">
            <li>
              <a href="./"><i class="fa fa-home"></i> หน้าหลัก
                <span class="label">Home</span>
              </a>
            </li>
            <li>
              <a href="?cmd=download"><i class="fa fa-download"></i> ดาวน์โหลด
                <span class="label">Download Game</span>
              </a>
            </li>
            <li>
              <a href="?cmd=ranking"><i class="fas fa-chart-bar"></i> อันดับผู้เล่น
                <span class="label">Ranking</span>
              </a>
            </li>
            <li class="dropdown dropdown-hover dropdown-user">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                <i class="fa fa-gift"></i> กิจกรรม
                <span class="caret"></span>
                <span class="label">Event</span>
              </a>
              <div class="dropdown-menu">
                <ul>
                  <li>
                    <a href="#Download"><i class="fab fa-youtube"></i> รับไอเทมตามนักสตรีม</a>
                  </li>
                  <li>
                    <a href="#Download"> แชร์เฟซแลก GC</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#Download"><i class="far fa-edit"></i> ลงทะเบียน
                <span class="label">Register</span>
              </a>
            </li>
            <li>
              <a href="?cmd=login"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ
                <span class="label">Login</span>
              </a>
            </li>
          </ul>
          <!----------------------------- [ NOT LOGIN : END CODE ] ----------------------------->

        <?php
          }
        ?>

      </div>
    </div>
  </nav>
  <!-- /Navbar -->
</header>
