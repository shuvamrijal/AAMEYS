$(document).ready(function(){
  const $button  = document.querySelector('#sidebar-toggle');
  const $wrapper = document.querySelector('#wrapper');
  const $tit = document.querySelector('#title');
const $wra=document.querySelector('#smallloginLogo')
  $button.addEventListener('click', (e) => {
    e.preventDefault();
    $wrapper.classList.toggle('toggled');
    $wra.classList.toggle('new');
    $tit.classList.toggle('title');
  
  });
      $('#account_list li a').click(function(e) {
          $('#account_list li.active').removeClass('active');
          var $parent = $(this).parent();
          $parent.addClass('active');
          e.preventDefault();
      });
      $('#change_username').click(function(e){
        //alert('sujan');
        $('#usernamerow').css('display','none');
        $('#changeusernamerow').css('display','block');
      });
      $('#cancel').click(function(e){
        //alert('sujan');
        $('#usernamerow').css('display','block');
        $('#changeusernamerow').css('display','none');
      });

      $('#change_password').click(function(e){
        //alert('sujan');
        $('#change_password p').css('display','none');
        $('#chnagepassword').css('display','block');
      });
      $('#passcancel').click(function(e){
        $('#change_password p').css('display','block');
        $('#chnagepassword').css('display','none');
      });

  $('.sub-menu ul').hide();
  $(".sub-menu a").click(function () {
  	$(this).parent(".sub-menu").children("ul").slideToggle("100");
  	$(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
  });



});
