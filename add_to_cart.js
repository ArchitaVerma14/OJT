document.addEventListener("DOMContentLoaded", function() {
    // Add to Cart button event listener
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id'); // Get product ID
            addToCart(productId); // Call function to add product to cart
        });
    });

    // Function to add product to cart
    function addToCart(productId) {
        fetch('add_to_cart.php', {
            method: 'POST',
            body: JSON.stringify({ product_id: productId }),  // Send the product ID to the server
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  alert('Product added to cart!');
              } else {
                  alert('Failed to add product to cart');
              }
          });
    }
});
