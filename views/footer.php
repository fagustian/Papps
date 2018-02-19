    <footer class="footer">
      <div class="container footer-container">
        <span class="text-muted" style="font-size:80%;">&copy; Fuji Agustian 2018</span>
      </div>
    </footer>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    
  

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title hurufSerif" id="modalTitle">LogIn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <!--Form for Modal Content -->
        <form>
          <div class="form-group">
            <div id='errorDiv' class="alert alert-warning" role="alert">
                <strong>Waddaw!&nbsp;</strong>
                <span id='pesanError'></span>
            </div>
          </div>

          <div id="usernameModal" class="form-group">
            <label class="tulisanUngu hurufSansSerif" for="username">User Name</label>
            <input type="text" class="form-control" id="username" placeholder="User Name">
          </div>

          <div class="form-group">
            <input type="hidden" id="loginActive" name="loginActive" value="1">
            <label class="tulisanUngu hurufSansSerif" for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email address">
          </div>

          <div class="form-group">
            <label class="tulisanUngu hurufSansSerif" for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
          </div>

          <div class="form-check" >
              <label for="" class="form-check-label tulisanGray">
                  <input id="stayLoggedIn" class="form-check-input" type="checkbox" name="stayLoggedIn"  >Stay login
              </label>
          </div>

        </form>

        <!-- end -->
      </div>
      <div class="modal-footer">
      <span class="tulisanUngu">
        <a id="toggleLogin" Style="text-decoration:none; padding-right:10px;" class="tulisanUngu hurufSansSerif">SignUp</a></span>
        <button  class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="signUpBtn"  class="btn btn-primary">LogIn</button>
      </div>
    </div>
  </div>
</div>
<script>

  $('#btnLoginSignup').click(function(){
    $('#errorDiv').hide();
  });

// script untuk toggle Login atau SignUp
  $("#toggleLogin").click(function () {
   

    if ($("#loginActive").val()== 1 ) {
      $('#errorDiv').hide();
      $("#loginActive").val("0");
      $('#usernameModal').show();
      $("#toggleLogin").html("LogIn");
      $("#modalTitle").html("SignUp");
      $("#signUpBtn").html("SignUp");
    }else if ($("#loginActive").val()== 0 ) {
      $('#errorDiv').hide();
      $("#loginActive").val("1");
      $('#usernameModal').hide();
      $("#toggleLogin").html("SignUp");
      $("#modalTitle").html("LogIn");
      $("#signUpBtn").html("LogIn");
    }
    
  });
  //END ------------------------------------;

  $("#signUpBtn").click(function(){

    // pengecekan checkbox dengan jQuery
    if ($('#stayLoggedIn').is(':checked')){
      $('#stayLoggedIn').val('1');
    }else{
      $('#stayLoggedIn').val('0');
    }
    // end------------------------------

    $.ajax({
      type: 'POST',
    
      url: 'actions.php?actions=LoginSignup',
      data: { 
          'username': $('#username').val(),
          'email': $("#email").val(), 
          'password': $("#password").val(),
          'loginActive': $("#loginActive").val(), 
          'stayLogin' : $("#stayLoggedIn").val()
      },
      success: function(msg){
       
        if(msg == 'login'){
          $('#errorDiv').hide();
          window.location.assign('http://localhost/project/Papps/');
         
        }else{
          $('#errorDiv').show();
          $('#pesanError').html(msg);
        }
       
          
          
      }
    });
  });


  // fungsi ketika link ikuti diclik

    $('.toggleFollow').click(function(){ 

       var id = $(this).attr('data-userId');

        $.ajax({ 
          type:'POST',
          url:'actions.php?actions=toggleFollow',
          data:{'userId' : id },
          
            success: function(msg){
              if(msg == '1'){
                $("a[data-userId='" + id + "']").html('Follow');
                location.reload();
              }else if(msg == '2'){
                $("a[data-userId='" + id + "']").html('Unfollow');
                location.reload();
              }
            }
        });
    });     
    
  // end ---------------------------
  $('.blinkNavbar').click(function(){

        $('#btnLoginSignup').css('font-size','110%');
        $('#btnLoginSignup').css('background','white');
       
        

      
  });
  // btnPostClick-----------------

  $('#btnPostPapps').click(function(){
    var posting = $('#textAreaPostPapps').val();
    $.ajax({ 
          type:'POST',
          url:'actions.php?actions=postPapps',
          data:{'postingan' : posting },
          
            success: function(msg){
              if(msg == '0'){
                $('.postKosong').show();
                $('#alertSuksesPapps').hide();
                $('#pesanKosong').html('<span><strong>Aww..</strong></span><p>Silahkan tulis sesuatu dan coba lagi..</p>');
              }else if (msg == '1'){ 
                $('.postKosong').show();
                $('#alertSuksesPapps').hide();
                $('#pesanKosong').html('<span><strong>Aww..</strong></span><p>Papps anda lebih terlalu panjang</p>');
              }else if (msg == '2'){ 
                $('.postKosong').hide();
                $('#alertSuksesPapps').show();
                location.reload();
                $('#suksesPapps').html('<span>Kamu papps :)</span>');

                
              }else{
                alert(msg);
              }
            }
        });
  });


  // fungsi dibawah untuk menhide navbasr ketiak discrool ke bawah dan muncul lagi ketika discrool ke ata
  $(function () {
  var lastScrollTop = 0;
  var $navbar = $('.navbar');

  $(window).scroll(function(event){
    var st = $(this).scrollTop();

    if (st > lastScrollTop) { // scroll down
      
      // use this is jQuery full is used
     
      
      // use this to use CSS3 animation
      $navbar.addClass("fade-out");
      $navbar.removeClass("fade-in");
      
      // use this if no effect is required
      $navbar.fadeOut();
    
    } else { // scroll up
      
      // use this is jQuery full is used
     
      
      // use this to use CSS3 animation
      $navbar.addClass("fade-in");
      $navbar.removeClass("fade-out");
      
      // use this if no effect is required
      $navbar.fadeIn();
    }
    lastScrollTop = st;
  });
  // batas hide unhide navbar------------------------------------------------------------>
});

</script>
  
  </body>
</html>