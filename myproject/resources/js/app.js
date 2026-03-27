import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
// Import and initialize your custom JavaScript code here
jQuery(document).ready(function() {
    // Your custom JavaScript code goes here
    console.log('Custom JavaScript is working!');
});

jQuery(document).ready(function() {
    // Handle the click event on the "Add to Cart" button
    jQuery('.add-to-cart').on('click', function() {
        var productId = jQuery(this).data('product-id');
        var quantity = jQuery(this).data('quantity') || 1; // Default to 1 if not specified

        // Send an AJAX request to add the product to the cart
        jQuery.ajax({
            url: '/cart/add', // Update with your actual route
            method: 'POST',
            data: {
                product_id: productId,
                quantity: quantity,
                _token: jQuery('meta[name="csrf-token"]').attr('content') // Include CSRF token
            },
            success: function(response) {
                // Handle success (e.g., update cart count, show a success message)
                console.log('Product added to cart:', response);
            },
            error: function(xhr, status, error) {
                // Handle error (e.g., show an error message)
                console.error('Error adding product to cart:', error);
            }
        });
    });
});
