<?php
  session_start();
  $_SESSION["message"] = "";

  /**
   * Music controller class to upload, play and add to favourite music.
   */
  class Music extends Framework {

    /**
     * Function to load user music upload page.
     */
    public function upload() {

      // Check if user is already logged in or not.
      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
        if(isset($_POST["add-music"])) {
          $this->model("MusicModel");
          $this->model("UserDb");
        
          // Creating MusicModel object to upload music.
          $music = new MusicModel();

          // Creating database object to access data from database.
          $database = new UserDb();
        
          $userId = $database->getUserId($_SESSION["email"]);
          $music->uploadMusic($_FILES["music-file"]);

          $_SESSION["userId"] = $userId;
          $GLOBALS["mnameErr"] = $music->isEmpty($_POST["music-name"]);
          $GLOBALS["singerErr"] = $music->isEmpty($_POST["singer"]);

          // Check if music cover image is not empty.
          if(!empty($_FILES["cover-image"])) {
            $music->uploadCoverImage($_FILES["cover-image"]);
          }
          else {
            $music->imageFileLocation = "";
          }
        
          // Check of uploaded music input field is ok.
          if($music->uploadOk) {
            $userMusicExists = $database->isMusicExists($userId, $_POST["music-name"], $_POST["singer"]);
            $musicExists = $database->isMusicExists(1, $_POST["music-name"], $_POST["singer"]);

            // Check if music being uploaded already exists.
            if(!$userMusicExists && !$musicExists){
              $addUserMusic = $database->addUserMusic($userId, $_POST["music-name"], $_POST["singer"], $_POST["genre"], 
                $music->musicFileLocation, $music->imageFileLocation);

              $uploadId = $database->fetchMusicById($_POST["music-name"], $_POST["singer"]);

              $addMusic = $database->addMusic($_POST["music-name"], $_POST["singer"], $_POST["genre"], 
                $music->musicFileLocation, $music->imageFileLocation, $uploadId);

              // Check for whether music has been uploaded or not.
              if($addUserMusic && $addMusic) {
                if(move_uploaded_file($_FILES["music-file"]["tmp_name"], $music->musicFileLocation)) {

                  if(!empty($_FILES["cover-image"])) {
                    move_uploaded_file($_FILES["cover-image"]["tmp_name"], $music->imageFileLocation);
                  }
                  $_SESSION["message"] = "Music uploaded successfully!";
                  $this->view("addmusic");
                }
                else {
                  $_SESSION["message"] = "Error occured while uploading!";
                  $this->view("addmusic");
                }
              }
              else {
                $_SESSION["message"] = "Failed to upload music!";
                $this->view("addmusic");
              }
            }
            else {
              $_SESSION["message"] = "Music already exists!";
              $this->view("addmusic");
            }
          }
          else {
            $GLOBALS["musicErr"] = $music->uploadErr;
            $GLOBALS["musicImgErr"] = $music->uploadImgErr;
            $this->view("addmusic");
          }
        }
        else {
          $this->view("addmusic");
        }
      }
      else {
        $this->redirect("home");
      }
    }

    /**
     * Function to load play music page.
     * 
     *  @param int $musicId
     *    Hold current playing music id.
     */
    public function play(int $musicId) {

      // Check if user is already logged in or not.
      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
        $this->model("UserDb");

        $database = new UserDb();
        $isFav = $database->isFavourite($_SESSION["userId"], $musicId);
        $music = $database->requestMusic();

        $_SESSION["isFav"] = $isFav;
        $_SESSION["playnow"] = $music[$musicId - 1];

        $this->view("playmusic");
      }
      else {
        $this->redirect("home");
      }
    }

    /**
     * Function load music page with load more button.
     * 
     *  @return response
     *    It will return html page with music list with pagination.
     */
    public function loadMore() {
      $this->model("UserDb");
      $database = new UserDb();
      $music = $database->musicList();
      $rowCount = $database->calculateRows("music");

      $_SESSION["loadMusic"] = $music;
      $_SESSION["rowCount"] = $rowCount;     

      return ($this->view("music"));
    }

    /**
     * Function to load add or remove to favourite page.
     */
    public function favourites() {
      $this->model("UserDb");
      $database = new UserDb();
      $fav = $database->favourite($_SESSION["userId"], $_SESSION["currentMusicId"]);
      echo $fav;
    }

  }
?>
