// Fetch merchandise based on selected filters
async function fetchMerchandise() {
    const merchType = document.getElementById('merch_type').value;
    const albumCollection = document.getElementById('album_collection').value;

    const response = await fetch('fetch_merch.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ merch_type: merchType, album_collection: albumCollection })
    });

    const data = await response.json();
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
                id: this.getAttribute('data-item-id'),
                name: this.getAttribute('data-item-name'),
                price: parseFloat(this.getAttribute('data-item-price')),
                image: this.getAttribute('data-item-image-ref'),
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
