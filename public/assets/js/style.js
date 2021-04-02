// countDownDate
$(function () {
  var countDownDate = new Date(2018, 10, 20, 18, 0, 0, 0);
  // console.log(countDownDate.toLocaleDateString("en-US")); // 9/17/2016
  var x = setInterval(function () {
    var now = new Date().getTime();
    // console.log('now =' + now); console.log('countDownDate =' +
    // countDownDate.getTime());
    var distance = countDownDate.getTime() - now;
    var distance_seconds = distance / 1000;

    // var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 *
    // 60)); var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    // var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    var days = Math.floor(distance_seconds / 24 / 60 / 60);
    var hoursLeft = Math.floor(distance_seconds - days * 86400);
    var hours = Math.floor(hoursLeft / 3600);
    var minutesLeft = Math.floor(hoursLeft - hours * 3600);
    var minutes = Math.floor(minutesLeft / 60);
    var seconds = Math.floor(distance_seconds % 60);

    // console.log('hours =' + hours);

    $("#days").text(days);
    $("#hours").text(hours);
    $("#minutes").text(minutes);
    $("#seconds").text(seconds);

    // if (distance < 0) {     clearInterval(x);
    // document.getElementById("d").classList.add('d-none');
    // document.getElementById("h").classList.add('d-none');
    // document.getElementById("m").classList.add('d-none');
    // document.getElementById("s").classList.add('d-none');
    // document.getElementById("timer-text").classList.add('d-none');
    // document.getElementById("t-end").classList.add('w_time');
    // document.getElementById("end_time").innerHTML = "Thời gian sự kiện đã kết
    // thúc !";     } if(distance > 0){
    // document.getElementById("h").classList.remove('d-none');
    // document.getElementById("m").classList.remove('d-none');
    // document.getElementById("s").classList.remove('d-none');
    // document.getElementById("end_time").innerHTML = ""; }
  }, 1000);
});
// AGENDA
// scroll top menu
window.onscroll = function () {
  myFunction();
};

var header = document.getElementById("nav");

function myFunction() {
  if (header !== null) {
    var sticky = header.offsetTop;
    if (window.pageYOffset > sticky) {
      header.classList.add("nav2");
    } else {
      header.classList.remove("nav2");
    }
  }
}

function findBootstrapEnvironment() {
  var envs = ["sm", "md", "lg", "xl"];
  var env = "";

  var $el = $("<div>");
  $el.appendTo($("body"));
  $el.addClass("d-block");
  for (var i = envs.length - 1; i >= 0; i--) {
    env = envs[i];
    $el.addClass("d-" + env + "-none");
    if ($el.is(":hidden")) {
      $el.remove();
      return env;
    }
  }
  $el.remove();
  return "xs"; //extra small
}

// -----
function show_popup(title, content) {
  $("#myModal-js-success").modal({ backdrop: "static", keyboard: false });
  $("#myModal-js-success .modal-title").text(title);
  var content = typeof content != "undefined" ? content : "";
  if (content) {
    $("#myModal-js-success .modal-body .text-center").text(content);
  } else {
    $("#myModal-js-success .modal-body .text-center").hide();
  }
  $("#myModal-js-success").modal("show");
  //---loai bo xu kien truoc do
  $(".modal-header .close")
    .unbind("click")
    .bind("click", function () {
      hide_popup();
    });
}

function show_popup_tks(title, content) {
  $("#myModal-js-success").modal({ backdrop: "static", keyboard: false });
  $("#myModal-js-success .modal-title").text(title);
  var content = typeof content != "undefined" ? content : "";
  if (content) {
    $(".w800").addClass("fix_800");
    $("#myModal-js-success .modal-body .text-center").text(content);
  } else {
    $("#myModal-js-success .modal-body .text-center").hide();
  }
  $("#myModal-js-success").modal("show");
  //---loai bo xu kien truoc do
  $(".modal-header .close")
    .unbind("click")
    .bind("click", function () {
      hide_popup();
    });
}
var url_redirect = "";

function hide_popup() {
  $("#myModal-js-success").hide();
  if (url_redirect) {
    location.href = url_redirect;
  }
  url_redirect = ""; // Reset
}

function show_success() {
  var title = "You registered successfully!";
  url_redirect = root + "thank-you";
  if (url_redirect) {
    location.href = url_redirect;
  }
  url_redirect = "";
}

function show_fail() {
  var title = "Your registration was NOT successful!";
  var content = typeof content != "undefined" ? content : "";
  url_redirect = root + FORM_SUBMIT_FAILED_URL;
  if (url_redirect) {
    location.href = url_redirect;
  }
  url_redirect = "";
}

function show_popup_success() {
  var title = "You registered successfully!";
  url_redirect = root + "thank-you";
  $(".img_tks").html(
    "<img class='img-fluid' src='assets/images/sales/reg/thanks.png'>"
  );
  show_popup_tks(title);
  setTimeout(function () {
    hide_popup();
  }, 10000);
}

function show_popup_fail(content) {
  var title = "Your registration was NOT successful!";
  var content = typeof content != "undefined" ? content : "";
  url_redirect = root + FORM_SUBMIT_FAILED_URL;
  show_popup(title, content);
}

function show_popup_fail_email(content) {
  var content = "EMAIL EXIST!";
  show_popup_fail(content);
  url_redirect = ""; // Reset
}

function get_base_url(){
    var origin;

    if (!window.location.origin) {
        origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
    }

    origin = window.location.origin;
    
    return origin;
}

var pathname;
var pathname2;

// store url on load
let url_current = location.href;
var menu_maping_json = null;
// listen for changes
setInterval(function()
{
    if (url_current != location.href)
    {
        // page has changed, set new page as 'current'
        url_current = location.href;

        // Set href for language menu
        pathname = location.pathname;
        menu_set_href();
    }
}, 500);

function menu_set_href(){
    var pathname_mod = pathname;
    var pathname_mod_arr = pathname.split('/');
    var pathname_mod_last;
    console.log('menu_set_href(): pathname_mod_arr', pathname_mod_arr);
    if(pathname_mod_arr.length >= 4){
        pathname_mod_last = pathname_mod_arr[pathname_mod_arr.length-1];
        console.log('pathname_mod_last = ', pathname_mod_last);
        if(!isNaN(pathname_mod_last)){
            pathname_mod_arr.pop();
            console.log('pathname_mod_arr', pathname_mod_arr);
            pathname_mod = pathname_mod_arr.join('/');
        } else {
            pathname_mod_last = null;
        }
    }
    
    if(menu_maping_json){
        var menu_maping_lang = null;
        if(flag_en){
            menu_maping_lang = menu_maping_json['menu_mapping_en'];
        }
        if(flag_vi){
            menu_maping_lang = menu_maping_json['menu_mapping_vi'];
        }
        
        console.log('pathname_mod = ', pathname_mod);
        if(menu_maping_lang.hasOwnProperty(pathname_mod)){
            var pathname_other = menu_maping_lang[pathname_mod];
            console.log('pathname_other = ' + pathname_other);
            var base_url = get_base_url();
            console.log('base_url = ' + base_url);
            var url_other = base_url + pathname_other;
            if(pathname_mod_last){
                url_other += '/' + pathname_mod_last;
            }
            console.log('url_other = ' + url_other);
            var link_jele = null;
            if(flag_en){
                link_jele = $('.nav-link-vi');
            }
            if(flag_vi){
                link_jele = $('.nav-link-en');
            }
            if(link_jele && link_jele.length){
                link_jele.attr('href', url_other);
            }
            console.log('link_jele', link_jele);
        }
    }
}

var flag_en = false;
var flag_vi = false;
$(document).ready(function () {
      // Auto redirect to English version
    // var current_url = location.href;
    // console.log('current_url = ' + current_url);
    pathname = location.pathname;
    console.log('pathname = ' + pathname);
    pathname2 = pathname.split('/').join('');
    console.log('pathname2 = ' + pathname2);
    // var hostname = location.hotname;
    // console.log('hostname = ' + hostname);
    flag_en = pathname.indexOf('/en') === 0;
    flag_vi = pathname.indexOf('/vi') === 0;
    var flag_homepage_no_lang = pathname2 == '';
    if(flag_homepage_no_lang){
        var base_url = get_base_url();
        console.log('base_url = ' + base_url);
        location.href = base_url = '/en';
    } else {
        menu_set_href();
    }

  $('a[href*="#"]')
    .not('[href="#"]')
    .not('[href="#0"]')
    .not('[data-toggle="tab"]')
    .on("click", function (event) {
      if (
        location.pathname.replace(/^\//, "") ==
          this.pathname.replace(/^\//, "") &&
        location.hostname == this.hostname
      ) {
        var target = $(this.hash);
        target = target.length
          ? target
          : $("[name=" + this.hash.slice(1) + "]");
        if (target.length) {
          // if ($(window).width() >= 992) {
          $("html, body").animate(
            {
              scrollTop: target.offset().top - 110,
            },
            0
          );
          return false;
          // }
          // if ($(window).width() <= 991) {
          //   $("html, body").animate(
          //     {
          //       scrollTop: target.offset().top - 110,
          //     },
          //     0
          //   );
          //   return false;
          // }
        }
      }
    });
  var form_submit_button_toggle_timer;

  function form_submit_button_toggle(button_selector, is_visible) {
    clearTimeout(form_submit_button_toggle_timer);
    form_submit_button_toggle_timer = setTimeout(function () {
      var button_jele = $(button_selector);
      if (is_visible) {
        button_jele.removeClass("d-none");
        button_jele.siblings().addClass("d-none");
      } else {
        // button_jele.addClass("d-none");
        button_jele.siblings().removeClass("d-none");
      }
    }, 300);
  }
  $("#contact_form").validate({
    rules: {
      name: {
        required: true,
      },
      email: {
        required: true,
        email: true,
      },
      phone: {
        number: true,
        required: true,
      },
      title: {
        required: true,
      },
      message: {
        required: true,
      },
    },
    // messages: {     name: "Nhập họ và tên",     email: "Nhập email",     phone:
    // "Nhập số điện thoại",     experience: "Chọn kinh nghiệm",     nganhnghe:
    // "Chọn ngành nghề",     dinhkem: "Đính kèm CV", }, tooltip_options: { name:
    // {trigger:'focus',placement:'top'},     email: {placement:'right',html:true},
    //    phone: {placement:'right',html:true}, experience:
    // {placement:'right',html:true},     nganhnghe: {placement:'right',html:true},
    //    dinhkem: {placement:'right',html:true}, },
    highlight: function (element) {
      $(element).addClass("has-error");
      $(element).parent().addClass("has-error");
      if ($(element).attr("name") == "file_attach") {
        $(element).siblings(".span-click").addClass("has-error");
        $(".form-group.upfile").addClass("error_up");
      }
      if ($(element).attr("name") == "linkedin_id") {
        $(".loadersmall").addClass("d-none");
        $(".checkld_tb").addClass("d-block");
        $(".change_error")
          .addClass("text_error")
          .text("Vui lòng Connect LinkedIn...tại đây");
      }
      if ($(element).attr("name") == "checkradio") {
        $(element).removeClass("has-error");
        $(element).parent().removeClass("has-error");
        $(element).closest(".advisory_form").addClass("has-error");
      }
    },
    unhighlight: function (element) {
      $(element).removeClass("has-error").addClass("has-success");
      $(element).parent().removeClass("has-error").addClass("has-success");
      if ($(element).attr("name") == "file_attach") {
        $(".form-group.upfile").removeClass("error_up");
        $(element)
          .siblings(".span-click")
          .removeClass("has-error")
          .addClass("has-success");
      }
      if ($(element).attr("name") == "checkradio") {
        $(element).closest(".advisory_form").removeClass("has-error");
      }
    },
    // submitHandler: function (e) {
    //   form_submit_button_toggle("#contact_form .submit-form", false);
    //   $("#contact_form").ajaxSubmit({
    //     success: function (responseText, statusText, xhr, $form) {
    //       var json_data = $.parseJSON(responseText);
    //       console.log(json_data);
    //       if (json_data) {
    //         if (json_data.status == "success") {
    //           show_popup_success();
    //         } else if (json_data == "") {
    //           show_popup_success();
    //         } else {
    //           if (json_data.error) {
    //             form_submit_button_toggle("#contact_form .submit-form", true);
    //             if (json_data.status == "dupplicate-email") {
    //               //$('.btn-js-failed-email').click();
    //               show_popup_fail_email();
    //             } else if (json_data.error.indexOf("upload_file") != -1) {
    //               show_fail();
    //             } else {
    //               show_fail();
    //             }
    //           }
    //         }
    //       } else {
    //         show_popup_success();
    //       }
    //     },
    //   });
    //   //return false;
    // },
  });
  $("#contact_form_dk").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
      },
    },
    highlight: function (element) {
      $(element).addClass("error");
    },
    unhighlight: function (element) {
      $(element).removeClass("error");
    },
    submitHandler: function (e) {
      // e.preventDefault();//submit login
      $("#contact_form_dk").ajaxSubmit({
        success: function (responseText, statusText, xhr, $form) {
          var json_data = $.parseJSON(responseText);
          if (json_data) {
            if (json_data.login == "success") {
              // alert(12345);
              $(".show_popup_cv").slideDown().addClass("show");
              $(".login_error").css({ display: "none" });
            } else {
              $(".login_error").css({ display: "block" });
            }
          }
        },
      });
      //return false;
    },
  });
  $("#contact_form_cv").validate({
    rules: {
      featured: {
        required: true,
      },
      file_attach_cv: {
        required: true,
      },
    },
    highlight: function (element) {
      $(element).addClass("error");
      if ($(element).attr("name") == "file_attach_cv") {
        $(element).siblings(".span-click").addClass("error");
        $(".th_bao").show();
      }
    },
    unhighlight: function (element) {
      $(element).removeClass("error");
      if ($(element).attr("name") == "file_attach_cv") {
        $(element).siblings(".span-click").removeClass("error");
        $(".th_bao").hide();
      }
    },
    submitHandler: function (e) {
      // e.preventDefault();
      $("#contact_form_cv").ajaxSubmit({
        success: function (responseText, statusText, xhr, $form) {
          var json_data = $.parseJSON(responseText);
          if (json_data) {
            if (json_data.get_cv == "success") {
              setTimeout(function () {
                $(".show_popup_cv").removeClass("show");
                $(".show_popup").removeClass("show");
                $(".show_popup_cv").removeAttr("style");
                $(".show_popup").removeAttr("style");
              }, 300);
            } else {
              $("#dinhkem").val("0");
              $(".popup-vnw").removeClass("fade");
            }
          }
        },
      });
      //return false;
    },
  });
  $("#dinhkem").on("change", function () {
    var dinhkem_value = $(this).val();
    $(".file_attach").removeAttr("required");
    $("#linkedin_id").removeAttr("required");
    $(".tk_vnw").removeAttr("required");
    if (dinhkem_value == 1) {
      $(".file_attach").attr("required", true);
      $(".upfile").addClass("d-block");
      $(".conn-linke").removeClass("d-block");
      $(".submit-form").css({ top: "-22px" });
      if ($(window).width() <= 991) {
        $(".fixw_apply").css({ "padding-bottom": "22px" });
        $(".submit-form").css({ "padding-bottom": "0px" });
      }
    } else if (dinhkem_value == 2) {
      $("#linkedin_id").attr("required", true);
      var url = root + "auth/linkedin";
      window.open(url);
      $(".conn-linke").addClass("d-block");
      $(".upfile").removeClass("d-block");
      $(".submit-form").css({ top: "-22px" });
      if ($(window).width() <= 991) {
        $(".fixw_apply").css({ "padding-bottom": "22px" });
        $(".submit-form").css({ "padding-bottom": "0px" });
      }
    } else if (dinhkem_value == 3) {
      $(".tk_vnw").attr("required", true);
      $(".upfile").removeClass("d-block");
      $(".conn-linke").removeClass("d-block");
      $(".show_popup").slideDown().addClass("show");
      $(".submit-form").css({ top: "20px" });
      if ($(window).width() <= 991) {
        $(".submit-form").css({ "padding-bottom": "30px" });
      }
    }
  });
  $("#experience").on("change", function () {
    var experience_other = $(this).val();
    $("input[name=experience_other]").val("");

    if (experience_other == "trên 2 năm") {
      $(".experience_other").addClass("d-block");
      $(".experience_other").removeClass("d-none");
    } else {
      $(".experience_other").removeClass("d-block");
      $(".experience_other").addClass("d-none");
    }
  });

  $("#experience_leader").on("change", function () {
    var experience_leader_other = $(this).val();
    $("input[name=experience_leader_other]").val("");

    if (experience_leader_other == "trên 1 năm") {
      $(".experience_leader_other").addClass("d-block");
      $(".experience_leader_other").removeClass("d-none");
    } else {
      $(".experience_leader_other").removeClass("d-block");
      $(".experience_leader_other").addClass("d-none");
    }
  });

  $(".close_vnw").click(function () {
    $(".show_popup").slideUp("slow").removeClass("show");
    $("#dinhkem").val("0");
  });
  $(".fix_close").click(function () {
    $(".show_popup_cv").slideUp("slow").removeClass("show");
  });
  $("#featured-3").click(function () {
    if ($(this).prop("checked") == true) {
      $(".input-file-nop-cv").removeAttr("disabled");
    }
  });
  $("#featured-1, #featured-2").click(function () {
    $(".input-file-nop-cv").prop("disabled", true);
  });
  $(".span-click").click(function () {
    $(".input-file-nop").click();
  });
  $('[name="file_attach"]').bind("change", function () {
    var a = $('[name="file_attach"]').val();
    console.log(a);
    // a = a.split("&#92;");
    a = a.split("\\");
    console.log(a);
    a = a[a.length - 1];
    console.log(a);
    $(".input-file-reply").html(a);
    $("#resume-input").attr("placeholder", "Đã đính kèm " + a);
    if ($(".input-file-nop").attr("name") == "file_attach") {
      $(".input-file-nop")
        .siblings(".span-click")
        .removeClass("has-error")
        .addClass("has-success");
    }
  });
  $("#login").click(function (e) {
    var email = $("#email").val();
    var password = $("#password").val();
    // Checking for blank fields.
    if (email == "" || password == "") {
      $('input[type="email"],input[type="password"]').css(
        "border",
        "2px solid red"
      );
      $('input[type="email"],input[type="password"]').css(
        "box-shadow",
        "0 0 3px red"
      );
      // alert("Please fill all fields...!!!!!!");
      $(".help-text").css("display", "block");
      e.preventDefault();
    } else {
      $('input[type="email"],input[type="password"]').css("border", "none");
      $('input[type="email"],input[type="password"]').css("box-shadow", "none");
      // show_popup();
      $.post(
        "template.php",
        {
          email1: email,
          password1: password,
        },
        function (data) {
          //     if(data=='Invalid Email.......') {
          // $('input[type="email"]').css({"border":"2px solid red","box-shadow":"0 0 3px
          // red"});     $('input[type="password"]').css({"border":"2px solid
          // #00F5FF","box-shadow":"0 0 5px #00F5FF"});     alert(data); }else
          // if(data=='Email or Password is wrong...!!!!'){
          // $('input[type="email"],input[type="password"]').css({"border":"2px solid
          // red","box-shadow":"0 0 3px red"});     alert(data); } else
          // if(data=='Successfully Logged in...'){     $("form")[0].reset();
          // $('input[type="email"],input[type="password"]').css({"border":"2px solid
          // #00F5FF","box-shadow":"0 0 5px #00F5FF"});     alert(data); } else{
          // alert(data); }
        }
      );
    }
  });
});
// $(window).on("load resize", function () {});
// window.CallParent = function (accessToken, type) {
//   if (type == 1) {
//     if (!$("#facebook_accesstoken").val(accessToken)) {
//       $(".login_error").addClass("d-block").text("Login không thành công");
//     } else {
//       $(".show_popup_cv").slideDown().addClass("show");
//       $(".login_error")
//         .removeClass("d-block")
//         .text("Username hoặc password không hợp lệ");
//     }
//   }
//   if (type == 2) {
//     if (!$("#google_accesstoken").val(accessToken)) {
//       $(".login_error").addClass("d-block").text("Login không thành công");
//     } else {
//       $(".show_popup_cv").slideDown().addClass("show");
//       $(".login_error")
//         .removeClass("d-block")
//         .text("Username hoặc password không hợp lệ");
//     }
//   }
//   if (type == 3) {
//     if ($("#linkedin_id").val(accessToken)) {
//       $(".loadersmall").addClass("d-none");
//       $(".checkld_tc").addClass("d-block");
//       $(".checkld_tb").removeClass("d-block");
//       $(".change_error")
//         .addClass("text_error")
//         .text("Connect LinkedIn thành công...");
//     } else {
//       $(".loadersmall").addClass("d-none");
//       $(".checkld_tb").addClass("d-block");
//       $(".checkld_tc").removeClass("d-block");
//       $(".change_error")
//         .addClass("text_error")
//         .text("Vui lòng Connect LinkedIn...tại đây");
//     }
//   }
// };

$(document).ready(function (e) {
  $(".click_vnw").click(function () {
    $(".show_popup").slideDown().addClass("show");
  });
  $(".click_vnw").click(function () {
    $("#dinhkem").val(3);
  });
  // var dinhkem_value = $(this).val();
  $(".file_attach").attr("required", true);

  // Slick slider
  if ($(".main__slider").length) {
    $(".main__slider").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: true,
      autoplay: true,
      autoplaySpeed: 3000,
      speed: 2000,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            arrows: false,
            dots: false,
          },
        },
      ],
    });
  }
  if ($(".main__slider_mobile").length) {
    $(".main__slider_mobile").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: true,
      autoplay: true,
      autoplaySpeed: 3000,
      speed: 2000,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            arrows: false,
            dots: false,
          },
        },
      ],
    });
  }

  var noInfo = '<p style="color: #777777">Chưa có thông tin</p>';

  // if ($(".urban-slider").length && $(".urban-slider").children().length > 0) {
  //   $(".urban-slider").slick({
  //     infinite: false,
  //     slidesToShow: 4,
  //     slidesToScroll: 2,
  //     rows: 2,
  //     arrows: true,
  //     dots: false,
  //     responsive: [
  //       {
  //         breakpoint: 991,
  //         settings: {
  //           arrows: false,
  //           dots: true,
  //           customPaging: function (slider, i) {
  //             var title = $(slider.$slides[i]).data("title");
  //             return (
  //               '<a class="pager__item"> 0' +
  //               (i + 1) +
  //               ".<br/>" +
  //               '<span class="bold">' +
  //               title +
  //               "</span>" +
  //               " </a>"
  //             );
  //           },
  //         },
  //       },
  //     ],
  //   });
  //   $('a#nav-urban-tab[data-toggle="tab"]').on("shown.bs.tab", function (e) {
  //     $(".urban-slider").slick("setPosition");
  //   });
  // } else {
  //   $(".urban-slider").html(noInfo);
  // }

  // if (
  //   $(".residential-slider").length &&
  //   $(".residential-slider").children().length > 0
  // ) {
  //   $(".residential-slider").slick({
  //     infinite: false,
  //     slidesToShow: 4,
  //     slidesToScroll: 2,
  //     rows: 2,
  //     arrows: true,
  //     dots: false,
  //   });
  //   $('a#nav-residential-tab[data-toggle="tab"]').on("shown.bs.tab", function (
  //     e
  //   ) {
  //     $(".residential-slider").slick("setPosition");
  //   });
  // } else {
  //   $(".residential-slider").html(noInfo);
  // }

  // if ($(".public-slider").length && $(".public-slider").children().length > 0) {
  //   $(".public-slider").slick({
  //     infinite: false,
  //     slidesToShow: 4,
  //     slidesToScroll: 2,
  //     rows: 2,
  //     arrows: true,
  //     dots: false,
  //   });
  //   $('a#nav-public-tab[data-toggle="tab"]').on("shown.bs.tab", function (e) {
  //     $(".public-slider").slick("setPosition");
  //   });
  // } else {
  //   $(".public-slider").html(noInfo);
  // }

  // if ($(".local-slider").length && $(".local-slider").children().length > 0) {
  //   $(".local-slider").slick({
  //     infinite: false,
  //     slidesToShow: 4,
  //     slidesToScroll: 2,
  //     rows: 2,
  //     arrows: true,
  //     dots: false,
  //   });
  //   $('a#nav-local-tab[data-toggle="tab"]').on("shown.bs.tab", function (e) {
  //     $(".local-slider").slick("setPosition");
  //   });
  // } else {
  //   $(".local-slider").html(noInfo);
  // }

  // if (
  //   $(".industrial-slider").length &&
  //   $(".industrial-slider").children().length > 0
  // ) {
  //   $(".industrial-slider").slick({
  //     infinite: false,
  //     slidesToShow: 4,
  //     slidesToScroll: 2,
  //     rows: 2,
  //     arrows: true,
  //     dots: false,
  //   });
  //   $('a#nav-industrial-tab[data-toggle="tab"]').on("shown.bs.tab", function (
  //     e
  //   ) {
  //     $(".industrial-slider").slick("setPosition");
  //   });
  // } else {
  //   $(".industrial-slider").html(noInfo);
  // }

  // if ($(".team-slider").length && $(".team-slider").children().length > 0) {
  //   $(".team-slider").slick({
  //     infinite: false,
  //     slidesToShow: 3,
  //     slidesToScroll: 1,
  //     infinite: true,
  //     arrows: true,
  //     dots: true,
  //   });
  //   $('a#nav-team-tab[data-toggle="tab"]').on("shown.bs.tab", function (e) {
  //     $(".team-slider").slick("setPosition");
  //   });
  // } else {
  //   $(".team-slider").html(noInfo);
  // }

  // if ($(".reward-slider").length && $(".reward-slider").children().length > 0) {
  //   $(".reward-slider").slick({
  //     infinite: false,
  //     slidesToShow: 3,
  //     slidesToScroll: 1,
  //     infinite: true,
  //     arrows: true,
  //     dots: true,
  //   });
  //   $('a#nav-reward-tab[data-toggle="tab"]').on("shown.bs.tab", function (e) {
  //     $(".reward-slider").slick("setPosition");
  //   });
  // } else {
  //   $(".reward-slider").html(noInfo);
  // }

  // if ($(".tab-slider").length && $(".tab-slider").children().length > 0) {
  //   $(".tab-slider").slick({
  //     infinite: false,
  //     slidesToShow: 3,
  //     slidesToScroll: 1,
  //     infinite: true,
  //     arrows: true,
  //     dots: true,
  //   });
  //   $('a#nav-blog-tab[data-toggle="tab"]').on("shown.bs.tab", function (e) {
  //     $(".tab-slider").slick("setPosition");
  //   });
  // } else {
  //   $(".team-slider").html(noInfo);
  // }

  if (
    $(".project-slider").length &&
    $(".project-slider").children().length > 0
  ) {
    $(".project-slider").slick({
      infinite: true,
      autoplay: true,
      autoplaySpeed: 4000,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: true,
      fade: true,
      cssEase: "linear",
    });
  }

  if (
    $(".related-slider").length &&
    $(".related-slider").children().length > 0
  ) {
    $(".related-slider").slick({
      infinite: true,
      autoplay: true,
      autoplaySpeed: 4000,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      responsive: [
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 400,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  }

  if ($(".menu__container").length) {
    // console.log('Run');
    // const menuOffset = $(".menu__container").offset().top;
    menuOffset = 156;
    if ($(window).width() >= 992) {
      if ($(window).scrollTop() > menuOffset) {
        $(".menu__container").addClass("fixed-top");
        $("#logo-vnw").removeClass("d-flex");
        $("#logo-vnw").addClass("d-none");
      } else {
        $(".menu__container").removeClass("fixed-top");
        $("#logo-vnw").addClass("d-flex");
        $("#logo-vnw").removeClass("d-none");
      }

      $(window).on("scroll", function () {
        if ($(window).scrollTop() > menuOffset) {
          $(".menu__container").addClass("fixed-top");
          $("#logo-vnw").removeClass("d-flex");
          $("#logo-vnw").addClass("d-none");
        } else {
          $(".menu__container").removeClass("fixed-top");
          $("#logo-vnw").addClass("d-flex");
          $("#logo-vnw").removeClass("d-none");
        }
      });
    } else {
      if ($(window).scrollTop() > 0) {
        $(".menu__container").addClass("fixed-top");
      } else {
        $(".menu__container").removeClass("fixed-top");
      }

      $(window).on("scroll", function () {
        if ($(window).scrollTop() > 0) {
          $(".menu__container").addClass("fixed-top");
        } else {
          $(".menu__container").removeClass("fixed-top");
        }
      });
    }
  }
});

// window.CallParent = function (accessToken, type) {
//   if (type == 1) {
//     if (!$("#facebook_accesstoken").val(accessToken)) {
//       $(".login_error").addClass("d-block").text("Login không thành công");
//     } else {
//       $(".show_popup_cv").slideDown().addClass("show");
//       $(".login_error")
//         .removeClass("d-block")
//         .text("Username hoặc password không hợp lệ");
//     }
//   }
//   if (type == 2) {
//     if (!$("#google_accesstoken").val(accessToken)) {
//       $(".login_error").addClass("d-block").text("Login không thành công");
//     } else {
//       $(".show_popup_cv").slideDown().addClass("show");
//       $(".login_error")
//         .removeClass("d-block")
//         .text("Username hoặc password không hợp lệ");
//     }
//   }
//   if (type == 3) {
//     if ($("#linkedin_id").val(accessToken)) {
//       $(".loadersmall").addClass("d-none");
//       $(".checkld_tc").addClass("d-block");
//       $(".checkld_tb").removeClass("d-block");
//       $(".input-file-reply")
//         .addClass("text_error")
//         .text("Connect LinkedIn thành công...");
//       $(".file_attach").removeAttr("required");
//       $(".form-group.upfile").removeClass("error_up");
//       $("#dinhkem").val(2);
//     } else {
//       $(".loadersmall").addClass("d-none");
//       $(".checkld_tb").addClass("d-block");
//       $(".checkld_tc").removeClass("d-block");
//       $(".input-file-reply")
//         .addClass("text_error")
//         .text("Vui lòng Connect LinkedIn...");
//     }
//   }
// };

$(document).ready(function (e) {
  $("#hamburger-menu").click(function () {
    var flag = $("#collapsibleNavbar").hasClass("show");
    if (flag === false) {
      $(this).addClass("is-active");
    } else if (flag === true) {
      $(this).removeClass("is-active");
    }
  });
  $("#hamburger-menu-modal").click(function () {
    var flag = $("#navbarSupportedContent").hasClass("show");
    if (flag === false) {
      $(this).addClass("is-active");
      setMargin();
    } else if (flag === true) {
      $(this).removeClass("is-active");
      setMargin();
    }
  });
});

function setMargin() {
  console.log("setMargin", $(".menu-alinco-modal"));
  if ($(".menu-alinco-modal").length > 0) {
    var windowHeight = $(window).height();
    console.log("setMargin -> windowHeight", windowHeight);
    var menuHeight = 230;
    console.log("setMargin -> menuHeight", menuHeight);
    // var menuHeight = $(".menu-alinco-modal").height() + 20;
    // console.log("setMargin -> menuHeight", menuHeight);
    var tabOffset = $(".tab-content").offset().top;
    var tabHeight = $(".tab-content").height();
    console.log("setMargin -> tabOffset", tabOffset);
    console.log("setMargin -> tabHeight", tabHeight);
    if (tabOffset < menuHeight) {
      $(".tab-content").css(
        "margin-top",
        windowHeight / 2 > menuHeight
          ? -windowHeight + tabHeight + (menuHeight + 10) * 2
          : -windowHeight +
              tabHeight +
              (menuHeight + 10) * 2 -
              (menuHeight - windowHeight / 2) * 2
      );
    } else {
      $(".tab-content").css("margin-top", 0);
    }
  }
}

jQuery(document).ready(function () {
  $(document).click(function (event) {
    var _navbarModalOpened = $(".navbar-collapse-modal").hasClass("show");
    var navbarModalClickover = $(event.target);
    if (
      _navbarModalOpened === true &&
      !navbarModalClickover.hasClass("navbar-toggler")
    ) {
      $("#hamburger-menu-modal").click();
    }
  });
  // $(".nav-link").click(function () {
  //   var _opened = $(".navbar-collapse-modal").hasClass("show");
  //   if (_opened === true) {
  //     $("#hamburger-menu").click();
  //   }
  // });
});