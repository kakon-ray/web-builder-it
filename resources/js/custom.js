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


// course admission and services admission
$(document).ready(function(){


// form submit work
$("#course_admission").click(function (event) {
  event.preventDefault();

  var name_course = $("#name_course").val() ? $("#name_course").val() : false;
  var phone_course = $("#phone_course").val() ? $("#phone_course").val() : false;
  var course_name = $("#course_name").find(':selected').val();
  var message_course = $("#message_course").val() ? $("#message_course").val() : false;


  // validation error messgage show select

  if (phone_course == false) {
      $("#phone_lebel").text("*Fill in Name input fields").css("color", "red");

      Swal.fire({
          icon: "error",
          title: "Input field is empty",
          text: "Fill in the Phone input field",
      });

      return 0;
  } else {
      $("#phone_lebel").text("Mobile Number").css("color", "black");
  }

 
  axios
      .post("/submit.course", {
        name_course: name_course,
        phone_course: phone_course,
        course_name: course_name,
        message_course: message_course,
      })
      .then(function (response) {

        if(response.status == 200 && response.data == 1){
          Swal.fire({
            icon: "success",
            title: "Successfully Add Student Information",
            text: "Fill in the Due Amount input field",
          });
    
        }
         
      })
      .catch(function (error) {
          Swal.fire({
              position: "top-center",
              icon: "error",
              title: "Your form submission is not complete",
              showConfirmButton: false,
              timer: 1500,
          });
      });
});

$("#services_admission").click(function (event) {
  event.preventDefault();

  var name_services = $("#name_services").val() ? $("#name_services").val() : false;
  var phone_number_services = $("#phone_number_services").val() ? $("#phone_number_services").val() : false;
  var course_name_services = $("#course_name_services").find(':selected').val();
  var message_services = $("#message_services").val() ? $("#message_services").val() : false;



  // validation error messgage show select

  if (phone_number_services == false) {
      $("#phone_serives_lebel").text("*Fill in Name input fields").css("color", "red");

      Swal.fire({
          icon: "error",
          title: "Input field is empty",
          text: "Fill in the Phone input field",
      });

      return 0;
  } else {
      $("#phone_serives_lebel").text("Mobile Number").css("color", "black");
  }

 
  axios
      .post("/submit-services-admission", {
        name_services: name_services,
        phone_number_services: phone_number_services,
        course_name_services: course_name_services,
        message_services: message_services,
      })
      .then(function (response) {

        if(response.status == 200 && response.data == 1){
          Swal.fire({
            icon: "success",
            title: "Successfully Add Student Information",
            text: "Fill in the Due Amount input field",
          });
    
        }
         
      })
      .catch(function (error) {
          Swal.fire({
              position: "top-center",
              icon: "error",
              title: "Your form submission is not complete",
              showConfirmButton: false,
              timer: 1500,
          });
      });
});

});


// admin auth

$(document).ready(function(){
  $("#registation").click(function (event) {
    event.preventDefault();
  
    var admin_name = $("#admin_name").val() ? $("#admin_name").val() : false;
    var admin_email = $("#admin_email").val() ? $("#admin_email").val() : false;
    var admin_password = $("#admin_password").val() ? $("#admin_password").val() : false;
    var admin_password_confirm = $("#admin_password_confirm").val() ? $("#admin_password_confirm").val() : false;
    
    // validation error messgage show select
  
    if (admin_name == false) {
      
        Swal.fire({
            icon: "error",
            title: "Input field is empty",
            text: "Fill in the Name input field",
        });
  
        return 0;
    } 
    if (admin_email == false) {
      
        Swal.fire({
            icon: "error",
            title: "Input field is empty",
            text: "Fill in the Email input field",
        });
  
        return 0;
    } 
    if (admin_password == false) {
      
        Swal.fire({
            icon: "error",
            title: "Input field is empty",
            text: "Fill in the Admin Password input field",
        });
  
        return 0;
    } 
    if (admin_password_confirm == false) {
      
        Swal.fire({
            icon: "error",
            title: "Input field is empty",
            text: "Fill in the Admin Confirm Password input field",
        });
  
        return 0;
    } 

    if(admin_password != admin_password_confirm){
      Swal.fire({
        icon: "error",
        title: "Two password is not match",
        text: "Two password is not match",
    });

    return 0;
    }
  
   
    axios
        .post("/admin-registaion", {
          admin_name: admin_name,
          admin_email: admin_email,
          admin_password: admin_password,
        })
        .then(function (response) {
  
          if(response.status == 200 && response.data == 1){
            Swal.fire({
              icon: "success",
              title: "Registation Completed",
              text: "Thanks",
            });
            
            window.location.href = '/admin';
          }else{
            Swal.fire({
              icon: "error",
              title: "Registaion Faild",
              text: response.data,
            });
          }


           
        })
        .catch(function (error) {
            Swal.fire({
                position: "top-center",
                icon: "error",
                title: "Your form submission is not complete",
                showConfirmButton: false,
                timer: 1500,
            });
        });
  });

  $("#login").click(function (event) {
    event.preventDefault();
  
    var admin_email_login = $("#admin_email_login").val() ? $("#admin_email_login").val() : false;
    var admin_password_login = $("#admin_password_login").val() ? $("#admin_password_login").val() : false;
       
    axios
        .post("/admin/login", {
          admin_email_login: admin_email_login,
          admin_password_login: admin_password_login,
        })
        .then(function (response) {
  
          if(response.status == 200 && response.data == 1){
            Swal.fire({
              icon: "success",
              title: "Login Success Completed",
              text: "Thanks",
              timer: 1500,
            });
            
            window.location.href = '/dashboard-admission';
          }else{
            Swal.fire({
              icon: "error",
              title: "Login Faild",
              text: "Please try again",
              timer: 1500,
            });
          }


           
        })
        .catch(function (error) {
            Swal.fire({
                position: "top-center",
                icon: "error",
                title: "Your form submission is not complete",
                showConfirmButton: false,
                timer: 1500,
            });
        });
  });

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
            });

            location.reload();
        
          }

           
        })
        .catch(function (error) {
            Swal.fire({
                position: "top-center",
                icon: "error",
                title: "Server Error",
                showConfirmButton: false,
                timer: 1500,
            });
        });
  })
})


// image show 

$(document).ready(function(){
  
  $("#course_img").change(function () {
    var reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload = function (event) {
        var ImgSource = event.target.result;
        $("#add_course_image_show").attr("src", ImgSource);
    };
});
  $("#edit_course_img").change(function () {
    var reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload = function (event) {
        var ImgSource = event.target.result;
        $("#edit_course_image_show").attr("src", ImgSource);
    };
});
  $("#services_img").change(function () {
    var reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload = function (event) {
        var ImgSource = event.target.result;
        $("#add_services_image_show").attr("src", ImgSource);
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

     var passInput=$("#admin_password");
     if(passInput.attr('type')==='password')
       {
         passInput.attr('type','text');
     }else{
        passInput.attr('type','password');
     }

 })
  $('#showPassConfirm').on('click', function(){

     var passInput=$("#admin_password_confirm");
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

// admission form 

$(document).ready(function(){
  $("#admission_confirm").click(function (event) {
    event.preventDefault();
  
    var admission_student_name = $("#admission_student_name").val() ? $("#admission_student_name").val() : false;
    var admission_student_father_name = $("#admission_student_father_name").val() ? $("#admission_student_father_name").val() : false;
    var admission_student_mother_name = $("#admission_student_mother_name").val() ? $("#admission_student_mother_name").val() : false;
    var admission_student_address = $("#admission_student_address").val() ? $("#admission_student_address").val() : false;
    var admission_student_phonenumber = $("#admission_student_phonenumber").val() ? $("#admission_student_phonenumber").val() : false;
    var admission_course_fee = $("#admission_course_fee").val() ? $("#admission_course_fee").val() : false;
    var admission_student_bikash_number = $("#admission_student_bikash_number").val() ? $("#admission_student_bikash_number").val() : false;
    var admission_student_bikash_tranxid = $("#admission_student_bikash_tranxid").val() ? $("#admission_student_bikash_tranxid").val() : false;
    var admission_course_name = $("#admission_course_name").find(':selected').val();
    var admission_student_email_number = $("#admission_student_email_number").val() ? $("#admission_student_email_number").val() : false;


    if (admission_student_name == false) {
      $("#name_lebel1").text("*Fill in Name input fields").css("color", "red");

      Swal.fire({
          icon: "error",
          title: "Input field is empty",
          text: "Fill in Name input fields",
      });

      return 0;
    } else {
        $("#name_lebel1").text("Name").css("color", "black");
    }

    if (admission_student_phonenumber == false) {
      $("#phone_number_lebel1").text("*Fill in Phone Number input fields").css("color", "red");

      Swal.fire({
          icon: "error",
          title: "Input field is empty",
          text: "Fill in the Phone input field",
      });

      return 0;
    } else {
        $("#phone_number_lebel1").text("Fill in Phone Number input fields").css("color", "black");
    }


    if (admission_course_fee == false) {
      $("#course_fee_lebel").text("*Fill in Course Fee input fields").css("color", "red");

      Swal.fire({
          icon: "error",
          title: "Input field is empty",
          text: "Fill in Course Fee input fields",
      });

      return 0;
    } else {
        $("#course_fee_lebel").text("Course Fee").css("color", "black");
    }


    if (admission_student_bikash_number == false) {
      $("#bkash_lebel").text("*Fill in Bkash Number input fields").css("color", "red");

      Swal.fire({
          icon: "error",
          title: "Input field is empty",
          text: "Fill in Bkash Number input fields",
      });

      return 0;
    } else {
        $("#bkash_lebel").text("Bkash Number").css("color", "black");
    }

    if (admission_student_bikash_tranxid == false) {
      $("#transaction_id").text("*Fill in Transaction ID input fields").css("color", "red");

      Swal.fire({
          icon: "error",
          title: "Input field is empty",
          text: "Fill in Transaction ID input fields",
      });

      return 0;
    } else {
        $("#transaction_id").text("Transaction ID").css("color", "black");
    }

    if (admission_student_email_number == false) {
      $("#email_lebel").text("*Fill in Email Number input fields").css("color", "red");

      Swal.fire({
          icon: "error",
          title: "Input field is empty",
          text: "Fill in Email Number input fields",
      });

      return 0;
    } else {
        $("#email_lebel").text("Transaction ID").css("color", "black");
    }

    axios
        .post("/admission-submit", {
          admission_student_name: admission_student_name,
          admission_student_father_name: admission_student_father_name,
          admission_student_mother_name: admission_student_mother_name,
          admission_student_address: admission_student_address,
          admission_student_phonenumber: admission_student_phonenumber,
          admission_course_fee: admission_course_fee,
          admission_student_bikash_number: admission_student_bikash_number,
          admission_student_bikash_tranxid: admission_student_bikash_tranxid,
          admission_course_name: admission_course_name,
          admission_student_email_number: admission_student_email_number,

        })
        .then(function (response) {
  
          if(response.status == 200 && response.data == 1){
            Swal.fire({
              icon: "success",
              title: "Admission Completed",
              text: "Fill in the Due Amount input field",
            });
      
          }else{
            Swal.fire({
              icon: "error",
              title: response.data
             
            });
          }
           
        })
        .catch(function (error) {
            Swal.fire({
                position: "top-center",
                icon: "error",
                title: "Admission is not Completed",
                showConfirmButton: false,
                timer: 1500,
            });
        });
  });
})