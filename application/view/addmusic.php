<?php
  require 'application/view/header.php';
?>

<div class="banner-container">
  <div class="page-wrapper banner-wrap">
    <div class="addmusic-content">
      <div class="error-msg">
        <span><?php if(isset($_SESSION["message"])) {echo $_SESSION["message"];} ?></span>
      </div>
      <div class="title-head">
        <h1>Add Music</h1>
      </div>

      <!-- Form container -->
      <div class="form-container">
        <form action="/music/upload" method="post" enctype="multipart/form-data">
          <div class="music-img">
            <div class="form-input" id="music">
              <label for="music-file">Music File</label>
              <input type="file" name="music-file" id="music-file" class="music-info">
              <span class="error" id="checkMusic"><?php if(isset($GLOBALS["musicErr"])) { echo $GLOBALS["musicErr"]; } ?></span>
            </div>
  
            <div class="form-input">
              <label for="cover-image">Cover Image</label>
              <input type="file" name="cover-image" id="cover-image" class="music-info">
              <span class="error" id="checkCover"><?php if(isset($GLOBALS["musicImgErr"])) { echo $GLOBALS["musicImgErr"]; } ?></span>
            </div>
          </div>

          <div class="form-input">
            <label for="music-name">Music Name</label>
            <input type="text" name="music-name" id="music-name" placeholder="Enter music name" required>
            <span class="error" id="checkMusicName"><?php if(isset($GLOBALS["mnameErr"])) { echo $GLOBALS["mnameErr"]; } ?></span>
          </div>

          <div class="form-input">
            <label for="singer">Singer(s)</label>
            <input type="text" name="singer" id="singer" placeholder="Singer(s)" required>
            <span class="error" id="checkSinger"><?php if(isset($GLOBALS["singerErr"])) { echo $GLOBALS["singerErr"]; } ?></span>
          </div>

          <div class="form-input interest-div">
            <label for="genre[]">Genre</label>
            <input type="checkbox" id="pop" name="genre[]" value="Pop">
            <label for="pop">Pop</label>
            <input type="checkbox" id="rock" name="genre[]" value="Rock">
            <label for="rock">Rock</label>
            <input type="checkbox" name="genre[]" id="classic" value="Classic">
            <label for="classic">Classic</label>
            <input type="checkbox" name="genre[]" id="hiphop" value="Hip Hop">
            <label for="hiphop">Hip Hop</label>
            <input type="checkbox" name="genre[]" id="others" value="Others">
            <label for="others">Others</label>
          </div>

          <div class="form-input">
            <input type="submit" name="add-music" id="submit-btn" value="Upload Music">
          </div>
        </form>
      </div>
      <div class="back-container">
        <a href="/home/dashboard" class="back-btn">Go Back</a>
      </div>
    </div>
  </div>
</div>

<?php
  require 'application/view/footer.php';
?>
