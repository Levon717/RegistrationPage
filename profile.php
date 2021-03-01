<?php

include 'layouts/header.php';

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="profile.php">Web site</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="profile.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="map.php">Map</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <h5>log out</h5>
          </a>
        </li>
      </ul>
    </form>
  </div>
</nav>

<div class="container" style="width: 50vh;">
  <h3 align="center">User Profile</h3>
      <form id="uploadImage" action="upload.php" method="post">
        <div id="loader-icon" style="display:none;"><img src="loader.gif" /></div>
        <div id="targetLayer" style="display:none;"></div>
        <div class="form-group">
          <label>File Upload</label>
          <input type="file" name="uploadFile" id="uploadFile" accept=".jpg, .png" />
        </div>
        <div class="form-group">
          <input type="submit" id="uploadSubmit" value="Upload" class="btn btn-info" />
        </div>
      </form>
    </div>
 
<script>
  $(document).ready(function () {
    $('#uploadImage').submit(function (event) {
      if ($('#uploadFile').val()) {
        event.preventDefault();
        $('#loader-icon').show();
        $('#targetLayer').hide();
        $(this).ajaxSubmit({
          target: '#targetLayer',
          beforeSubmit: function () {
            $('.progress-bar').width('50%');
          },
          uploadProgress: function (event, position, total, percentageComplete) {
            $('.progress-bar').animate({
              width: percentageComplete + '%'
            }, {
              duration: 1000
            });
          },
          success: function () {
            $('#loader-icon').hide();
            $('#targetLayer').show();
          },
          resetForm: true
        });
      }
      return false;
    });
  });
</script>

<?php

include 'layouts/footer.php';

?>