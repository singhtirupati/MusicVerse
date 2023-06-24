<?php
  require 'application/view/header.php';
?>

<!-- Dasboard container -->
<div class="dashboard-container">
  <div class="page-wrapper dashboard-wrap">
    <div class="dashboard-content">
      <?php
        $userMusic = $_SESSION["userMusic"];
        $userProfile = $_SESSION["userProfile"];
        $userFavourite = $_SESSION["userFavourite"];
      ?>

      <div class="user-profile">
        <div class="user-data">
          <div class="info-box">
            <div class="info-flex-box">
              <h3>Name:</h3>
            </div>
            <div class="info-flex-box">
              <h3><?php echo $userProfile[0]["user_name"]; ?></h3>
            </div>
          </div>
          <div class="info-box">
            <div class="info-flex-box">
              <h3>Gender:</h3>
            </div>
            <div class="info-flex-box">
              <h3><?php echo $userProfile[0]["user_gender"]; ?></h3>
            </div>
          </div>
          <div class="info-box">
            <div class="info-flex-box">
              <h3>Phone:</h3>
            </div>
            <div class="info-flex-box">
              <h3><?php echo $userProfile[0]["user_phone"]; ?></h3>
            </div>
          </div>
          <div class="info-box">
            <div class="info-flex-box">
              <h3>Email:</h3>
            </div>
            <div class="info-flex-box">
              <h3><?php echo $userProfile[0]["user_email"]; ?></h3>
            </div>
          </div>
          <div class="info-box">
            <div class="info-flex-box">
              <h3>Interests:</h3>
            </div>
            <div class="info-flex-box">
              <h3><?php echo $userProfile[0]["user_interest"]; ?></h3>
            </div>
          </div>
        </div>
      </div>

      <div class="update-btn">
        <a href="/profile/update">Update Profile</a>
      </div>
    </div>
  </div>
</div>

<!-- User Upload container -->
<div class="music-container upload-container">
  <div class="page-wrapper music-wrap">
    <div class="music-content">
      <div class="music-list">
        <h2>Your uploads</h2>
        <?php
          if(!empty($userMusic)) {
          foreach($userMusic as $value) {
        ?>

        <div class="music-box">
          <div class="music-cover-img">
            <img src="/<?php echo $value['cover_img'] ?>" alt="<?php $value['name'] ?>">
            <div class="play-btn">
              <a href="/music/play/<?php echo $value['music_id']?>"><img src="/public/img/play-btn.svg" alt="Play Now"></a>
            </div>
          </div>
          <div class="music-details">
            <h3><?php echo $value['name'] ?></h3>
            <h4>Singer: <?php echo $value['singer'] ?></h4>
            <p>Genre: <?php echo $value['genre'] ?></p>
          </div>
        </div>

        <?php
            }
          }
          else {
        ?>

        <div class="upload">
          <h3 style="color: white">You have not uploaded any music.</h3>
        </div>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</div>

<!-- Favourite container -->
<div class="music-container favourite-container">
  <div class="page-wrapper music-wrap">
    <div class="music-content">
      <div class="music-list favourites">
        <h2>Favourites</h2>
        <?php
          if(!empty($userFavourite)) {
          foreach($userFavourite as $value) {
        ?>

        <div class="music-box">
          <div class="music-cover-img">
            <img src="/<?php echo $value['cover_img'] ?>" alt="<?php $value['name'] ?>">
            <div class="play-btn">
              <a href="/music/play/<?php echo $value['music_id']?>"><img src="/public/img/play-btn.svg" alt="Play Now"></a>
            </div>
          </div>
          <div class="music-details">
            <h3><?php echo $value['name'] ?></h3>
            <h4>Singer: <?php echo $value['singer'] ?></h4>
            <p>Genre: <?php echo $value['genre'] ?></p>
          </div>
        </div>

        <?php
            }
          }
          else {
        ?>

        <div class="upload">
          <h3>You have no favourite music.</h3>
        </div>
        
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</div>

<?php
  require 'application/view/footer.php';
?>
