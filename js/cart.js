const cart = [];

// Add to cart function
function addToCart(item) {
    const cartItemsList = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');

    // Check if the item already exists in the cart
    const existingItem = cart.find(cartItem => cartItem.item_id === item.item_id);

    if (existingItem) {
        // If item exists, increase the quantity
        existingItem.quantity += 1;
    } else {
        // If item does not exist, add it to the cart with quantity 1
        cart.push({ ...item, quantity: 1 });
    }

    // Update the cart UI
    cartItemsList.innerHTML = cart.map(cartItem => `
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <img src="${cartItem.item_image_ref}" alt="${cartItem.name}" style="width: 50px; height: 50px; object-fit: cover;" class="me-3">
            <span>${cartItem.name} (x${cartItem.quantity})</span>
            <span>€${(cartItem.price * cartItem.quantity).toFixed(2)}</span>
        </li>
    `).join('');

    // Update total
    const total = cart.reduce((sum, cartItem) => sum + cartItem.price * cartItem.quantity, 0);
    cartTotal.textContent = total.toFixed(2);
}

// Clear cart function
function clearCart() {
    // Reset the cart array
    cart.length = 0;

    // Update the cart UI
    const cartItemsList = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    
    // Clear the items and total
    cartItemsList.innerHTML = '';
    cartTotal.textContent = '0.00';
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

// Checkout function
async function checkoutItems() {
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    // Prepare the data for the order
    const formData = new FormData();
    formData.append('total', document.getElementById('cart-total').textContent);

    cart.forEach((item, index) => {
        formData.append(`items[${index}][item_id]`, item.item_id);
        formData.append(`items[${index}][quantity]`, item.quantity);
        formData.append(`items[${index}][price]`, item.price);
    });
    

    try {
        const response = await fetch('checkout.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.text(); // Parse as plain text

        if (result.includes("Order placed successfully")) {
            alert(result); // Success message
            clearCart(); // Optionally clear the cart
        } else {
            alert('Checkout failed: ' + result); // Error message
        }
    } catch (error) {
        console.error('Error during checkout:', error);
        alert('An error occurred while processing your order. Please try again.');
    }
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
