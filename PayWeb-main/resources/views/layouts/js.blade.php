<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script>
    let check = null
    let platfrom = navigator.userAgent;
    if (platfrom.includes('Macintosh')){
        $(document).ready(function() {
            for (let i = 1; i < 8; i++) {
                $("#coin"+i).css("visibility","hidden")
            }
            let count = 0;
            let scrollPercent = 0;
            $('html,body,*').bind('mousewheel', function(e){
                scrollPercent = 100 * this.scrollTop / ($(document).width()*2 - $(window).width());
                if (scrollPercent > 0)
                    if(scrollPercent > 41)
                        $("#coin").css("transform","translate(41vw, 0px)");
                    else
                        $("#coin").css("transform","translate("+scrollPercent+"vw, 0px)");
                if (scrollPercent >= 70 && count == 0){
                    count++;
                    $("#contact-animation").css("opacity","0");
                    $("#coin-panel").css("opacity","1");
                    for (let i = 1; i < 8; i++) {
                        let inter = setTimeout(function () {
                            $("#coin"+i).css("visibility","visible");
                            animateCSS('#coin'+i, 'fadeInUp')
                        },1000 * i)
                    }
                }
                if (scrollPercent >= 110 && count == 1){
                    count++;
                    $("#contact-animation").css("opacity","1");
                    $(".three").css("visibility","visible");
                    animateCSS('.three', 'slideInRight')
                }

            });
        });
    }
    else{
        if(check){
            $("#contact-animation").css("opacity","0");
            $("#coin-panel").css("opacity","1");
            for (let i = 1; i < 8; i++) {
                $("#coin"+i).css("visibility","visible")
            }
            $("#contact-animation").css("opacity","1");
            $(".three").css("visibility","visible")
        }
        else{
            $(document).ready(function() {
                for (let i = 1; i < 8; i++) {
                    $("#coin"+i).css("visibility","hidden")
                }
                //coin animation
                var count = 0,speed=30;
                let scrollPercent = 0;
                $('html, body, *').mousewheel(function(e, delta) {
                    scrollPercent = 100 * this.scrollTop / ($(document).width()*2 - $(window).width());
                    if (scrollPercent > 0)
                        if(scrollPercent > 41)
                            $("#coin").css("transform","translate(41vw, 0px)");
                        else
                            $("#coin").css("transform","translate("+scrollPercent+"vw, 0px)");
                    if (scrollPercent >= 70 && count == 0){
                        count++;
                        $("#contact-animation").css("opacity","0");
                        $("#coin-panel").css("opacity","1");
                        for (let i = 1; i < 8; i++) {
                            let inter = setTimeout(function () {
                                $("#coin"+i).css("visibility","visible");
                                animateCSS('#coin'+i, 'fadeInUp')
                            },1000 * i)
                        }
                    }
                    if (scrollPercent >= 110 && count == 1){
                        count++;
                        $("#contact-animation").css("opacity","1");
                        $(".three").css("visibility","visible");
                        animateCSS('.three', 'slideInRight')
                    }
                    this.scrollTop -= (delta*speed);
                    console.log(scrollPercent);
                    e.preventDefault();
                });
            });
        }
    }

    function animateCSS(element, animationName, callback) {
        const node = document.querySelector(element);
        node.classList.add('animated', animationName);

        function handleAnimationEnd() {
            node.classList.remove('animated', animationName);
            node.removeEventListener('animationend', handleAnimationEnd);

            if (typeof callback === 'function') callback()
        }

        node.addEventListener('animationend', handleAnimationEnd)
    }
    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }
    $(function() {
        $(".lang-select").click(function(){
            var url = window.location.href;
            url = updateQueryStringParameter(url, 'lang', $(this).attr('data-lang'))
            window.location.href = url;
        })
    })

</script>
