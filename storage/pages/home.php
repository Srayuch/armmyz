<!-- Main Content -->
<section class="content-wrap">

  <?php
    if(isset($_SESSION['username'])) {
  ?>
  <!----------------------------- [ LOGIN SUCCESS : START CODE ] ----------------------------->
    <!-- Banner -->
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('assets/images/header_bg.jpg')"></div>
      <div class="info">
        <div class="container youplay-user">
          <div class="img angled-img">
              <img src="assets/images/user-avatar.jpg" alt="">
          </div>
          <div class="user-data">
            <h3><?php echo $_SESSION['username']; ?></h3>
            <div class="location"><i class="fas fa-map-marker-alt"></i> ทุ่งสง, นครศรีธรรมราช</div>
            <div class="activity">
              <div>
                <div class="num counter" style="color: yellow;" data-count="<?php echo '185050';?>"></div>
                <div class="title">[ GC ] GamePoints</div>
              </div>
              <div>
                <div class="num counter" style="color: skyblue;" data-count="<?php echo '1500014';?>"></div>
                <div class="title">[ DL ] GameDollars</div>
              </div>
              <div>
                <div class="num counter" style="color: lightgreen;" data-count="<?php echo '2500';?>"></div>
                <div class="title">[ RP ] RewardPoints</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="youplay-user-navigation">
        <div class="container">
          <ul role="tablist">
            <li role="presentation" class="active">
              <a href="#game-profile-char" aria-controls="game-profile-char" role="tab" data-toggle="tab" aria-expanded="true">ตัวละคร</a>
            </li>
            <li role="presentation">
              <a href="#game-profile-inventory" aria-controls="game-profile-inventory" role="tab" data-toggle="tab" aria-expanded="true">คลังรวม</a>
            </li>
            <li role="presentation">
              <a href="#game-profile-mission" aria-controls="game-profile-mission" role="tab" data-toggle="tab" aria-expanded="true">ภารกิจ</a>
            </li>
            <li role="presentation">
              <a href="#widget-match-lol" aria-controls="widget-match-lol" role="tab" data-toggle="tab" aria-expanded="true">LoL</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Banner -->

    <!-- Content -->
    <div class="container youplay-content">
      <div class="row">
        <div role="tabpanel">
          <div class="tab-content">

            <div role="tabpanel" class="tab-pane pl-0 pr-0 active" id="game-profile-char">
              <div class="col-md-4">
                <!-- .card -->
                <div class="card card-danger bg-dark shadow-inner">

                  <div class="ribbon-wrapper ribbon-sm">
                    <div class="ribbon bg-primary text-lg">rent</div>
                  </div>
                  <!-- /.ribbon -->

                  <div class="card-header">
                    <h3 class="card-title">$Admin Knz</h3>
                  </div>
                  <!-- /.card-header -->

                  <div class="card-body">
                    <div class="col-12">
                      <div class="row">
                        <div class="col-md-4">
                          <img src="assets/images/avatar.png">
                        </div>
                        <div class="col-md-8">
                          <center><h4>ข้อมูลตัวละคร</h4></center>
                          <div style="padding: 2px 0px;">เลขไอดี :<span style="float: right">1</span></div>
                          <div style="padding: 2px 0px;">สถานะ : <span style="float: right; color: lightgreen;">มีชีวิต</span></div>
                          <div style="padding: 2px 0px;">EXP :<span style="float: right">961500</span></div>
                          <div style="padding: 2px 0px;">เวลาออนไลน์ : <span style="float: right">1H 20M 30S</span></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="row">
                        <div class="col-md-12">
                          <div style="padding: 5px 0px;">เลือด :
                            <div class="progress youplay-progress active" style="width: 80%; float: right;">
                              <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                20%
                              </div>
                            </div>
                          </div>

                          <div style="padding: 5px 0px;">อาหาร :
                            <div class="progress youplay-progress active" style="width: 80%; float: right;">
                              <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                80%
                              </div>
                            </div>
                          </div>

                          <div style="padding: 5px 0px;">น้ำ :
                            <div class="progress youplay-progress active" style="width: 80%; float: right;">
                              <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                50%
                              </div>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                <!-- /.card -->
              </div>


              <div class="col-md-4">
                <!-- .card -->
                <div class="card card-danger bg-dark shadow-inner">

                  <div class="ribbon-wrapper ribbon-sm">
                    <div class="ribbon bg-primary text-lg">rent</div>
                  </div>
                  <!-- /.ribbon -->

                  <div class="card-header">
                    <h3 class="card-title">$Admin Knz</h3>
                  </div>
                  <!-- /.card-header -->

                  <div class="card-body">
                    <div class="col-12">
                      <div class="row">
                        <div class="col-md-4">
                          <img src="assets/images/avatar.png">
                        </div>
                        <div class="col-md-8">
                          <center><h4>ข้อมูลตัวละคร</h4></center>
                          <div style="padding: 2px 0px;">เลขไอดี :<span style="float: right">1</span></div>
                          <div style="padding: 2px 0px;">สถานะ : <span style="float: right; color: lightgreen;">มีชีวิต</span></div>
                          <div style="padding: 2px 0px;">EXP :<span style="float: right">961500</span></div>
                          <div style="padding: 2px 0px;">เวลาออนไลน์ : <span style="float: right">1H 20M 30S</span></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="row">
                        <div class="col-md-12">
                          <span>เลือด :</span>
                          <div class="progress youplay-progress active">
                            <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                              80%
                            </div>
                          </div>

                          <span>อาหาร :</span>
                          <div class="progress youplay-progress active">
                            <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                              80%
                            </div>
                          </div>

                          <span>น้ำ :</span>
                          <div class="progress youplay-progress active">
                            <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                              80%
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                <!-- /.card -->
              </div>

              
            </div>

            <!-- Inventory -->
            <div role="tabpanel" class="tab-pane pl-0 pr-0" id="game-profile-inventory">
                <h3 class="mt-0 mb-20">INVENTORY</h3>
            </div>
            <!-- /Inventory -->

            <!-- Mission -->
            <div role="tabpanel" class="tab-pane pl-0 pr-0" id="game-profile-mission">
                <h3 class="mt-0 mb-20">MISSION</h3>
            </div>
            <!-- /Mission -->

          </div>
        </div>

        
      </div>
    </div>
    <!-- /Content -->
  <!----------------------------- [ LOGIN SUCCESS : END CODE ] ----------------------------->

  <?php
    } else {
  ?>

  <!----------------------------- [ NOT LOGIN : START CODE ] ----------------------------->
  <header>
    <div class="videoe">
      <video onloadeddata="this.play(); this.muted=true;" style="width:100%;" playsinline loop muted>
        <source src="assets/inside.mp4" type="video/mp4">
      </video>
    </div>
  </header>

  <!-- Banner Additional classes: .small .xsmall .big .full -->
  <section class="youplay-banner big">
    <div class="info">
      <div class="text-center">
        <img src="assets/images/shooter/logo-full.png" width="40%" height="auto" alt=""></div>
      </div>
    </div>
  </section>
  <!-- /Banner -->
  <!----------------------------- [ NOT LOGIN : END CODE ] ----------------------------->

  <?php
    }
  ?>

</section>
<!-- end : Main Content -->