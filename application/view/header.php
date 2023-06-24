<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUSIC VERSE | Listen to your music..</title>
    <link rel="icon" href="/public/img/logo.svg" type="image/icon type">
    <link rel="stylesheet" href="/public/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  </head>
  <body>

    <!-- Main container -->
    <div class="main-container">

      <!-- Navbar container -->
      <div class="navbar">
        <div class="page-wrapper">
          <div class="nav">
            <div class="nav-logo">
              <a href="/home/dashboard"><img src="/public/img/logo.svg" alt="Music Verse">MUSIC VERSE</a>
            </div>
            <ul class="nav-ul">
              <li><a href="/home/user"><?php if(isset($_SESSION["username"])) { echo $_SESSION["username"];}?></a></li>
              <li><a href="/home/dashboard">Home</a></li>
              <li><a href="/music/upload">Add Music</a></li>
              <li><a href="/home/signout">Sign Out</a></li>
            </ul>
          </div>
        </div>
      </div>
