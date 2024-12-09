document.getElementById("checkout-button").addEventListener("click", function () {
    const cartItems = JSON.parse(localStorage.getItem("cart")) || [];
    if (cartItems.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    fetch("checkout.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ cart: cartItems }),
    })
        .then((response) => response.text())
        .then((data) => {
            alert(data);
            localStorage.removeItem("cart");
            document.getElementById("cart-items").innerHTML = "";
            document.getElementById("cart-total").textContent = "0.00";
        })
        .catch((error) => console.error("Error:", error));
});
