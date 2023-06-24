$(document).ready(function() {

  /**
   * Function to load music on page load and add pagination to load more music.
   * 
   *  @param int page
   *    Holds page number to be display.
   */
  function loadMusic(page) {
    $.ajax({
      url: "/music/loadMore",
      type: "POST",
      data: {page_no :page},
      success: function(data) {
        $("#musiclist").html(data);
      }
    });
  }

  loadMusic();

  // It will page number to be loaded.
  $(document).on("click", "#pagination a", function(e) {
    e.preventDefault();
    var page_id = $(this).attr("id");

    loadMusic(page_id);
  });

  /**
   * This function will add music to user favourite list or remove music from
   * favourite list.
   */
  function favourite() {
    $.ajax({
      url: "/music/favourites",
      type: "POST",
      success: function(data) {
        var favbutton;
        if(data == 1) {
          favbutton = '<a href="/music/favourites" id="fav-btn"><i class="fa fa-heart fa_custom fa-2x liked"></a>';
        }
        else {
          favbutton = '<a href="/music/favourites" id="fav-btn"><i class="fa fa-heart fa_custom fa-2x unliked"></a>';
        }
        $("#fav").html(favbutton);
      }
    });
  }

  // Favourite button to add or remove favourite music.
  $(document).on("click", "#fav-btn", function(e) {
    e.preventDefault();
    favourite();
  });
});
