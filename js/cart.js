const cart = [];

// Add to cart function
function addToCart(item) {
    const cartItemsList = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');

    // Send item to PHP session via AJAX
    fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(item),
    })
    .then(response => response.json())
    .then(data => {
        // Update the cart UI with new data from the server
        if (data.success) {
            // Update the UI
            updateCartUI(data.cart);
        }
    })
    .catch(error => console.error('Error adding item to cart:', error));
}

// Fetch and display cart items from the session (via PHP)
function loadCart() {
    fetch('get_cart.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartUI(data.cart);
            }
        })
        .catch(error => console.error('Error fetching cart:', error));
}

// Update cart UI function
function updateCartUI(cartData) {
    const cartItemsList = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');

    cartItemsList.innerHTML = cartData.map(cartItem => `
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <img src="${cartItem.item_image_ref}" alt="${cartItem.name}" style="width: 50px; height: 50px; object-fit: cover;" class="me-3">
            <span>${cartItem.name} (x${cartItem.quantity})</span>
            <span>€${(cartItem.price * cartItem.quantity).toFixed(2)}</span>
        </li>
    `).join('');

    // Update total
    const total = cartData.reduce((sum, cartItem) => sum + cartItem.price * cartItem.quantity, 0);
    cartTotal.textContent = total.toFixed(2);
}

// Clear cart function
function clearCart() {
    fetch('clear_cart.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reset UI after clearing cart
                updateCartUI([]);
            }
        })
        .catch(error => console.error('Error clearing cart:', error));
}

// Checkout function
function checkoutItems() {
    fetch('get_cart.php')  // Fetch current cart before checkout
        .then(response => response.json())
        .then(data => {
            if (data.success && data.cart.length > 0) {
                // Send cart data to localStorage (optional) or directly to PHP
                sessionStorage.setItem('cart', JSON.stringify(data.cart));  // Use sessionStorage instead
                window.location.href = 'billing-info.php';
            } else {
                alert('Your cart is empty!');
            }
        })
        .catch(error => console.error('Error fetching cart for checkout:', error));
}

// Fetch and update merchandise dynamically
async function fetchMerchandise() {
    const merchType = document.getElementById('merch_type').value;
    const albumCollection = document.getElementById('album_collection').value;

    const formData = new FormData();
    formData.append('merch_type', merchType);
    formData.append('album_collection', albumCollection);

    const response = await fetch('fetch_merch.php', {
        method: 'POST',
        body: formData
    });

    const data = await response.json(); // Assuming the server returns JSON
    updateMerchandiseList(data);
}

// Update merchandise list dynamically
function updateMerchandiseList(items) {
    const merchandiseList = document.getElementById('merchandise-list');
    merchandiseList.innerHTML = ''; // Clear existing items

    if (items.length === 0) {
        merchandiseList.innerHTML = '<p class="text-center">No products found.</p>';
        return;
    }

    items.forEach(item => {
        const card = `
            <div class="col-md-3">
                <div class="card">
                    <img src="${item.item_image_ref}" class="card-img-top" alt="${item.name}">
                    <div class="card-body">
                        <h5 class="card-title">${item.name}</h5>
                        <p class="card-text">${item.description.substring(0, 100)}...</p>
                        <p class="fw-bold">Price: €${item.price}</p>
                        <button 
                            class="btn btn-dark add-to-cart" 
                            data-item-id="${item.item_id}" 
                            data-item-name="${item.name}" 
                            data-item-price="${item.price}" 
                            data-item-image-ref="${item.item_image_ref}" 
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#cartOffcanvas">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        `;
        merchandiseList.innerHTML += card;
    });

    // Attach event listeners to buttons
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function () {
            const item = {
                item_id: this.getAttribute('data-item-id'),
                name: this.getAttribute('data-item-name'),
                price: parseFloat(this.getAttribute('data-item-price')),
                item_image_ref: this.getAttribute('data-item-image-ref'),
            };

            // Call the addToCart function for the correct item
            addToCart(item);
        });
    });
}

// Listen for filter changes
document.getElementById('merch_type').addEventListener('change', fetchMerchandise);
document.getElementById('album_collection').addEventListener('change', fetchMerchandise);

// Initial fetch on page load
fetchMerchandise();

// Clear cart button listener
document.getElementById('clear-cart').addEventListener('click', clearCart);

// Checkout button listener
document.getElementById('checkout-button').addEventListener('click', checkoutItems);

// Load the cart when the page is ready
loadCart();
