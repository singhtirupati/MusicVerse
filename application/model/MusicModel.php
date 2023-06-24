<?php

  /**
   * This class contains methods to upload music in database.
   */
  class MusicModel {

    /**
     *  @var int $uploadOk
     *    Hold value 1 if all fields are valid, 0 if not.
     */
    public int $uploadOk = 1;

    /**
     *  @var string $uploadErr
     *    Stores music upload error message.
     */
    public string $uploadErr = "";

    /**
     *  @var string $uploadImgErr
     *    Stores image upload error message.
     */
    public string $uploadImgErr = "";

    /**
     * Initializing TARGET_DIR with directory path to upload music.
     */
    const TARGET_DIR = "public/music/usermusic/";

    /**
     *  @var string $musicFileLocation
     *    Holds music uploaded location with music file name.
     */
    public string $musicFileLocation = "";

    /**
     *  @var string $musicFileType
     *    Stores music file extension.
     */
    public string $musicFileType;

    /**
     * Initializing IMG_TARGET_DIR with directory path to upload cover image. 
     */
    const IMG_TARGET_DIR = "public/music/coverimage/";

    /**
     *  @var string $imageFileLocation
     *    Holds cover image uploaded location with image file name.
     */
    public string $imageFileLocation = "";

    /**
     *  @var string $imageFileType
     *    Stores image file extension.
     */
    public string $imageFileType;
    
    /**
     * Function to upload music file.
     * 
     *  @param array $musicFile
     *    Contains music file path.
     */
    public function uploadMusic(array $musicFile) {
      $this->musicFileLocation = self::TARGET_DIR . basename($musicFile["name"]);

      $this->musicFileType = strtolower(pathinfo($this->musicFileLocation, PATHINFO_EXTENSION));
      
      // Check file size is not 0.
      if(!$musicFile["size"] == 0) {

        // Check for uploaded file size.
        if($musicFile["size"] > 10000000) {
          $this->uploadErr = "Sorry, music file is too large.";
          $this->uploadOk = 0;
        }
  
        // Check for file extension format.
        if($this->musicFileType != "mp3"
            && $this->musicFileType != "wav"
            && $this->musicFileType != "ogg") {
          $this->uploadErr = "Sorry, only MP3, WAV and OGG music file allowed.";
          $this->uploadOk = 0;
        }
      }
      else {
        $this->uploadErr = "Please select a music file.";
        $this->uploadOk = 0;
      }
    }

    /**
     * Function to upload cover image.
     * 
     *  @param array $musicCover
     *    Holds image path value.
     */
    public function uploadCoverImage(array $musicCover) {
      $this->imageFileLocation = self::IMG_TARGET_DIR . basename($musicCover["name"]);

      $this->imageFileType = strtolower(pathinfo($this->imageFileLocation, PATHINFO_EXTENSION));

      // Check file size is not 0.
      if(!$musicCover["size"] == 0) {  

        // Check for uploaded file size.
        if($musicCover["size"] > 10000000) {
          $this->uploadImgErr = "Sorry, image file is too large.";
          $this->uploadOk = 0;
        }
  
        // Check for file extension format.
        if($this->imageFileType != "jpg"
            && $this->imageFileType != "png"
            && $this->imageFileType != "jpeg"
            && $this->imageFileType != "gif") {
          $this->uploadImgErr = "Sorry, only JPG, PNG, JPEG and GIF file allowed.";
          $this->uploadOk = 0;
        }
      }
      else {
        $this->uploadImgErr = "Please select a cover image file.";
      }
    }

    /**
     * Function check wether input field is empty or not.
     * 
     *  @param string $name
     *    Holds field value.
     * 
     *  @return string
     */
    public function isEmpty(string $name) {
      if(empty($name)) {
        $this->uploadOk = 0;
        return "Field cannot be empty";
      }
      else {
        return "";
      }
    }

  }
?>
