(function ($) {
  "use strict";

  

  //   navbar
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 10) {
      $(".forntend-navbar").addClass("is-sticky");
    } else {
      $(".forntend-navbar").removeClass("is-sticky");
    }
  });


  // dropdown
  $(document).ready(function () {
    $("#flip").mouseenter(function () {
      
      $("#panel").slideDown("slow");
    });

    $("#dropdown-container").mouseleave(function () {
      $("#panel").hide();
    });

    $("#flip2").mouseenter(function () {
      $("#panel2").slideDown("slow");
    });

    $("#dropdown-container2").mouseleave(function () {
      $("#panel2").hide();
    });
  });

  $(document).ready(function () {
    $("#VisitorDt").DataTable();
    $(".dataTables_length").addClass("bs-select");
  });

})(jQuery);


// jquery owl carosel 
$(document).ready(function(){
 
  $(function(){
    var gallery = $('.gallery a').simpleLightbox({navText:    ['&lsaquo;','&rsaquo;']});
  });
  $('.owl-carousel').owlCarousel({
    loop:true,
    autoplay:true,
    autoplayTimeout:2000,
    margin:10,
    nav:true,
    /* here you can set the settings for responsive items */
    responsive:{
        0:{
            items:1
        },

        768:{
          items:2
        },

        820:{
            items:3
        },
        1100:{
          items:4
      }
    }
})

});

// image show 

$(document).ready(function(){
  
  
  $("#edit_course_img").change(function () {
    var reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload = function (event) {
        var ImgSource = event.target.result;
        $("#edit_course_image_show").attr("src", ImgSource);
    };
});
 
  $("#edit_services_img").change(function () {
    var reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload = function (event) {
        var ImgSource = event.target.result;
        $("#edit_services_image_show").attr("src", ImgSource);
    };
});
  $("#gallery_img").change(function () {
    var reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload = function (event) {
        var ImgSource = event.target.result;
        $("#gallery_img_show").attr("src", ImgSource);
    };
});
})


// show password
$(document).ready(function(){
  
  $('#showPass').on('click', function(){

     var passInput=$("#password");
     if(passInput.attr('type')==='password')
       {
         passInput.attr('type','text');
     }else{
        passInput.attr('type','password');
     }

 })
  $('#showPassConfirm').on('click', function(){

     var passInput=$("#password_confirmation");
     if(passInput.attr('type')==='password')
       {
         passInput.attr('type','text');
     }else{
        passInput.attr('type','password');
     }

 })

//  login password confirm
  $('#loginPassword').on('click', function(){

     var passInput=$("#admin_password_login");
     if(passInput.attr('type')==='password')
       {
         passInput.attr('type','text');
     }else{
        passInput.attr('type','password');
     }

 })


})


// admin auth

$(document).ready(function(){
   
  $("#admin_logout").click(function(event){
    event.preventDefault();

    axios
        .post("/admin/logout")
        .then(function (response) {
  
          if(response.status == 200 && response.data == 1){
            Swal.fire({
              icon: "success",
              title: "Logout Done",
              text: "Thanks",
              timer: 1500,
              customClass: 'swalstyle',
              showConfirmButton: false
            });

            location.reload();
        
          }

           
        })
        .catch(function (error) {
            Swal.fire({
                position: "top-center",
                icon: "error",
                title: "Server Error",
                customClass: 'swalstyle',
                showConfirmButton: false,
                timer: 1500,
            });
        });
  })
})


 //Admin login submit alert
$(document).ready(function(){
 
  // login alert
    $('body').on('submit','#submitloginform',function(e){
      e.preventDefault();
  
      $.ajax({
      url: $(this).attr('action'),
      method:"POST",
      data: new FormData(this),
      contentType:false,
      cache:false,
      processData: false,
      success: function(data){
          if (data.status == 200) {
             Swal.fire({
              icon: "success",
              title: data.msg,
              text: "Thanks",
              timer: 1500,
              customClass: 'swalstyle',
              showConfirmButton: false
            });
            setTimeout(function() {
              window.location.href = 'dashboard';
          }, 1500);
           
          }else{
            Swal.fire({
              icon: "error",
              title: "Login Faild",
              text: data.msg,
              timer: 1500,
              customClass: 'swalstyle',
              showConfirmButton: false
            });
          }
       }
  })
  })
  // add coruse alert custome js
  $('body').on('submit','#submitcourseadd',function(e){
    e.preventDefault();

    $.ajax({
    url: $(this).attr('action'),
    method:"POST",
    data: new FormData(this),
    contentType:false,
    cache:false,
    processData: false,
    success: function(data){
        if (data.status == 200) {
          $.notification(
            [data.msg],
            {
              position: ['top', 'right'],
              messageType:'success',
              timeView: 3000,
            }
          )

          setTimeout(function () {
            window.location.href = '/admin/manage/course';
          }, 3000);

        }else{
          $.notification(
            [data.msg],
            {
              position: ['top', 'right'],
              messageType:'error',
              timeView: 3000,
            }
          )
        }
     }
})
  })
  // Edit coruse alert custome js
  $('body').on('submit','#editcoursealert',function(e){
    e.preventDefault();

    $.ajax({
    url: $(this).attr('action'),
    method:"POST",
    data: new FormData(this),
    contentType:false,
    cache:false,
    processData: false,
    success: function(data){
      if (data.status == 200) {
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'success',
            timeView: 3000,
          }
        )
        
        setTimeout(function () {
          window.location.href = '/admin/manage/course';
        }, 3000);

      }else{
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'error',
            timeView: 5000,
          }
        )
      }
     }
})
  })

    // add services alert custome js
    $('body').on('submit','#addservicesalert',function(e){
      e.preventDefault();
  
      $.ajax({
      url: $(this).attr('action'),
      method:"POST",
      data: new FormData(this),
      contentType:false,
      cache:false,
      processData: false,
      success: function(data){
        if (data.status == 200) {
          $.notification(
            [data.msg],
            {
              position: ['top', 'right'],
              messageType:'success',
              timeView: 3000,
            }
          )

          setTimeout(function () {
            window.location.href = '/admin/manage/services';
          }, 3000);

        }else{
          $.notification(
            [data.msg],
            {
              position: ['top', 'right'],
              messageType:'error',
              timeView: 5000,
            }
          )
        }
       }
  })
    })

   // edit services alert custome js
   $('body').on('submit','#editservicesalert',function(e){
    e.preventDefault();

    $.ajax({
    url: $(this).attr('action'),
    method:"POST",
    data: new FormData(this),
    contentType:false,
    cache:false,
    processData: false,
    success: function(data){
      if (data.status == 200) {
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'success',
            timeView: 5000,
          }
        )
        setTimeout(function () {
          window.location.href = '/admin/manage/services';
        }, 3000);

      }else{
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'error',
            timeView: 5000,
          }
        )
      }
     }
})
  })
   //add seminer alert custome js
   $('body').on('submit','#addsemineralert',function(e){
    e.preventDefault();

    $.ajax({
    url: $(this).attr('action'),
    method:"POST",
    data: new FormData(this),
    contentType:false,
    cache:false,
    processData: false,
    success: function(data){
      if (data.status == 200) {
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'success',
            timeView: 3000,
          }
        )

        setTimeout(function () {
          window.location.href = '/admin/manage-seminer';
        }, 3000);

      }else{
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'error',
            timeView: 5000,
          }
        )
      }
     }
})
  })
   //add seminer alert custome js
   $('body').on('submit','#editseminer',function(e){
    e.preventDefault();

    $.ajax({
    url: $(this).attr('action'),
    method:"POST",
    data: new FormData(this),
    contentType:false,
    cache:false,
    processData: false,
    success: function(data){
      if (data.status == 200) {
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'success',
            timeView: 3000,
          }
        )

        setTimeout(function () {
          window.location.href = '/admin/manage-seminer';
        }, 3000);

      }else{
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'error',
            timeView: 5000,
          }
        )
      }
     }
})
  })
   //add seminer alert custome js
   $('body').on('submit','#addimagegalleryalert',function(e){
    e.preventDefault();

    $.ajax({
    url: $(this).attr('action'),
    method:"POST",
    data: new FormData(this),
    contentType:false,
    cache:false,
    processData: false,
    success: function(data){
      if (data.status == 200) {
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'success',
            timeView: 5000,
          }
        )

      }else{
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'error',
            timeView: 5000,
          }
        )
      }
     }
})
  })

   //admin pement alert custome js
   $('body').on('submit','#admin_pement_auto_add_alert',function(e){
    e.preventDefault();

    $.ajax({
    url: $(this).attr('action'),
    method:"POST",
    data: new FormData(this),
    contentType:false,
    cache:false,
    processData: false,
    success: function(data){
      if(data.status == 200){
        Swal.fire({
          icon: "success",
          title: data.msg,
          timer: 1500,
          customClass: 'swalstyle',
          showConfirmButton: false
        });
        setTimeout(function() {
          location.reload();
      }, 1500);
        

  }else{
        Swal.fire({
          icon: "error",
          title: data.msg,
          timer: 1500,
          customClass: 'swalstyle',
          showConfirmButton: false
        });
  }
     }
})
  })
     //add tutorial alert custome js
     $('body').on('submit','#addtutorialalert',function(e){
      e.preventDefault();
  
      $.ajax({
      url: $(this).attr('action'),
      method:"POST",
      data: new FormData(this),
      contentType:false,
      cache:false,
      processData: false,
      success: function(data){
        if (data.status == 200) {
          $.notification(
            [data.msg],
            {
              position: ['top', 'right'],
              messageType:'success',
              timeView: 3000,
            }
          )
  
          setTimeout(function() {
            location.reload();
        }, 3000);
  
        }else{
          $.notification(
            [data.msg],
            {
              position: ['top', 'right'],
              messageType:'error',
              timeView: 5000,
            }
          )
        }
       }
  })
    })

   //edit tutorial alert custome js
   $('body').on('submit','#editTutorialControllerAlert',function(e){
    e.preventDefault();

    $.ajax({
    url: $(this).attr('action'),
    method:"POST",
    data: new FormData(this),
    contentType:false,
    cache:false,
    processData: false,
    success: function(data){
      if (data.status == 200) {
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'success',
            timeView: 3000,
          }
        )

        setTimeout(function() {
          location.reload();
      }, 3000);

      }else{
        $.notification(
          [data.msg],
          {
            position: ['top', 'right'],
            messageType:'error',
            timeView: 5000,
          }
        )
      }
     }
})
  })

    //add client review alert custome js
    $('body').on('submit','#addClientReview',function(e){
      e.preventDefault();
  
      $.ajax({
      url: $(this).attr('action'),
      method:"POST",
      data: new FormData(this),
      contentType:false,
      cache:false,
      processData: false,
      success: function(data){
        if (data.status == 200) {
          $.notification(
            [data.msg],
            {
              position: ['top', 'right'],
              messageType:'success',
              timeView: 3000,
            }
          )
  
          setTimeout(function () {
            window.location.href = '/dashboard/review/manage';
          }, 3000);
  
        }else{
          $.notification(
            [data.msg],
            {
              position: ['top', 'right'],
              messageType:'error',
              timeView: 5000,
            }
          )
        }
       }
  })
    })
  
      })


// user alert show

 $(document).ready(function(){
  $('body').on('submit','#courseadmissionalert',function(e){
    e.preventDefault();

    $.ajax({
    url: $(this).attr('action'),
    method:"POST",
    data: new FormData(this),
    contentType:false,
    cache:false,
    processData: false,
    success: function(data){
        if (data.status == 200) {
           Swal.fire({
            icon: "success",
            title: data.msg,
            text: 'Thanks',
            timer: 2000,
            customClass: 'swalstyle',
            showConfirmButton: false
          });

        
        }else{
          Swal.fire({
            icon: "error",
            title: data.msg,
            timer: 2000,
            customClass: 'swalstyle',
            showConfirmButton: false
          });
        }
     }
})
})

  $('body').on('submit','#servicesalert',function(e){
    e.preventDefault();

    $.ajax({
    url: $(this).attr('action'),
    method:"POST",
    data: new FormData(this),
    contentType:false,
    cache:false,
    processData: false,
    success: function(data){
        if (data.status == 200) {
           Swal.fire({
            icon: "success",
            title: data.msg,
            text: 'Thanks',
            timer: 2000,
            customClass: 'swalstyle',
            showConfirmButton: false
          });

        
        }else{
          Swal.fire({
            icon: "error",
            title: data.msg,
            timer: 2000,
            customClass: 'swalstyle',
            showConfirmButton: false
          });
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
