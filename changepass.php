
<div id="myModal2" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <div class="modal-header">
    <span class="closee">&times;</span>
    <h2>Edit Profile</h2>
  </div>
  <div class="modal-body">
  <div class="row" style="padding-left:20%;">
  <div class="col-lg-2">
  <script type="text/javascript">
   function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                $('#ns').css('background-image', 'url(' + e.target.result+ ')','center center;');
                        
                  
              };

              reader.readAsDataURL(input.files[0]);
          }
      }
</script>
 
 
  </div>
  <div class="col-lg-8" >
  <div class="form-content">
  
               
               <form  action="function.php" method="POST" enctype="multipart/form-data">

<input id="ns"  onchange="readURL(this);" type="file" name="image" accept="image/gif, image/jpeg, image/png" for="avatarselect" class="page-input-title-img" style="background: url(upload/<?php print_r($profile['user_image']); ?>) center center;background-size: cover !important;">


                          <div class="form-group"><label for="username">MẬT KHẨU HIỆN TẠI</label><input type="password" id="name" name="passcu" required="required"        /> </div>
                          <div class="form-group"><label for="phone">MẬT KHẨU MỚI</label><input type="password" id="phone" name="passmoi" required="required"  /></div>
                          <div class="form-group"><label for="phone"> NHẬP LẠI MẬT KHẨU MỚI</label><input type="password" id="phone" name="passmoi" required="required"  /></div>
           
                          <div class="form-group"><button name="Save" type="submit">Save</button></div>
                      </form>
                  </div>
  </div>
  </div>
 
  </div>

</div>

</div>
<script>
// Get the modal
var modal = document.getElementById("myModal2");

// Get the button that opens the modal
var btn = document.getElementById("mynewpass");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closee")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>