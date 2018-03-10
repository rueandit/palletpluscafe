    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL . '\\'; ?>";
    </script>

    <!-- our JavaScript -->
    <script src="<?php echo URL; ?>js/application.js"></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>  

<script>
    $(document).ready(function() {
        window.onscroll = function() {myFunction()};

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;
        var orders = {};

        function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
        }

        $("#appBar").click(function(x){
            this.classList.toggle("change");
            var z = $("#mySidenav")[0];

            if (z.style.width == "250px") {
                    z.style.width = "0px";
            } else {
                z.style.width = "250px";
            }
        });

        $("button#hideFilter").click(function(){
            $("div#filters").slideUp(500);
            
            var sf = document.getElementById("showFilter");
            sf.style.display = "block";

            var hf = document.getElementById("hideFilter");
            hf.style.display = "none";
        });   

        $("button#showFilter").click(function(){
            $("div#filters").slideDown(500);

            var hf = document.getElementById("hideFilter");
            hf.style.display = "block";

            var sf = document.getElementById("showFilter");
            sf.style.display = "none";
        });  

        $('button.increase').click(function(){
        var menuId = (this.id).split("-")[1];
        var counter = parseInt(document.getElementById("counter-" + menuId).value);
        counter++;
        
        orders[menuId] = counter;
        $('input[type=text]#counter-' + menuId).val(counter);
        alert(JSON.stringify(orders));
        });
        
        $('button.decrease').click(function(){
        var menuId = (this.id).split("-")[1];
        var counter = parseInt(document.getElementById("counter-" + menuId).value);
        if (counter > 0) {
            counter--;
            if(counter == 0){
                delete orders[menuId];
            }else{
                orders[menuId] = counter;
            }
        }
        
        $('input[type=text]#counter-' + menuId).val(counter);
            alert(JSON.stringify(orders));
        });

        //orders screen
        function notifyIncomingOrders(){
            $.ajax({
                url: "/orders/ajaxGetNewPendingOrders",
                method:"POST",
                dataType:"json",
                success:function(data){
                            if(parseInt(data) > 0){
                                if(parseInt(data) > 1){
                                    toastr["info"](data + " new pending orders!")
                                }
                                else{
                                    toastr["info"]("New pending order!")
                                }
                            }
                        },
                error:function(data){
                    console.error(data);
                }
            });
        }

        setInterval(function(){
            debugger;
            if($("#orders").length > 0){
                notifyIncomingOrders();
            }
        }, 5000);
    });
</script>
</body>
</html>