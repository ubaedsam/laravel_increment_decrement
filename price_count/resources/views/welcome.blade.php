<!DOCTYPE html>
<html>
<head>
    <title>Adjust Quantity and Price</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="product">
        @foreach ($product as $item)
            <h2>{{ $item->name }}</h2>
            <div class="quantity">
                <button class="decrease" data-id="{{ $item->id }}"><i class="fas fa-minus"></i></button>
                <input type="text" value="1" class="quantity-input" data-id="{{ $item->id }}">
                <button class="increase" data-id="{{ $item->id }}"><i class="fas fa-plus"></i></button>
            </div>
            <div class="price" data-id="{{ $item->id }}">{{ $item->price }}</div>
        @endforeach
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.increase, .decrease').click(function() {
                let id = $(this).data('id');
                let quantityInput = $('.quantity-input[data-id="' + id + '"]');
                let currentQuantity = parseInt(quantityInput.val());
                let newQuantity = $(this).hasClass('increase') ? currentQuantity + 1 : currentQuantity - 1;

                if (newQuantity < 1) {
                    newQuantity = 1;
                }

                updateQuantity(id, newQuantity);
            });

            function updateQuantity(id, quantity) {
                $.ajax({
                    url: '/update-quantity',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.success) {
                            $('.quantity-input[data-id="' + id + '"]').val(quantity);
                            $('.price[data-id="' + id + '"]').text('$' + response.newPrice.toFixed(2));
                        } else {
                            alert('Could not update quantity');
                        }
                    },
                    error: function() {
                        alert('An error occurred');
                    }
                });
            }
        });
    </script>
</body>
</html>