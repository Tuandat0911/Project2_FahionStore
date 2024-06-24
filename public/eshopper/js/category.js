
$(document).ready(function() {
// Khi người dùng nhấp vào liên kết danh mục
    $('.category_link').on('click', function() {
        var categoryName = $(this).data('category');

        $.ajax({
            url: '{{ route("searchCategory") }}', // Đường dẫn tới hàm xử lý trong controller
            method: 'GET',
            data: {
                name: categoryName,
                _token: '{{ csrf_token() }}' // Typically not needed for GET requests
            },
            success: function(response) {
                if(response.success) {
                    alert('Order placed successfully!');
                    window.location.href = '/shop';
                }
            },
            error: function(xhr) {
                console.error('Error updating cart:', xhr);
            }
        })
    })
})
