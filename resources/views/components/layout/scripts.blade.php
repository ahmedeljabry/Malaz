<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="{{ asset('web/js/jquery.min.js') }}"></script>
<script src="{{ asset('web/js/owl.carousel.js') }}"></script>
<script src="{{ asset('web/js/scroll-entrance.js') }}"></script>
<script>
    // Wait until page loads
    window.addEventListener("load", () => {
        document.querySelector(".hero-text-container").classList.add("active");
        document.querySelector(".hero-image").classList.add("active");
    });

    $('.services').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        autoplay: true,
        smartSpeed: 2000,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    })

    $('.logos').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        autoplay: true,
        smartSpeed: 1000,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 4
            },
            1000: {
                items: 5
            }
        }
    })


    $('.blogs').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        autoplay: true,
        smartSpeed: 2000,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })





</script>

<script>
    // Get the button
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.opacity = "1";
        } else {
            mybutton.style.opacity = "0";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
