$(document).ready(function() {
    $('.signin').click(function() {
        window.location.href = '/login';
    });

    $('.register').click(function() {
        window.location.href = '/register';
    });

    $('.logout').click(function() {
        window.location.href = '/auth/logout';
    });

    var topSection = new TopSectionView();
    var sideSection = new SideSectionView();
});

var baseUrl = $('#base').val();

var Status = Backbone.Model.extend({
    url: baseUrl + 'api/user/status',
    defaults: {
        is_logged_in: null
    },
});

var SideSectionView = Backbone.View.extend({
    el: '.menu-items',

    initialize: function() {
        this.status = new Status();
        
        this.status.fetch({
            success: this.render.bind(this),
            error: function(model, response) {
                console.error('Error fetching status:', response.statusText);
            }
        });
    },

    render: function() {
        if (this.status.get('is_logged_in')) {
            $('.nav-links li:has(.bx-home)').show();
            $('.nav-links li:has(.bx-user)').show();
            $('.nav-links li:has(.bx-conversation)').show();
        } else {
            $('.nav-links li:has(.bx-home)').show();
            $('.nav-links li:has(.bx-user)').hide();
            $('.nav-links li:has(.bx-conversation)').hide();
        }
        
        return this;
    }
});

var TopSectionView = Backbone.View.extend({
    el: '.auth-box',

    initialize: function() {
        this.status = new Status();
        
        this.status.fetch({
            success: this.render.bind(this),
            error: function(model, response) {
                console.error('Error fetching status:', response.statusText);
            }
        });
    },

    render: function() {
        if (this.status.get('is_logged_in')) {
            $('.signin, .register').hide();
            $('.logout').show();
        } else {
            $('.signin, .register').show();
            $('.logout').hide();
        }
        
        return this;
    }
});

const body = document.querySelector("body"),
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})
