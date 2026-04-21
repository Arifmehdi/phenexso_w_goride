<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $( document ).ready(function() {
        $(document).on("click", ".updateItem", function () {
            var that = $(this);
            var url = that.attr('data-url');

            var cart_qty = parseInt(that.attr('data-qty'));
            var new_qty;

            if (that.hasClass('plus')) {
                new_qty = cart_qty + 1;
            } else if (that.hasClass('minus')) {
                if (cart_qty <= 1) {
                    return false;
                }
                new_qty = cart_qty - 1;
            }

            $.ajax({
                url: url,
                method: "post",
                data: {
                    new_qty: new_qty,
                    item: that.data("url").split("/").pop(), // optional if needed
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if (result.status) {
                        $('#orderItemsWrapper').html(result.view);
                    } else {
                        alert(result.message || "Something went wrong.");
                    }
                },
                error: function () {
                    alert("Error occurred");
                }
            });
        });


    });





    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();
</script>
