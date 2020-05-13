$(document).ready(function () {

    /*--------------------------------/
     /* NAVIGATION
     /*-------------------------------*/

    // body padding-top adjustment for page with navbar-fixed-top
    if ($('.navbar').hasClass('navbar-fixed-top') && !$('.navbar').hasClass('ignore-paddingtop')) {
        $('body').css('padding-top', $('.navbar-fixed-top').innerHeight());
    }

    // full transparent fixed-top navbar should have background when scrolled
    if ($('.navbar-fixed-top.navbar-no-background').length > 0) {
        $(window).scroll(function () {
            if ($(document).scrollTop() > 100) {
                $('.navbar-fixed-top').removeClass('navbar-no-background');
            } else {
                $('.navbar-fixed-top').addClass('navbar-no-background');
            }
        });
    }

    // transparent fixed-top navbar should have solid background when scrolled
    if ($('.navbar-fixed-top.navbar-transparent').length > 0) {
        $(window).scroll(function () {
            if ($(document).scrollTop() > 100) {
                $('.navbar-fixed-top').removeClass('navbar-transparent');
            } else {
                $('.navbar-fixed-top').addClass('navbar-transparent');
            }
        });
    }

    // mobile main navigation
    if ($(window).width() < 993) {
        // change to click navigation
        $('.main-navbar-nav .dropdown-toggle').on('click', function (e) {
            e.preventDefault();

            if (!$(this).parent().hasClass('dd-open')) {
                $(this).parent().addClass('dd-open');
            } else {
                $(this).parent().removeClass('dd-open');
            }
        });

        // dropdown menu in navbar-fixed-top can't be scrolled, so we disabled it in mobile screen
        if ($('.navbar-default').hasClass('navbar-fixed-top')) {
            $('.navbar-default').removeClass('navbar-fixed-top');
            $('body').css('padding-top', 0);
        }
    }

    if ($(window).width() < 767) {
        if ($('.sidebarnav-toggle').length > 0) {
            var navWidth = $('#sidebar-nav').width();
            $('#sidebar-nav').css({'left': -navWidth});

            $('.sidebarnav-toggle').on('click', function () {
                if ($('#sidebar-nav').hasClass('active')) {
                    $('#sidebar-nav').css({'left': -navWidth});
                    $('#sidebar-nav').removeClass('active');
                } else {
                    $('#sidebar-nav').css({'left': 0});
                    $('#sidebar-nav').addClass('active');
                }
            });
        }
    }

    if ($('.navbar-auto-hiding').length > 0) {
        $('.navbar-auto-hiding').autoHidingNavbar();
    }

    if ($('.navbar-fixed-top.navbar-shrinkable').length > 0) {
        $('.wrapper').css('padding-top', 97);

        $(window).scroll(function () {
            if ($(document).scrollTop() > 300) {
                $('.navbar-fixed-top').addClass('shrink-active');
            } else {
                $('.navbar-fixed-top').removeClass('shrink-active');
            }
        });
    }

    // scroll to top
    if ($(window).width() > 992) {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 300) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });

        $('.back-to-top').click(function (e) {
            e.preventDefault();

            $('body, html').animate({
                scrollTop: 0
            }, 800, 'easeInOutExpo');
        });
    }


    /*--------------------------------/
     /* SLIDER REVOLUTION
     /*-------------------------------*/

    if ($('#slider-fullscreen').length > 0) {
        $('#slider-fullscreen').revolution({
            sliderLayout: "fullscreen",
            disableProgressBar: 'on',
            onHoverStop: 'off',
            delay: 6000,
            responsiveLevels: [4096, 1024, 778, 480],
            gridwidth: [900, 750, 600, 350],
            gridheight: [600, 600, 980, 500],
            navigation: {
                keyboardNavigation: 'on',
                touch: {
                    touchenabled: "on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                },
                arrows: {
                    style: 'hades',
                    enable: true,
                    hide_under: 768,
                    hide_onleave: false,
                    tmp: '<div class="tp-arr-allwrapper">	<div class="tp-arr-imgholder"></div></div>',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 10,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 10,
                        v_offset: 0
                    }
                },
                bullets: {
                    enable: true,
                    hide_onmobile: false,
                    style: "hephaistos",
                    hide_onleave: false,
                    direction: "horizontal",
                    h_align: "center",
                    v_align: "bottom",
                    h_offset: 0,
                    v_offset: 30,
                    space: 5,
                    tmp: ''
                }
            },
        });
    }

    if ($('#slider-fullscreen2').length > 0) {
        $('#slider-fullscreen2').revolution({
            sliderLayout: "fullscreen",
            delay: 6000,
            onHoverStop: 'off',
            responsiveLevels: [4096, 1024, 778, 480],
            gridwidth: [1140, 750, 600, 250],
            gridheight: [600, 600, 980, 500],
            navigation: {
                keyboardNavigation: 'on',
                touch: {
                    touchenabled: "on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                },
                arrows: {
                    enable: true,
                },
                bullets: {
                    enable: true,
                    hide_onmobile: false,
                    style: "hermes",
                    hide_onleave: false,
                    direction: "horizontal",
                    h_align: "center",
                    v_align: "bottom",
                    h_offset: 0,
                    v_offset: 30,
                    space: 5,
                    tmp: ''
                }
            },
        });
    }


    /*--------------------------------/
     /* SIDEBAR NAVIGATION TOGGLE
     /*-------------------------------*/

    $('.submenu-toggle').click(function () {
        if (!$(this).parent().hasClass('active')) {
            $(this).parent().addClass('active');
        } else {
            $(this).parent().removeClass('active');
        }
    });

    $('.sidebar-nav a').click(function () {
        $('.sidebar-nav a').removeClass('current');
        $(this).addClass('current');
    });


    /*--------------------------------/
     /* MASKED INPUT
     /*-------------------------------*/

    if ($('#masked-input-demo').length > 0) {
        $('#phone').mask('(999) 999-9999');
        $('#phone-ex').mask('(999) 999-9999? x99999');
        $('#tax-id').mask('99-9999999');
        $('#ssn').mask('999-99-9999');
        $('#product-key').mask('a*-999-a999');
    }


    /*--------------------------------/
     /* DATE PICKER
     /*-------------------------------*/

    if ($('#date-picker-demo').length > 0) {
        var dtp = $('#datepicker').datepicker()
            .on('changeDate', function (e) {
                dtp.datepicker('hide');
            });

        $('#daterangepicker').daterangepicker({
            timePicker: true,
            timePickerIncrement: 10,
            format: 'MM/DD/YYYY h:mm A',
            applyClass: "btn-primary"
        });
    }


    /*--------------------------------/
     /* DATE RANGE PICKER
     /*-------------------------------*/

    if ($('#date-range-picker-demo').length > 0) {

        var drInput = $('#daterange-input');

        $('#date-range-picker-demo').daterangepicker({
            startDate: drInput.attr('data-from'),
            endDate: drInput.attr('data-to'),
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            locale: {
                format: drInput.attr('data-format'),
            }
        }, setValue);

        function setValue(start, end) {
            drInput.val(start.format(drInput.attr('data-format')) + ' - ' + end.format(drInput.attr('data-format')));
        }
    }


    /*--------------------------------/
     /* SUMMERNOTE
     /*-------------------------------*/

    if ($('#summernote-editor').length > 0) {
        $('#summernote-editor').summernote({
            height: 300,
            focus: true,
            callbacks: {
                onPaste: function (e) {
                    alert('You have pasted something to the editor');
                }
            }
        });
    }


    /*--------------------------------/
     /* MARKDOWN
     /*-------------------------------*/

    if ($('#markdown-editor').length > 0) {

        var initContent = '<h4>Hello there</h4> ' +
            '<p>How are you? I have below task for you :</p> ' +
            '<p>Select from this text... Click the bold on THIS WORD and make THESE ONE italic, ' +
            'link GOOGLE to google.com, ' +
            'test to insert image (and try to tab after write the image description)</p>' +
            '<p>Test Preview And ending here...</p> ' +
            '<p>Click "List"</p> Enjoy!';

        $('#markdown-editor').text(toMarkdown(initContent));
    }


    /*--------------------------------/
     /* TEXTAREA WITH COUNTER
     /*-------------------------------*/

    if ($('#textarea-counter-demo').length > 0) {
        var textMax = 99;

        $('.js-textarea-help span').html(textMax + ' characters remaining');

        $('.textarea-counting').keyup(function () {
            var textLength = $('.textarea-counting').val().length;
            var textRemaining = textMax - textLength;

            $('.js-textarea-help span').html(textRemaining + ' characters remaining');
        });
    }

    /*-----------------------------------/
     /* SKILLS
     /*----------------------------------*/

    if ($('.pie-chart').length > 0) {
        $('.pie-chart').easyPieChart({
            size: 180,
            barColor: '#939CA0',
            trackColor: '#f8f8f8',
            scaleColor: false,
            lineWidth: 3,
            lineCap: "square",
            animate: 2000
        });
    }


    /*-----------------------------------/
     /* COUNTDOWN
     /*----------------------------------*/

    if ($('#countdown-demo').length > 0) {

        /* the date value below is for demo purpose only
         * normally you would provide the value with format YYYY, MM, DD in which the countdown should stop counting
         */
        var dateUntil = new Date(new Date().getFullYear() + 1, 01, 01);

        /*
         STOP CHANGING THE REST OF THE CODES UNLESS YOU KNOW WHAT YOU ARE DOING
         */

        $('#countdown1').countdown({
            until: dateUntil,
        });

        //$('#countdown1').countdown('pause');

        $('#countdown2').countdown({
            until: dateUntil,
        });

        $('#countdown3').countdown({
            until: dateUntil,
        });

        $('#countdown4').countdown({
            until: dateUntil,
        });
    }


    /*-----------------------------------/
     /* ICON LIST
     /*----------------------------------*/

    if ($('.fontawesome-icon-list').length > 0) {
        $('.fontawesome-icon-list a').on('click', function (e) {
            e.preventDefault();
        });

        new Clipboard('.fontawesome-icon-list a', {
            text: function (trigger) {
                var ahref = trigger.getAttribute('href');
                return ahref.replace('#', 'fa fa-');
            }
        }).on('success', function (e) {
            var tooltipObj = $(e.trigger).tooltip({
                title: 'copied!',
                placement: 'bottom',
                trigger: 'click',
            });

            tooltipObj.tooltip('show');
            setTimeout(function () {
                tooltipObj.tooltip('hide');
            }, 1000);
        });
    }


    /*-----------------------------------/
     /* TESTIMONIALS
     /*----------------------------------*/

    if ($('#testimonial-big-carousel').length > 0) {
        $('#testimonial-big-carousel').owlCarousel({
            singleItem: true,
            autoPlay: 3000,
            transitionStyle: 'fadeUp'
        });
    }

    if ($('#testimonial-standard-carousel').length > 0) {
        $('#testimonial-standard-carousel').owlCarousel({
            singleItem: true,
            autoPlay: 3000,
            transitionStyle: 'fade'
        });
    }


    /*-----------------------------------/
     /* CAROUSELS
     /*----------------------------------*/

    if ($('#carousel-single').length > 0) {
        $('#carousel-single').owlCarousel({
            singleItem: true,
            navigation: true,
            slideSpeed: 800,
            autoPlay: 3000
        });
    }

    if ($('#carousel-single-fade').length > 0) {
        $('#carousel-single-fade').owlCarousel({
            singleItem: true,
            navigation: true,
            autoPlay: 3000,
            transitionStyle: 'fade'
        });
    }

    if ($('#carousel-images').length > 0) {
        $('#carousel-images').owlCarousel({
            navigation: true,
            pagination: false,
            slideSpeed: 800,
            autoPlay: 3000
        });
    }

    if ($('#content-slider').length > 0) {
        $('#content-slider').owlCarousel({
            singleItem: true,
            navigation: true,
            slideSpeed: 1000,
            autoPlay: 5000
        });
    }

    if ($('#content-slider2').length > 0) {
        $('#content-slider2').owlCarousel({
            singleItem: true,
            slideSpeed: 1000,
            autoPlay: 5000
        });
    }

    if ($('#carousel-portfolio-simple').length > 0) {
        $('#carousel-portfolio-simple').owlCarousel({
            items: 4,
            navigation: true,
            pagination: false,
            slideSpeed: 800,
            autoPlay: 3000
        });
    }

    if ($('#carousel-portfolio-card').length > 0) {
        $('#carousel-portfolio-card').owlCarousel({
            items: 3,
            navigation: true,
            slideSpeed: 800,
            autoPlay: 3000
        });
    }


    /*-----------------------------------/
     /* AJAX CALL FOR NEWSLETTER FUNCTION
     /*----------------------------------*/

    $newsletter = $('.newsletter-form');
    $newsletter.find('.btn').click(function () {
        $url = 'php/mailchimp.php';

        $attr = $newsletter.attr('action');
        if (typeof $attr !== typeof undefined && $attr !== false) {
            if ($newsletter.attr('action') != '') $url = $newsletter.attr('action');
        }

        subscribe($newsletter, $url);
    });

    function subscribe(newsletter, formUrl) {
        $btn = newsletter.find('.btn');

        $.ajax({

            url: formUrl,
            type: 'POST',
            dataType: 'json',
            cache: false,
            data: {
                email: newsletter.find('input[name="email"]').val(),
            },
            beforeSend: function () {
                $btn.addClass('loading');
                $btn.attr('disabled', 'disabled');
            },
            success: function (data, textStatus, XMLHttpRequest) {

                var className = '';

                if (data.result == true) {
                    className = 'alert-success';
                } else {
                    className = 'alert-danger';
                }

                newsletter.find('.alert').html(data.message)
                    .removeClass('alert-danger alert-success')
                    .addClass('alert active ' + className)
                    .slideDown(300);

                $btn.removeClass('loading');
                $btn.removeAttr('disabled');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("AJAX ERROR: \n" + XMLHttpRequest.responseText + "\n" + textStatus);
            }
        });
    }

    if ($("#rotating-words").length > 0) {
        $("#rotating-words").Morphext({
            animation: "fadeInUp",
            separator: ",",
            speed: 3000
        });
    }


    /*-----------------------------------/
     /* AJAX CONTACT FORM
     /*----------------------------------*/

    if ($('#contact-form').length > 0) {
        $('#contact-form').parsley();

        $('#contact-form').submit(function (e) {
            e.preventDefault();

            if (!$(this).parsley('isValid'))
                return;

            $theForm = $(this);
            $btn = $(this).find('#submit-button');
            $btnText = $btn.text();
            $(this).parent().append('<div class="alert"></div>');
            $alert = $(this).parent().find('.alert');

            $btn.find('.loading-icon').addClass('fa-spinner fa-spin ');
            $btn.prop('disabled', true).find('span').text("Sending...");

            $url = "php/contact.php";

            $attr = $(this).attr('action');
            if (typeof $attr !== typeof undefined && $attr !== false) {
                if ($(this).attr('action') != '') $url = $(this).attr('action');
            }

            $.post($url, $(this).serialize(), function (data) {

                $message = data.message;

                if (data.result == true) {
                    $theForm.slideUp('medium', function () {
                        $alert.removeClass('alert-danger');
                        $alert.addClass('alert-success').html($message).slideDown('medium');
                    });
                } else {
                    $alert.addClass('alert-danger').html($message).slideDown('medium');
                }

                $btn.find('.loading-icon').removeClass('fa-spinner fa-spin ');
                $btn.prop('disabled', false).find('span').text($btnText);

            })
                .fail(function () {
                    console.log('AJAX Error');
                });
        });
    }


    /*----------------------------/
     /* PORTFOLIO ISOTOPE INIT
     /*---------------------------*/

    if ($('.portfolio-isotope').length > 0) {
        var $container = $('.portfolio-isotope');

        $container.imagesLoaded(function () {
            var $isoObj = $container.isotope({
                itemSelector: '.portfolio-item',
                layoutMode: 'fitRows',
                transitionDuration: '0.7s'
            });

            $('.portfolio-item-filters a').click(function (e) {
                e.preventDefault();

                var selector = $(this).attr('data-filter');
                $container.isotope({
                    filter: selector
                });

                $container.parent().height($container.height());

                $('.portfolio-item-filters a').removeClass('active');
                $(this).addClass('active');
            });
        });
    }


    /*----------------------------/
     /* PORTFOLIO SLIDER
     /*---------------------------*/

    if ($('#portfolio-slider').length > 0) {
        $('#portfolio-slider').revolution({
            sliderLayout: 'auto',
            disableProgressBar: 'on',
            delay: 4000,
            navigation: {
                keyboardNavigation: 'on',
                arrows: {enable: true,},
                bullets: {
                    enable: true,
                    style: "metis",
                    hide_onleave: true,
                    direction: "horizontal",
                    h_align: "center",
                    v_align: "bottom",
                    h_offset: 20,
                    v_offset: 30,
                    space: 5,
                    tmp: '<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>'
                }
            },
        });
    }


    /*----------------------------/
     /* BLOG MASONRY
     /*---------------------------*/

    if ($('.blog-masonry').length > 0) {
        var $container = $('.blog-masonry');
        $container.imagesLoaded(function () {
            $container.isotope({
                itemSelector: '.grid-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-sizer',
                }
            });
        });
    }


    /*----------------------------/
     /* FIT VIDEO
     /*---------------------------*/

    if ($('.fit-video').length > 0) {
        $('.fit-video').fitVids();
    }


    /*-----------------------------------/
     /* TWITTER FETCHER
     /*----------------------------------*/

    if ($('#tweets').length > 0) {
        function momentDateFormatter(date, dateString) {
            return moment(dateString).fromNow();
        }

        function populateTpl(tweets) {
            var element = document.getElementById('tweets');
            var html = '<ul class="list-inline">';
            for (var i = 0, lgth = tweets.length; i < lgth; i++) {
                var tweetObject = tweets[i];

                html += '<li>'
                    + '<div class="tweet-infos">' + tweetObject.author + '</div>'
                    + '<p class="tweet-content">' + tweetObject.tweet + '</p>'
                    + '<span class="tweet-time">' + tweetObject.time + '</span>'
                    + '</li>';
            }

            html += '</ul>';
            element.innerHTML = html;
        }

        twitterFetcher.fetch({
            "id": '441767385733668865',
            "maxTweets": 5,
            "enableLinks": true,
            "dateFunction": momentDateFormatter,
            "dataOnly": true,
            "customCallback": populateTpl
        });
    }


    /*-----------------------------------/
     /* COUNT TO PLUGIN
     /*----------------------------------*/

    if ($('.countto-demo').length > 0) {
        $('.countto-demo').each(function () {
            $(this).countTo({
                to: parseInt($(this).text())
            });
        });
    }


    /*-----------------------------------/
     /* WAYPOINT
     /*----------------------------------*/

    if ($('.waypoint').length > 0) {
        var waypoints = $('.waypoint').waypoint({
            handler: function (direction) {
                $('.countto').each(function () {
                    $(this).countTo({
                        to: parseInt($(this).text())
                    });
                });
            }
        });
    }

});