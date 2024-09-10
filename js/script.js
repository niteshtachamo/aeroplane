
jQuery(function ($){

    // bottom-to-top
    var btn = $('#bottom-to-top');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
        btn.addClass('show');
        } else {
        btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });

    $(document).ready(function() {
        $(".primary-menu li.menu-dropdown > a, .category-list li.menu-dropdown > a")
            .append('<span class="dropdown-btn"><i class="fa-solid fa-plus"></i></span>');
    
        $('.dropdown-btn').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            
            var $parentLi = $(this).closest('li.menu-dropdown');
            
            $parentLi.toggleClass('open').siblings().removeClass('open');
            $parentLi.children("ul.sub-menu, ul.sub-category").first().slideToggle();
            $parentLi.siblings().children("ul.sub-menu, ul.sub-category").slideUp().parent().removeClass('open');
        });
    
        // Close dropdowns when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.menu-dropdown').length) {
                $('.menu-dropdown').removeClass('open');
                $('.sub-menu, .sub-category').slideUp();
            }
        });
    });
    
    
    $('.primary-menu li, .category-list li').has('ul').addClass('menu-dropdown');

    $(document).ready(function(){
        var currentPath = window.location.pathname.replace(/\/$/, '');

        $('.primary-menu a').each(function() {
            var href = $(this).attr('href').replace(/\/$/, '');
            var lastPartHref = href.substring(href.lastIndexOf('/') + 1);
            if (currentPath.endsWith(lastPartHref)) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
        $('.hamburger').click(function(){
            $(this).toggleClass('active');
            $('.overlay').toggleClass('active');
            $('.header-menu').toggleClass('active');
            $('body').toggleClass('overflow-hidden');
            $('.primary-menu').toggleClass('active');
        });
    
        $('.overlay, .mobile-menu .close-menu').click(function(){
            $('.overlay').removeClass('active');
            $('.hamburger').removeClass('active');
            $('body').removeClass('overflow-hidden');
            $('.header-menu').removeClass('active');
            $('.mini-cart-menu').removeClass('open');
        });

        $('.category-title .title').on('click', function(){
            $('.category-list').slideToggle(500);
        });	
        $('.mini-cart-icon').on('click', function(){
            $('.mini-cart-menu').toggleClass('open');
            $('.overlay').addClass('active');
            $('body').addClass('overflow-hidden');
        });	
        $('.mini-menu-head .menu-close').on('click', function(){
            $('.mini-cart-menu').removeClass('open');
            $('.overlay').removeClass('active');
            $('body').removeClass('overflow-hidden');
            
        });	

        /* Category Menu More Item show */
        $('.close-more-category-btn').on('click', function(){
            $('.category-more-item').slideToggle();
            $(this).toggleClass('rx-change');
        });
        $('.header-user-search').on('click', function(){
            $('.category-more-item').slideToggle();
            $('.search-user-box').toggleClass('active');
            $(this).toggleClass('active');
            setTimeout(function() {
                $('.search-user-box input').focus();
            }, 100);
        });

        var navHeight = $('.site-header .bottom-header').innerHeight();
        var siteHeaderHeight = $('.site-header').innerHeight();
        var bottomHeader = document.querySelector('.site-header');
        // var bottomHeaderTop = bottomHeader.offsetTop;
        var bottomHeaderTop = siteHeaderHeight;
        $('.site-header .bottom-header').css('min-height', navHeight + 'px');

        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            var viewFooter = $('body').height() - $('footer').outerHeight() - ($(window).height() / 2);
            if($(window).width() < 991){
                viewFooter = $('body').height() - $('footer').outerHeight();
            }
            if (scroll > bottomHeaderTop && scroll < viewFooter) {
                $('.site-header .bottom-header').addClass('sticky');
            } else {
                $('.site-header .bottom-header').removeClass('sticky');
            }
        });
    });


    // AJAX search with suggestions
    $(document).ready(function() {
        // Handle keyup event on search inputs
        $(document).on('keyup', '.searchInput', function () {
            const searchInput = $(this);
            const searchQuery = searchInput.val();
            const suggestionsList = searchInput.siblings('.suggestions-list');
    
            if (searchQuery.length > 0) {
                $.ajax({
                    url: 'search_suggestions.php',
                    method: 'GET',
                    data: { search_keyword: searchQuery },
                    success: function (response) {
                        suggestionsList.html(response).show();
                    }
                });
            } else {
                suggestionsList.hide();
            }
    
            // Hide suggestions for other search inputs
            $('.suggestions-list').not(suggestionsList).hide();
        });
    
        // Hide suggestions when clicking outside
        $(document).click(function (e) {
            if (!$(e.target).closest('.searchForm').length) {
                $('.suggestions-list').hide();
            }
        });
    
        // Populate search input with the clicked suggestion
        $(document).on('click', '.suggestion-item', function () {
            const suggestionItem = $(this);
            const searchInput = suggestionItem.closest('.searchForm').find('.searchInput');
            searchInput.val(suggestionItem.text());
            suggestionItem.closest('.suggestions-list').hide();
        });
    });
    

});


function initializeSplide(selector, options, extensions) {
    const splideInstances = [];
  
    document.querySelectorAll(selector).forEach(element => {
        if (element.querySelector('.splide__track') && element.querySelector('.splide__list')) {
            const splide = new Splide(element, options).mount(extensions);
            splideInstances.push(splide);
        } else {
            console.error(`Splide initialization failed: Missing required elements in ${selector}`);
        }
    });
  
    return splideInstances;
}

if (document.querySelector('.banner-slide')) {
    initializeSplide('.banner-slide', {
        type: 'loop',
        perPage: 1,
        arrows: false,
        pagination: true,
        gap: 30,
    });
}
if (document.querySelector('.our-brand-slide')) {
    initializeSplide('.our-brand-slide', {
        type: 'loop',
        perPage: 5,
        arrows: false,
        pagination: false,
        gap: 30,
        autoScroll: {
            speed: 0.5,
            // pauseOnHover: false,
        },
        breakpoints: {
            991: {
                perPage: 4,
            },
            575: {
                perPage: 2,
            }
        }
    }, window.splide.Extensions);
}
