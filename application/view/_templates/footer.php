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
    $(document).ready(function() {
        window.onscroll = function() {myFunction()};
        toastr.options = {
            "closeButton": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-full-width",
            "preventDuplicates": true,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "onclick": function(){location.reload();}
        }

        /* Login input transition */
        $('.field-wrap1 input').focus(function () {
            var $this = $(this),
            label = $this.prev('label');
            label.addClass('active highlight');
        }).blur(function () {
            var $this = $(this),
            label = $this.prev('label');
            if( $this.val() === '' ) {
                label.removeClass('active highlight'); 
            } else {
                label.removeClass('highlight');   
            }
        });

        $('.field-wrap2 input').focus(function () {
            var $this = $(this),
            label = $this.prev('label');
            label.addClass('active highlight');
        }).blur(function () {
            var $this = $(this),
            label = $this.prev('label');
            if( $this.val() === '' ) {
                label.removeClass('active highlight'); 
            } else {
                label.removeClass('highlight');   
            }
        });

        var navbar =  $("#navbar")[0];
        var sticky = navbar.offsetTop;

        var currentOrders = $('input[type=hidden]#orders').val();
        if( currentOrders !== "" && typeof currentOrders !== 'undefined'){
            var orders = JSON.parse(currentOrders);
        }else {
            var orders = [];
        }

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

        $('button.increase').click(function(e){
        e.preventDefault();
        var menuId = (this.id).split("-")[1];
        var menuName = document.getElementById("menu-name-" + menuId).value;
        var price = parseInt(document.getElementById("menu-price-" + menuId).value);
        var quantity = parseInt(document.getElementById("counter-" + menuId).value);
        quantity++;
        
        if (quantity > 1){
            var itemIndex = orders.findIndex(obj => obj.menuId == menuId);
            orders[itemIndex].quantity = quantity;
            orders[itemIndex].priceTotal = price * quantity; 
        }else{
            var item = {};
            item['menuId'] = menuId;
            item['menuName'] = menuName;
            item['price'] = price;
            item['quantity'] = quantity;
            item['priceTotal'] = price * quantity;
            orders.push(item);
        }     

        $('input[type=text]#counter-' + menuId).val(quantity);
        $('input[type=hidden]#orders').val(JSON.stringify(orders));
        $('input[type=hidden]#ordersAdd').val(JSON.stringify(orders));
        });
        
        $('button.decrease').click(function(e){
        e.preventDefault();
        var menuId = (this.id).split("-")[1];
        var menuName = document.getElementById("menu-name-" + menuId).value;
        var price = parseInt(document.getElementById("menu-price-" + menuId).value);
        var quantity = parseInt(document.getElementById("counter-" + menuId).value);

        if (quantity > 0) {
            quantity--;
            var itemIndex = orders.findIndex(obj => obj.menuId == menuId);

            if(quantity == 0){
                delete orders[itemIndex];
                orders = orders.filter(function(e){return e});
            }else{
                orders[itemIndex].quantity = quantity;
                orders[itemIndex].priceTotal = price * quantity;
            }
            $('input[type=text]#counter-' + menuId).val(quantity);
        }
        
        $('input[type=hidden]#orders').val(JSON.stringify(orders));
        $('input[type=hidden]#ordersAdd').val(JSON.stringify(orders));
        });

        $("#tableId").change(function(){
            $('input[type=hidden]#ordersTableId').val($('#tableId').val());
            $('input[type=hidden]#ordersTableDescription').val($('#tableId').find('option:selected').text());
        });

        ///TO DO: refactor scripts to be modular
        //orders screen
        function notifyPendingOrders(){
            $.ajax({
                url: "/palletpluscafe/orders/ajaxGetNewPendingOrders",
                method:"GET",
                dataType:"json",
                success:function(data){
                            if(parseInt(data) > 0){
                                if(parseInt(data) > 1){
                                    toastr["info"](data + " new pending orders! Click here to see updates.")
                                }
                                else{
                                    toastr["info"]("New pending order! Click here to see updates.")
                                }

                            }
                        },
                error:function(data){
                    console.error(data);
                }
            });
        }

        function notifyNewReadyOrders(){
            $.ajax({
                url: "/palletpluscafe/orders/ajaxGetNewReadyOrders",
                method:"GET",
                dataType:"json",
                success:function(data){
                            if(parseInt(data) > 0){
                                if(parseInt(data) > 1){
                                    toastr["info"](data + " new orders ready for serving! Click here to see updates.")
                                }
                                else{
                                    toastr["info"]("New order ready for serving! Click here to see updates.")
                                }

                            }
                        },
                error:function(data){
                    console.error(data);
                }
            });
        }

        function notifyNewPaymentOrders(){
            $.ajax({
                url: "/palletpluscafe/orders/ajaxGetNewPaymentOrders",
                method:"GET",
                dataType:"json",
                success:function(data){
                            if(parseInt(data) > 0){
                                if(parseInt(data) > 1){
                                    toastr["info"](data + " new orders ready for payment! Click here to see updates.")
                                }
                                else{
                                    toastr["info"]("New order ready for payment! Click here to see updates.")
                                }

                            }
                        },
                error:function(data){
                    console.error(data);
                }
            });
        }

        $('.btn-order-action').click(function(){
            $.ajax({
                url: "/palletpluscafe/orders/ajaxUpdateOrderStatus",
                method:"POST",
                data: {status: $(this).data('action'), id: $(this).data('id')},
                success:function(data){
                            location.reload();
                        },
                error:function(data){
                    console.error(data);
                }
            });
        });

        <?php Helper::enableNotification() ?>
    });
</script>
</body>
</html>