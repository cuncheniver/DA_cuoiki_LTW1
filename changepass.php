
<div id="myModal2" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <div class="modal-header">
    <span class="closee">&times;</span>
    <h2>Change Passwords</h2>
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
  
               
               <form   method="POST" enctype="multipart/form-data">

<
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