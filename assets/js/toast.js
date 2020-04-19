var Toaster = function () {
toastr.options =
          {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "300",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }

    var addToCart = function () {
            toastr.remove();
            toastr.options.positionClass = "toast-top-right";
            toastr.success('Order Added to cart successfully', 'Success');
    }

    var removeFromCart = function () {
            toastr.remove();
            toastr.options.positionClass = "toast-top-right";
            toastr.success('Order deleted successfully', 'Success');
    }

    var Checkout = function () {
            toastr.remove();
            toastr.options.positionClass = "toast-top-right";
            toastr.success('Checkout Successfully', 'Success');
    }
    return{
        addtocart: function () {
            addToCart();
            if (addToCart) {
                setTimeout(function(){
                window.location = "http://localhost/SnacksStation/checkout.php";
                },2000);
            }
        },
        removefromcart: function () {
            removeFromCart();
            if (removeFromCart) {
                setTimeout(function(){
                window.location = "http://localhost/SnacksStation/index.php";
                },2000);
            }
        },
        checkoutt: function(){
            Checkout();
            if (Checkout) {
                setTimeout(function(){
                window.location = "http://localhost/SnacksStation/order-details.php";
                },2000);
            }
        }
    }
}();