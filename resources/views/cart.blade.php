<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

    <h1 class="text-3xl font-bold mb-6">Your Cart</h1>

    <div id="cart-items" class="space-y-4"></div>

    <div id="total" class="text-xl font-bold mt-6"></div>

    <script>
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const container = document.getElementById("cart-items");
        let total = 0;

        cart.forEach(item => {
            container.innerHTML += `
                <div class="bg-white p-5 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold">${item.name}</h2>
                        <p class="text-gray-600">Rs. ${item.price}</p>
                    </div>
                    <button onclick="removeItem(${item.id})"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                        Remove
                    </button>
                </div>
            `;
            total += item.price;
        });

        document.getElementById("total").textContent = "Total: Rs. " + total;

        function removeItem(id) {
            cart = cart.filter(i => i.id !== id);
            localStorage.setItem("cart", JSON.stringify(cart));
            location.reload();
        }
    </script>
    <div class="mt-8">
         <a href=""
       class="bg-primary-purple text-red px-6 py-3 rounded-lg font-semibold hover:bg-dark-purple transition">
        2026 Revision හා Paper Class දෙකටම මුදල් ගෙවීමේදී 5600 මුදලක් පෙන්වූවද 5000 පමනක් බැර කරන්න.
    </a>
   
    <a href="{{ route('checkout.page') }}"
       class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold
              hover:bg-red-400 transition">
        Proceed to Checkout
    </a>
</div>

    </div>


</body>
</html>
