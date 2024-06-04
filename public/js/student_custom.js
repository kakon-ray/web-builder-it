//student registation password show
$(document).ready(function () {
  
  const student_password = document.querySelector("#student_password")
  const student_password_confirm = document.querySelector("#student_password_confirm")
  const eye = document.querySelector("#eye")
  const confirm_password_eye = document.querySelector("#confirm_password_eye")

  eye.addEventListener("click", function () {
    this.classList.toggle("fa-eye-slash")
    const type = student_password.getAttribute("type") === "password" ? "text" : "password"
    student_password.setAttribute("type", type)
  })
  confirm_password_eye.addEventListener("click", function () {
    this.classList.toggle("fa-eye-slash")
    const type = student_password_confirm.getAttribute("type") === "password" ? "text" : "password"
    student_password_confirm.setAttribute("type", type)
  })



})


//student login password show
$(document).ready(function () {
  // student login password show
  const student_login_password = document.querySelector("#student_login_password")
  const confirm_login_eye = document.querySelector("#confirm_login_eye")

  confirm_login_eye.addEventListener("click", function () {
    this.classList.toggle("fa-eye-slash")
    const type = student_login_password.getAttribute("type") === "password" ? "text" : "password"
    student_login_password.setAttribute("type", type)
  })



})




// ajax alert

$(document).ready(function () {

  $("#student_logout").click(function (event) {
    event.preventDefault();

    axios
      .post("/student/logout")
      .then(function (response) {

        if (response.status == 200 && response.data == 1) {
          $.notification(
            ["Logout in Your Account"],
            {
              position: ['bottom', 'right'],
              messageType: 'success',
            }
          )
          setTimeout(function () {
            location.reload();
          }, 1500);


        } else {
          $.notification(
            ["Already Logout"],
            {
              position: ['bottom', 'right'],
              messageType: 'error',
            }
          )

        }


      })
      .catch(function (error) {
        $.notification(
          [error.message],
          {
            position: ['bottom', 'right'],
            messageType: 'error',
          }
        )

      });
  })


  // student registation alert custome js
  $('body').on('submit', '#studentregistationalert', function (e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr('action'),
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data.status == 200) {
          Swal.fire({
            icon: "success",
            title: data.msg,
            timer: 1500,
            customClass: 'swalstyle',
            showConfirmButton: false,
          });
          setTimeout(function () {
            window.location.href = 'login';
          }, 1500);


        } else {
          Swal.fire({
            icon: "error",
            title: data.msg,
            timer: 2000,
            customClass: 'swalstyle',
            showConfirmButton: false,
          });
        }
      }
    })
  })

  // student login alert

  $('body').on('submit', '#studentloginsubmit', function (e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr('action'),
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data.status == 200) {
          Swal.fire({
            icon: "success",
            title: data.msg,
            timer: 1500,
            customClass: 'swalstyle',
            showConfirmButton: false,
          });
          setTimeout(function () {
            window.location.href = 'profile';
          }, 1500);

        } else {
          Swal.fire({
            icon: "error",
            title: "Login Faild",
            text: data.msg,
            timer: 1500,
            customClass: 'swalstyle',
            showConfirmButton: false,
          });
        }
      }
    })
  })
  // student add course alert

  $('body').on('submit', '#studentprofileupdate', function (e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr('action'),
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data.status == 200) {
          $.notification(
            [data.msg],
            {
              position: ['bottom', 'right'],
              messageType: 'success',
            }
          )
          setTimeout(function () {
            location.reload()
          }, 1500);
       


        } else {
          $.notification(
            [data.msg],
            {
              position: ['bottom', 'right'],
              messageType: 'error',
            }
          )
        }
      }
    })
  })

  $('body').on('submit', '#activecoursealert', function (e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr('action'),
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data.status == 200) {
          Swal.fire({
            icon: "success",
            title: data.msg,
            timer: 1500,
            customClass: 'swalstyle',
            showConfirmButton: false,
          });
          setTimeout(function () {
            location.href = '/student/wishlist';
          }, 1500);

        } else {
          Swal.fire({
            icon: "error",
            title: data.msg,
            timer: 1500,
            customClass: 'swalstyle',
            showConfirmButton: false,
          });

          setTimeout(function () {
            location.href = '/student/wishlist';
          }, 1000);
        }
      }
    })
  })

  $('body').on('submit', '#manualpementalert', function (e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr('action'),
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data.status == 200) {
          $.notification(
            [data.msg],
            {
              position: ['bottom', 'right'],
              messageType: 'success',
            }
          )
          setTimeout(function () {
            location.href = '/student/my-order';
          }, 1500);


        } else {
          
          $.notification(
            [data.msg],
            {
              position: ['bottom', 'right'],
              messageType: 'error',
            }
          )

        }
      }
    })
  })
  $('body').on('submit', '#review_alert', function (e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr('action'),
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data.status == 200) {
          $.notification(
            [data.msg],
            {
              position: ['bottom', 'right'],
              messageType: 'success',
            }
          )
          setTimeout(function () {
            location.reload();
          }, 1500);


        } else {
          $.notification(
            [data.msg],
            {
              position: ['bottom', 'right'],
              messageType: 'error',
            }
          )
          setTimeout(function () {
            location.reload();
          }, 1500);

        }
      }
    })
  })


})



// modal item show video tutorial

$(document).ready(function () {

  $(".googlecloudvideo").click(    
    function(e) {
      let video_link =  $(this).data("video_link");

      $('#google_video_set').prop('src',video_link);
     console.log(video_link)
 });
  $(".youtubevideo").click(    
    function(e) {
      let video_link =  $(this).data("video_link");

      $('#youtube_video_set').prop('src',video_link);
     console.log(video_link)
 });
})

// star rating jquery
$(document).ready(function () {
  
  $("#rateBox").rate({
    length: 5,
    value: 5,
    readonly: false,
    size: '48px',
    selectClass: 'fxss_rate_select',
    incompleteClass: 'fxss_rate_no_all_select',
    customClass: 'custom_class',
    callback: function(object){
      $('#ratevalue').val(object.index); 
    }
  });




})


//chackout page toggle button show

$(document).ready(function () {
  $('.digital').hide()
  $('.manualcard').css("background-color", "#cec0c0");
  $('input[type="radio"]').click(function () {
    var selected = $("input[name='checkout']:checked").val();
    if (selected == 'digital') {
      $('.digital').show()
      $('.digitalcard').css("background-color", "#cec0c0");
      $('.manualcard').css("background-color", "white");
      $('.manual').hide()
    }
    if (selected == 'manual') {
      $('.digital').hide()
      $('.manual').show()
      $('.manualcard').css("background-color", "#cec0c0");
      $('.digitalcard').css("background-color", "white");

    }

  });
});

// profile page show and hiddin button
$(document).ready(function () {
  
$("#overview_content").show();
$("#profile_form").hide();

$("#show_overview").click(function () {
  $("#overview_content").show();
  $("#profile_form").hide();
});

$("#show_form").click(function () {
  $("#profile_form").show();
  $("#overview_content").hide();
});

})




// password change show password
$(document).ready(function(){
  
  $('#showPassChange').on('click', function(){

     var passInput=$(".show_passwod_change");

     if(passInput.attr('type')==='password')
       {
         passInput.attr('type','text');
     }else{
        passInput.attr('type','password');
     }

 })


})


// Scroll to top button appear

$(document).ready(function () {

  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $(".scroll-back-top").css({"bottom": "50px"});
    } else if(scrollDistance < 100){
      $(".scroll-back-top").css({"bottom": "-100px"});
    }
  });
  
  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-back-top', function (e) {
    document.documentElement.scrollTop = 0;
    e.preventDefault();
  });

})