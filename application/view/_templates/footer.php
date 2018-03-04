    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL; ?>";
    </script>

    <!-- our JavaScript -->
    <script src="<?php echo URL; ?>js/application.js"></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>  

<script>
    window.onscroll = function() {myFunction()};

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
    }
        
    function toggleSideNav(x) {
        x.classList.toggle("change");
        var z = document.getElementById("mySidenav");
        
    if (z.style.width == "250px") {
            z.style.width = "0px";
        } else {
            z.style.width = "250px";
        } 
    }

    function hideFilter(){
        $("button#hideFilter").click(function(){
        $("div#filters").slideUp(500);
        
        var sf = document.getElementById("showFilter");
        sf.style.display = "block";

        var hf = document.getElementById("hideFilter");
        hf.style.display = "none";

        });   
    }

    function showFilter(){
        $("button#showFilter").click(function(){
        $("div#filters").slideDown(500);

        var hf = document.getElementById("hideFilter");
        hf.style.display = "block";

        var sf = document.getElementById("showFilter");
        sf.style.display = "none";
    });  
    }
</script>
</body>
</html>
