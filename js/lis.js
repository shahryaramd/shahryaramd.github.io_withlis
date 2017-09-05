jQuery(document).ready(function($) {

    if (window.innerWidth > 767) {
    /* 
     * Hover effects for dropdown main menu 
     */
    $('.navbar-nav li.dropdown:not(.open)').hover(function() {
        $(this).find('ul').slideDown();
    }, function() {
        $(this).find('ul').stop().slideDown('slow');
        $(this).find('ul').slideUp();
    }); 

    $('.navbar-nav li.dropdown .open').hover(function() {
        $(this).find('ul').slideDown();
    }, function() {
        $(this).find('ul').stop().slideDown('slow');
        $(this).find('ul').slideUp();
    }); 
    }
    /**
     * Allow list items in main menu to themselves be clickable, and not just sub-links.
     */
    $(".navbar-nav li").click(function() {
        $('.navbar-nav li.open').removeClass('open');
        $(this).find('.dropdown-menu').slideToggle();
        $(this).addClass('open');
    });
    /* 
     * Force Responsive Tables 
     */
    $(".region-content table").addClass("responsive-table");
    $('.region-content table').stacktable({myClass:'reponsive-tbl'});

    /*
     * Allow titles of dropdown menus to act as clickable links.
     */
    $("a.dropdown-toggle").click(function() {
        var link = $(this).attr('href');
        window.location.replace(link);
    });
    /*
     * Switch two-panel layout locations for small mobile devices.
     */
    if (window.innerWidth < 640) {
        if ($(".panel-2col") !== "undefined") {
            switchPanels();
        }
    }
    /*
     * General Function Calls.
     */
    searchToggle();
    checkTestcases();
    responsiveAside();
    socialShare();
    twitterTimelineUpdate();
//  relocateBlocks();
//  styleLatestBlogPosts();
});

/**
 * Switch the DOM position for the two panel columns in small windows/devices.
 */
function switchPanels() 
{
    var panel1 = jQuery(".panel-col-first");
    var panel2 = jQuery(".panel-col-last");

    jQuery(panel2).detach();
    jQuery(".panel-2col").prepend(panel2);
    return false;
}

/** 
 * Custom search box toggle functionality.
 */
function searchToggle()
{
    var searchButton = jQuery("#search-block-form .input-group-btn").first();
    var searchBox    = jQuery("#block-search-form .form-control").first();
    var group        = jQuery(".navbar #block-search-form");

    searchButton.click(function(event) {
        event.preventDefault();
        jQuery(group).toggleClass('open');
        /*jQuery("#block-search-form .form-control").first().toggleClass('displayMe');*/
        jQuery(".region-navigation").toggleClass('open');
        jQuery("#block-search-form .form-control").first().toggleClass('displayMe');
    });

    searchBox.click(function(event) {
        /* if nothing was input */
        if (typeof this.value === "undefined" || 
            this.value == "" || this.value === "Search") {
            jQuery(".input-group-btn").unbind("click");
        }
        /* if the user clicked outside the search area */
        searchBox.blur(function() {
            searchButton.click(function(event) {
                event.preventDefault();
            });
        });
        /* if the user clicked in the input box again */
        searchBox.focus(function() {
            jQuery(".input-group-btn").unbind("click");
        });
    });
    return false;
}

/**
 * Check for Testcase Views
 */
function checkTestcases() 
{
    var tests = ['testcases', 'ldt-testcases', 'lvt-testcases', 'category-tests '];
    
    jQuery(tests).each(function() {
        var pane = "pane-" + this;
        var search = jQuery(".pane-content").find(".view-" + this);
        
        if (search.length > 0) {
            getTestcases();
            setTestcases();
        }
    });
    return false;
}
/**
 * Display the default view item for the given testcase.
 */
function getTestcases() 
{
    jQuery(".panel-col-last .views-row-first").fadeIn('fast').addClass("displayMe");
//    jQuery(".panel-col-last .view-grouping:first-child").fadeIn('fast').addClass('displayMe');

    jQuery(".view-platform-tests .views-row-1 a").addClass("displaying");
    jQuery(".view-ldt-platform-tests .views-row-1 a").addClass("displaying");
    return false;
}
/**
 * Add onclick methods to display a chosen testcase.
 */
function setTestcases() 
{
    jQuery(".pane-platform-tests a").click(function() {
        jQuery(".main-container .displaying").removeClass("displaying");
        jQuery(this).addClass('displaying');

        var link = jQuery(this).attr('href');
        showTestcase(link);
    });

    jQuery(".pane-ldt-platform-tests a").click(function(e) {
        e.preventDefault();
        jQuery(".main-container .displaying").removeClass("displaying");
        jQuery(this).addClass('displaying');
    });
    return false;
}
/**
 * Mark the corresponding menu item for the chosen testcase.
 */
function showTestcase(link) 
{
    jQuery(".main-container .displayMe").removeClass("displayMe").toggle();
//    var progenitor = jQuery(link).parent().parent().parent();
    var progenitor = jQuery(link).parent();

    progenitor.toggle().addClass("displayMe");
   jQuery('html, body').animate({ scrollTop: 0 }, 'fast');
    return false;
}
/**
 * Relocate sidebar/aside with blocks to top of page for mobile devices.
 */
function relocateBlocks() {
    if (window.innerWidth < 769) {
        var aside = jQuery('.region-sidebar-second');
        var content = jQuery('#main-content').parent(); 
        jQuery(aside).insertBefore(content);
        
        var asideBlocks = jQuery('.region-sidebar-second .block');
        switch (asideBlocks.length) {
            case 1:
                var cls='solo-block';
                break;
            case 2:
                var cls='duo-block';
                break;
            case 3:
                var cls='trio-block';
                break;
            default:
                var cls=false;
                break;
        }
        jQuery.each(asideBlocks, function() {
            if (cls) {
                jQuery(this).addClass(cls);
            }
        });
    }
}
/*
 * Responsify the Blocks in Sidebars/Asides.
 */
function responsiveAside() {
    var aside = jQuery('.region-sidebar-second');
    var side  = jQuery('.region-sidebar-first');
}

/**
* Function to pull out the latest blog posts and categorize it
*/
function styleLatestBlogPosts() {

    var rows = "";

    jQuery(".latest-post-blog-post").each(function(){
        grabbed_content = jQuery('<div>').append(jQuery(this).clone()).html();
        rows = rows + grabbed_content;
        jQuery(this).remove();
    });

    jQuery("#block-views-news-block-block .view-news-block .view-content div").first().after("<h2 class='h2-lis-blog'>LIS Blog:</h2>" + rows);
}

function twitterTimelineUpdate() {
    jQuery(".twitter-timeline-block").prepend('<div id="follow_nasa_lis"><a href="https://twitter.com/NASA_LIS" target="_blank"><span>Follow <i class="fa fa-arrow-right" aria-hidden="true"></i></span></a></div>');
}

/**
 * Functions related to social share
 */
function socialShare() {
    jQuery(".social_share li").click(function(){

        var share_url = false;

        if (jQuery(this).hasClass("facebook")) {
            share_url = "http://www.facebook.com/sharer.php?u=";
        } else if (jQuery(this).hasClass("twitter")) {
            share_url = "https://twitter.com/share?url=";
        } else if (jQuery(this).hasClass("google_plus")) {
            share_url = "https://plus.google.com/share?url=";
        } else if (jQuery(this).hasClass("email")) {
            share_url = "mailto:?Subject=Check this out!&Body=Hey!%0D%0A%0D%0ACheck out this awesome post: ";
        }

        if (share_url) {
            window.open(share_url + encodeURIComponent(window.location.href));
        }
    });
}