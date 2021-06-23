@extends('layouts.bookApp')

@section('book_content')
                {{-- <div>{{ $user_book }}</div>
                <div>{{ $book_pages }}</div>  --}}
                <div class="container-main w-full p-0 m-0">
                    {{-- <div class="row justify-content-center"> --}}
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    {{-- turn js part starts --}}
                <div id="canvas">
                    <div class = "page-turner">
                        <input type="number" id = "changePage-number">
                        <button onclick = "changePage()">Go To Page</button>
                    </div>
                    <div class = "return page">
                        <button onclick = "returnHome()">Return to Books</button>
                    </div>

                <div class="zoom-icon zoom-icon-in"></div>

                <div class="magazine-viewport">
                    <div class="container">
                        <div class="magazine">
                            <!-- Next button -->
                            <div ignore="1" class="next-button"></div>
                            <!-- Previous button -->
                            <div ignore="1" class="previous-button"></div>
                            @foreach($book_pages as $book_page)
                                <div
                                class = "{{ ($book_page->page_no == 1 || $book_page->page_no == $user_book->book_page) ? 'hard page-background' : 'sheet page-background' }}">
                                    {{-- <div style = "float: left; width: 100%; height: 100%; text-align: right;">
                                        <b>
                                            heading
                                        </b>
                                        <span>
                                            this is my paragraph.
                                        </span>
                                    </div> --}}

                                    <img src="{{ url('./storage' . '/book-pages' . '/' . $book_page->page_image) }}" width="100%" height="100%" class="page-2 book-page-image">
                                    <span>1</span>
                                    <!-- <img src="pages/2-large.jpg" width="50%" height="50%" class="page-2" style = "float: left;">
                                    <img src="pages/2-large.jpg" width="50%" height="50%" class="page-2" style = "float: left;">
                                    <img src="pages/1-large.jpg" width="50%" height="50%" class="page-2" style = "float: left;"> -->
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                </div>

                    {{-- turn js part ends --}}
    {{-- </div> --}}
</div>



{{-- js part of turn.js starts --}}



        <script type="text/javascript">
            var pageNumber = {!! json_encode($user_book->book_page) !!};
            var userId = {!! json_encode($user_book->user_id) !!};

            function loadApp() {

                $('#canvas').fadeIn(1000);

                var flipbook = $('.magazine');

                // Check if the CSS was already loaded

                if (flipbook.width()==0 || flipbook.height()==0) {
                    setTimeout(loadApp, 10);
                    return;
                }

                // Create the flipbook

                flipbook.turn({

                        // Magazine width

                        width: 922,

                        // Magazine height

                        height: 600,

                        // Duration in millisecond

                        duration: 1000,

                        // Hardware acceleration

                        acceleration: !isChrome(),

                        // Enables gradients

                        gradients: true,

                        // Auto center this flipbook

                        autoCenter: true,

                        // Elevation from the edge of the flipbook when turning a page

                        elevation: 50,

                        // The number of pages

                        pages: pageNumber,

                        // Events

                        when: {
                            turning: function(event, page, view) {

                                var book = $(this),
                                currentPage = book.turn('page'),
                                pages = book.turn('pages');

                                // Update the current URI

                                Hash.go('page/' + page).update();

                                // Show and hide navigation buttons

                                disableControls(page);


                                $('.thumbnails .page-'+currentPage).
                                    parent().
                                    removeClass('current');

                                $('.thumbnails .page-'+page).
                                    parent().
                                    addClass('current');



                            },

                            turned: function(event, page, view) {

                                disableControls(page);

                                $(this).turn('center');

                                if (page==1) {
                                    $(this).turn('peel', 'br');
                                }

                            },

                            missing: function (event, pages) {

                                // Add pages that aren't in the magazine

                                for (var i = 0; i < pages.length; i++)
                                    addPage(pages[i], $(this));

                            }
                        }

                });

                // Zoom.js

                $('.magazine-viewport').zoom({
                    flipbook: $('.magazine'),

                    max: function() {

                        return largeMagazineWidth()/$('.magazine').width();

                    },

                    when: {

                        swipeLeft: function() {

                            $(this).zoom('flipbook').turn('next');

                        },

                        swipeRight: function() {

                            $(this).zoom('flipbook').turn('previous');

                        },

                        // zoom page zoomin and page zoomout workflow

                        // resize: function(event, scale, page, pageElement) {

                        // 	if (scale==1)
                        // 		loadSmallPage(page, pageElement);
                        // 	else
                        // 		loadLargePage(page, pageElement);

                        // },
                        // zoom page zoomin and page zoomout workflow

                        zoomIn: function () {

                            $('.thumbnails').hide();
                            $('.made').hide();
                            $('.magazine').removeClass('animated').addClass('zoom-in');
                            $('.zoom-icon').removeClass('zoom-icon-in').addClass('zoom-icon-out');

                            if (!window.escTip && !$.isTouch) {
                                escTip = true;

                                $('<div />', {'class': 'exit-message'}).
                                    html('<div>Press ESC to exit</div>').
                                        appendTo($('body')).
                                        delay(2000).
                                        animate({opacity:0}, 500, function() {
                                            $(this).remove();
                                        });
                            }
                        },

                        zoomOut: function() {

                            $('.exit-message').hide();
                            $('.thumbnails').fadeIn();
                            $('.made').fadeIn();
                            $('.zoom-icon').removeClass('zoom-icon-out').addClass('zoom-icon-in');

                            setTimeout(function(){
                                $('.magazine').addClass('animated').removeClass('zoom-in');
                                resizeViewport();
                            }, 0);

                        }
                    }
                });

                // Zoom event

                if ($.isTouch)
                    $('.magazine-viewport').bind('zoom.doubleTap', zoomTo);
                else
                    $('.magazine-viewport').bind('zoom.tap', zoomTo);


                // Using arrow keys to turn the page

                $(document).keydown(function(e){

                    var previous = 37, next = 39, esc = 27;

                    switch (e.keyCode) {
                        case previous:

                            // left arrow
                            $('.magazine').turn('previous');
                            e.preventDefault();

                        break;
                        case next:

                            //right arrow
                            $('.magazine').turn('next');
                            e.preventDefault();

                        break;
                        case esc:

                            $('.magazine-viewport').zoom('zoomOut');
                            e.preventDefault();

                        break;
                    }
                });

                // URIs - Format #/page/1
                //regular expression ^page = page should be at the beginning of string
                // ([0-9]*) means the 0-9 should be 0 or more times in the matching string
                // $ is used to search characters at the end of the string


                Hash.on('^page\/([0-9]*)$', {
                    yep: function(path, parts) {
                        var page = parts[1];

                        if (page!==undefined) {
                            if ($('.magazine').turn('is'))
                                $('.magazine').turn('page', page);
                        }

                    },
                    nop: function(path) {

                        if ($('.magazine').turn('is'))
                            $('.magazine').turn('page', 1);
                    }
                });


                $(window).resize(function() {
                    resizeViewport();
                }).bind('orientationchange', function() {
                    resizeViewport();
                });

                // Events for thumbnails

                $('.thumbnails').click(function(event) {

                    var page;

                    if (event.target && (page=/page-([0-9]+)/.exec($(event.target).attr('class'))) ) {

                        $('.magazine').turn('page', page[1]);
                    }
                });

                $('.thumbnails li').
                    bind($.mouseEvents.over, function() {

                        $(this).addClass('thumb-hover');

                    }).bind($.mouseEvents.out, function() {

                        $(this).removeClass('thumb-hover');

                    });

                if ($.isTouch) {

                    $('.thumbnails').
                        addClass('thumbanils-touch').
                        bind($.mouseEvents.move, function(event) {
                            event.preventDefault();
                        });

                } else {

                    $('.thumbnails ul').mouseover(function() {

                        $('.thumbnails').addClass('thumbnails-hover');

                    }).mousedown(function() {

                        return false;

                    }).mouseout(function() {

                        $('.thumbnails').removeClass('thumbnails-hover');

                    });

                }


                // Regions

                if ($.isTouch) {
                    $('.magazine').bind('touchstart', regionClick);
                } else {
                    $('.magazine').click(regionClick);
                }

                // Events for the next button

                $('.next-button').bind($.mouseEvents.over, function() {

                    $(this).addClass('next-button-hover');

                }).bind($.mouseEvents.out, function() {

                    $(this).removeClass('next-button-hover');

                }).bind($.mouseEvents.down, function() {

                    $(this).addClass('next-button-down');

                }).bind($.mouseEvents.up, function() {

                    $(this).removeClass('next-button-down');

                }).click(function() {

                    $('.magazine').turn('next');

                });

                // Events for the next button

                $('.previous-button').bind($.mouseEvents.over, function() {

                    $(this).addClass('previous-button-hover');

                }).bind($.mouseEvents.out, function() {

                    $(this).removeClass('previous-button-hover');

                }).bind($.mouseEvents.down, function() {

                    $(this).addClass('previous-button-down');

                }).bind($.mouseEvents.up, function() {

                    $(this).removeClass('previous-button-down');

                }).click(function() {

                    $('.magazine').turn('previous');

                });


                resizeViewport();

                $('.magazine').addClass('animated');

            }


            // Zoom icon

            $('.zoom-icon').bind('mouseover', function() {

                if ($(this).hasClass('zoom-icon-in'))
                    $(this).addClass('zoom-icon-in-hover');

                if ($(this).hasClass('zoom-icon-out'))
                    $(this).addClass('zoom-icon-out-hover');

            }).bind('mouseout', function() {

                if ($(this).hasClass('zoom-icon-in'))
                    $(this).removeClass('zoom-icon-in-hover');

                if ($(this).hasClass('zoom-icon-out'))
                    $(this).removeClass('zoom-icon-out-hover');

            }).bind('click', function() {

                if ($(this).hasClass('zoom-icon-in'))
                    $('.magazine-viewport').zoom('zoomIn');
                else if ($(this).hasClass('zoom-icon-out'))
                    $('.magazine-viewport').zoom('zoomOut');

            });

            $('#canvas').hide();

            //document.addEventListener("DOMContentLoaded", loadApp);
            $(document).ready(loadApp);


            function changePage(){
                pageNo = $('#changePage-number').val();
                // alert(pageNo);

                var flipbook = $('.magazine');

                flipbook.turn("page", pageNo);
            };


            function returnHome(){
                window.location.href = "/book/" + userId;
            }


            </script>

    {{-- js part of turn.js ends --}}


@endsection
