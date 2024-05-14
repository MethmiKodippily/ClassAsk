$(document).ready(function() {
    var baseUrl = $('#base').val();

    $.ajax({
        url: baseUrl + 'api/user/status',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.is_logged_in === true) {
                window.location.href = '/';
            } 
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
});

const forms = document.querySelector(".forms"),
      pwShowHide = document.querySelectorAll(".eye-icon"),
      links = document.querySelectorAll(".link");

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
        
        pwFields.forEach(password => {
            if(password.type === "password"){
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        })
        
    })
})      
