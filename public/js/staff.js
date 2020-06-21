$(document).ready(function(){
  const $button  = document.querySelector('#sidebar-toggle');
  const $wrapper = document.querySelector('#wrapper');
  const $tit = document.querySelector('#title');
  const $wra=document.querySelector('#smallloginLogo');


  $navbarwidth=$("#staff_navabar").width();

  $button.addEventListener('click', (e) => {
    e.preventDefault();
      $sidebar=$("#sidebar-wrapper").width();
      $wrapper.classList.toggle('toggled');
        if($sidebar===0){
          $("#staff_navabar").width($navbarwidth);
        }else{
          $("#staff_navabar").width($navbarwidth+300);
        }
  });



  function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      var htmlPreview =
        '<img width="200" src="' + e.target.result + '" />' +
        '<p>' + input.files[0].name + '</p>';
      var wrapperZone = $(input).parent();
      var previewZone = $(input).parent().parent().find('.preview-zone');
      var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');
      wrapperZone.removeClass('dragover');
      previewZone.removeClass('hidden');
      boxZone.empty();
      boxZone.append(htmlPreview);
    };

    reader.readAsDataURL(input.files[0]);
  }
  }

  function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
  }



  $(".dropzone").change(function() {
  readFile(this);
  });

  $('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
  });

  $('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
  });

  $('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
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
});
