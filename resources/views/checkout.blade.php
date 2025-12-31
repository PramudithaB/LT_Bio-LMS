<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-purple': '#ff0000',
                        'dark-purple': '#cc0000'
                    }
                }
            }
        }
    </script>

</head>

<body class="bg-gray-100 p-10">

    <h1 class="text-3xl font-bold mb-6">Checkout Summary</h1>

    <div id="cart-summary" class="space-y-4 bg-white p-6 rounded-xl shadow"></div>

    <h2 class="text-2xl font-bold mt-10 mb-4">Student Information</h2>

    <!-- Checkout Form -->
    <form action="{{ route('checkout.submit') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow space-y-4">
        @csrf

        <div>
            <label class="font-semibold">Student Name ( WebSite එකට Register වුන නම පමනක් ඇතුලත් කරන්න.) </label>
            <input type="text" name="student_name" class="w-full border p-3 rounded" required>
        </div>

      <div>
    <label class="font-semibold">Class Name</label>

    <!-- visible but locked -->
    <input
        type="text"
        id="class_name_display"
        class="w-full border p-3 rounded bg-gray-100 cursor-not-allowed"
        disabled
    >

    <!-- hidden value -->
    <input type="hidden" id="class_name" name="class_name">
</div>

       <div>
    <label class="font-semibold">Class ID</label>
    <input type="hidden" id="class_id" name="class_id">
</div>


        <div>
            <label class="font-semibold">Remark (Optional)</label>
            <textarea name="remark" class="w-full border p-3 rounded" rows="3"></textarea>
        </div>

        <div>
            <label class="font-semibold">Payment Slip (PDF or Image)</label>
            <input type="file" name="file" accept="application/pdf,image/*" class="w-full border p-3 rounded" required>
        </div>

        <!-- add hidden lesson id to track intended lesson (optional) -->
        <input type="hidden" id="lesson_id" name="lesson_id" value="">

        <button class="bg-primary-purple text-white px-6 py-3 rounded-lg hover:bg-dark-purple transition font-semibold">
            Complete Checkout
        </button>
    </form>


    <!-- Load Cart Data -->
    <script>
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        let container = document.getElementById("cart-summary");

        let total = 0;
        let selectedNames = [];
        let selectedIds = [];

        cart.forEach(item => {
            total += item.price;
            selectedNames.push(item.name);
            selectedIds.push(item.id);

            container.innerHTML += `
                <div class="flex justify-between bg-gray-50 border p-4 rounded-lg">
                    <span class="font-semibold">${item.name}</span>
                    <span class="text-primary-purple font-bold">Rs. ${item.price}</span>
                </div>
            `;
        });

        container.innerHTML += `
            <div class="text-xl font-bold mt-4 text-right">Total: Rs. ${total}</div>
        `;

        // Fill form fields automatically from cart
        document.getElementById("class_name").value = selectedNames.join(", ");
        document.getElementById("class_id").value = selectedIds.join(",");

        // If page opened with query params (from "Go to Video"), prefer those values
        const params = new URLSearchParams(window.location.search);
        if (params.has('class')) {
            // prefer single class id passed in query
            document.getElementById("class_id").value = params.get('class');
        }
        if (params.has('class_name')) {
            document.getElementById("class_name").value = decodeURIComponent(params.get('class_name'));
        }
        if (params.has('lesson')) {
            document.getElementById("lesson_id").value = params.get('lesson');
        }
    </script>

</body>
</html>
