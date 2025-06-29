<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">New Sale</h1>
            <a href="{{ route('sales.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                View Sales History
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Product Selection -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Select Category</label>
                        <select id="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="product-search" class="block text-sm font-medium text-gray-700 mb-2">Search Products</label>
                        <input type="text" id="product-search" placeholder="Type to search..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div id="products-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Products will be loaded here -->
                    <div class="text-center py-12 text-gray-500 col-span-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <p class="mt-2">Select a category to view products</p>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                
                <div id="cart-items" class="space-y-4 mb-4 max-h-96 overflow-y-auto">
                    <div class="text-center text-gray-500 py-8" id="empty-cart-message">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <p class="mt-2">Your cart is empty</p>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mt-4">
                    <div class="flex justify-between">
                        <span class="text-lg font-medium">Total:</span>
                        <span id="total" class="text-lg font-bold text-blue-600">$0.00</span>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="customer-name" class="block text-sm font-medium text-gray-700 mb-2">Customer Name (Optional)</label>
                    <input type="text" id="customer-name" placeholder="Enter customer name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <button id="complete-sale" 
                    class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg shadow-sm transition-colors duration-200">
                    Complete Sale
                </button>
            </div>
        </div>
    </div>


    <script>
       
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');
            const productSearch = document.getElementById('product-search');
            const productsContainer = document.getElementById('products-container');
            const cartItems = document.getElementById('cart-items');
            const emptyCartMessage = document.getElementById('empty-cart-message');
            const totalElement = document.getElementById('total');
            const completeSaleBtn = document.getElementById('complete-sale');
            
            let cart = [];
            let products = [];

            // Load products by category
            categorySelect.addEventListener('change', function() {
                const categoryId = this.value;
                 console.log(categoryId)
                if (!categoryId) {
                    productsContainer.innerHTML = `
                        <div class="text-center py-12 text-gray-500 col-span-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <p class="mt-2">Select a category to view products</p>
                        </div>
                    `;
                    return;
                }

                fetch(`/sales/products-by-category/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        products = data;
                        renderProducts(data);
                    })
                    .catch(error => {
                        console.error('Error loading products:', error);
                        showError('Error loading products');
                    });
            });

            // Search products
            productSearch.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                if (!query) {
                    renderProducts(products);
                    return;
                }
                
                const filtered = products.filter(product => 
                    product.name.toLowerCase().includes(query)
                );
                renderProducts(filtered);
            });

            // Render products
            function renderProducts(products) {
                if (!products || products.length === 0) {
                    productsContainer.innerHTML = `
                        <div class="text-center py-12 text-gray-500 col-span-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2">No products found</p>
                        </div>
                    `;
                    return;
                }

                productsContainer.innerHTML = products.map(product => `
                    <div class="border rounded-lg p-4 flex flex-col hover:shadow-md transition-shadow">
                        <div class="flex justify-center mb-3">
                            <img src="${product.image}" alt="${product.name}" 
                                class="h-24 w-24 object-contain" onerror="this.src='/images/default-item.png'">
                        </div>
                        <h3 class="font-medium text-gray-900 mb-1 truncate">${product.name}</h3>
                        <p class="text-gray-600 mb-3">$${product.price.toFixed(2)}</p>
                        <div class="flex items-center mt-auto">
                            <input type="number" min="1" value="1" 
                                class="w-16 px-2 py-1 border border-gray-300 rounded mr-2 quantity-input">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm add-to-cart transition-colors" 
                                data-id="${product.id}"
                                data-name="${product.name}"
                                data-price="${product.price}">
                                Add
                            </button>
                        </div>
                    </div>
                `).join('');

                // Add event listeners to all add buttons
                document.querySelectorAll('.add-to-cart').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.getAttribute('data-id');
                        const productName = this.getAttribute('data-name');
                        const productPrice = parseFloat(this.getAttribute('data-price'));
                        const quantityInput = this.previousElementSibling;
                        const quantity = parseInt(quantityInput.value);

                        if (isNaN(quantity) || quantity < 1) {
                            showError('Please enter a valid quantity');
                            return;
                        }

                        addToCart(productId, productName, productPrice, quantity);
                        quantityInput.value = 1; // Reset quantity input
                    });
                });
            }

            // Add to cart function
            function addToCart(id, name, price, quantity) {
                const existingItem = cart.find(item => item.id === id);
                
                if (existingItem) {
                    existingItem.quantity += quantity;
                } else {
                    cart.push({
                        id: id,
                        name: name,
                        price: price,
                        quantity: quantity
                    });
                }

                updateCart();
                showSuccess(`${name} added to cart`);
            }

            // Update cart display
            function updateCart() {
                if (cart.length === 0) {
                    emptyCartMessage.classList.remove('hidden');
                    cartItems.innerHTML = '';
                    cartItems.appendChild(emptyCartMessage);
                    totalElement.textContent = '$0.00';
                    completeSaleBtn.disabled = true;
                    return;
                }

                emptyCartMessage.classList.add('hidden');
                completeSaleBtn.disabled = false;
                
                cartItems.innerHTML = cart.map(item => `
                    <div class="flex justify-between items-center border-b pb-3">
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium truncate">${item.name}</h4>
                            <p class="text-sm text-gray-600">$${item.price.toFixed(2)} × ${item.quantity}</p>
                        </div>
                        <div class="flex items-center ml-4">
                            <span class="font-medium whitespace-nowrap">$${(item.price * item.quantity).toFixed(2)}</span>
                            <button class="text-red-500 hover:text-red-700 ml-3 remove-item" data-id="${item.id}" title="Remove item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `).join('');

                // Calculate total
                const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                totalElement.textContent = `$${total.toFixed(2)}`;

                // Add event listeners to remove buttons
                document.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function() {
                        const itemId = this.getAttribute('data-id');
                        const item = cart.find(item => item.id === itemId);
                        cart = cart.filter(item => item.id !== itemId);
                        updateCart();
                        showSuccess(`${item.name} removed from cart`);
                    });
                });
            }

            // Complete sale
            completeSaleBtn.addEventListener('click', function() {
                if (cart.length === 0) {
                    showError('Please add at least one product to the cart');
                    return;
                }

                const customerName = document.getElementById('customer-name').value;
                
                // Show loading state
                completeSaleBtn.disabled = true;
                completeSaleBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                `;

                fetch('{{ route("sales.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        customer_name: customerName,
                        items: cart
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        window.location.href = data.redirect;
                    } else {
                        throw new Error(data.message || 'Error completing sale');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError(error.message || 'Error completing sale');
                    completeSaleBtn.disabled = false;
                    completeSaleBtn.textContent = 'Complete Sale';
                });
            });

            // Notification functions
            function showSuccess(message) {
                showNotification(message, 'bg-green-500');
            }

            function showError(message) {
                showNotification(message, 'bg-red-500');
            }

            function showNotification(message, bgColor) {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 ${bgColor} text-white px-4 py-2 rounded shadow-lg z-50 transition-opacity duration-300`;
                notification.textContent = message;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }
        });
    </script>
 
</x-app-layout>