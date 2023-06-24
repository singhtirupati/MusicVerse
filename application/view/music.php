<?php
  $music = $_SESSION["loadMusic"];
  $num_of_rows = $_SESSION["rowCount"];

  $page = "";

  if(isset($_POST["page_no"])) {
    $page = $_POST["page_no"];
  }
  else {
    $page = 1;
  }

  $total_pages = ceil($num_of_rows/8);

  if(!empty($music)) {
    foreach($music as $value) {
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

<div class="music-box">
  <h2>No music found</h2>
</div>

<?php
  }
?>

<div class="page-num" id="pagination">
  <?php
    for($i = 1; $i <= $total_pages; $i++) {
      if($i == $page) {
        $class_name = "active";
      }
      else {
        $class_name = "inactive";
      }
  ?>
  <a class='<?php echo $class_name ?>' id='<?php echo $i ?>' href=''><?php echo $i ?></a>
  <?php
    }
  ?>
</div>
