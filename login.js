$(document).ready(function(){
  // When focusing on a text input field
  $(":text").focus(function(){
    // Modify CSS properties of elements on focus
    $(".m12").css({
      'border-radius': '0 0 25px 25px',
      'background-color': 'pink',
      height: '19px',
      width: '13px',
      position: 'relative',
      left: '62px',
      bottom: '35px',
      transition: '3s'
    });
    $(".x, .earl").css({
      'border-radius': '100% 10% 0 0',
      transition: '1s'
    });
    $(".x2, .earr").css({
      'border-radius': '10% 100% 0 0',
      transition: '1s'
    });
    $(".handl").css({
      transform: 'rotate(0deg)',
      bottom: '140px',
      left: '50px',
      height: '45px',
      width: '35px'
    });
    $(".handr").css({
      transform: 'rotate(0deg)',
      bottom: '190px',
      left: '250px',
      height: '45px',
      width: '35px'
    });
    $(".eyeball1").css({
      top: '10px',
      left: '15px'
    });
    $(".eyeball2").css({
      top: '11px',
      left: '5px'
    });
    $(".c1").css({
      top: '35.5px',
      left: '25px',
      height: '8px',
      width: '2px'
    });
    $(".c2").css({
      top: '29.5px',
      left: '15px',
      height: '8px',
      width: '2px'
    });
    $(".c3").css({
      top: '18.5px',
      left: '5px',
      height: '8px',
      width: '2px'
    });
  });

  // When focusing on a password input field
  $(":password").focus(function(){
    // Modify CSS properties of elements on focus
    $(".x, .earl").css({
      'border-radius': '10% 100% 0 0',
      transition: '1s'
    });
    $(".x2, .earr").css({
      'border-radius': '100% 10% 0 0',
      transition: '1s'
    });
    $(".eyeball1").css({
      top: '10px',
      left: '18px'
    });
    $(".eyeball2").css({
      top: '5px',
      left: '10px'
    });
    $(".handl").css({
      transform: 'rotate(-160deg)',
      bottom: '225px',
      left: '90px',
      height: '90px',
      width: '40px'
    });
    $(".handr").css({
      transform: 'rotate(150deg)',
      bottom: '320px',
      left: '192px',
      height: '90px',
      width: '40px'
    });
    $(".c1").css({
      top: '78px',
      left: '8px',
      height: '10px',
      width: '4px'
    });
    $(".c2").css({
      top: '70px',
      left: '20px',
      height: '10px',
      width: '4px'
    });
    $(".c3").css({
      top: '55px',
      left: '30px',
      height: '10px',
      width: '4px'
    });
  });
});
