<x-app-layout>
    <div class="mx-auto w-[98%]">
        <div class="flex justify-between items-center w-[90%] mx-auto my-8">
            <h1 class="text-2xl font-bold">Inventory</h1>
            <button data-modal-target="inventory-modal" data-modal-toggle="inventory-modal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                type="button">
                Add Inventory
            </button>
        </div>

        <div class="shadow-lg rounded-lg p-8 w-full overflow-x-auto">
            <table id="example" class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Item</th>
                        <th class="px-4 py-2">Quantity</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Location</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventory as $record)
                    <tr class="border-t">
                        <form action="{{ route('inventory.update', $record->id) }}" method="POST" class="update-form">
                            @csrf
                            @method('PUT')
                            <td class="px-4 py-2">{{ $record->id }}</td>
                            <td class="px-4 py-2">
                                <select name="item_id" class="w-full border border-gray-300 rounded px-2 py-1" disabled>
                                    @foreach($items as $item)
                                        <option value="{{ $item->item_id }}" {{ $item->item_id == $record->item_id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-2">
                                <input type="number" name="quantity" value="{{ $record->quantity }}" 
                                       class="w-full border border-gray-300 rounded px-2 py-1" disabled>
                            </td>
                            <td class="px-4 py-2">
                                <input type="number" step="0.01" name="price" value="{{ $record->price }}" 
                                       class="w-full border border-gray-300 rounded px-2 py-1" disabled>
                            </td>
                            <td class="px-4 py-2">
                                <input type="text" name="location" value="{{ $record->location }}" 
                                       class="w-full border border-gray-300 rounded px-2 py-1" disabled>
                            </td>
                            <td class="px-4 py-2 flex space-x-2">
                                <button type="button" onclick="enableEdit(this)" class="bg-blue-900 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 hidden save-button">Save</button>
                        </form>
                        <form action="{{ route('inventory.destroy', $record->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                        </form>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Inventory Modal -->
    <div id="inventory-modal" class="hidden fixed inset-0 z-50 overflow-y-auto flex items-center justify-center">
        <div class="relative w-full max-w-2xl mx-auto p-4">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex justify-between items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Add Inventory Record</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="inventory-modal">
                        ✖
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <form action="{{ route('inventory.store') }}" method="POST" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Column 1 -->
                        <div class="space-y-6">
                            <div>
                                <label for="item_id" class="block text-sm font-medium text-gray-700">Item</label>
                                <select name="item_id" id="item_id" required
                                    class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none">
                                    <option value="">Select Item</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->item_id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                <input type="number" name="quantity" id="quantity" required min="0"
                                    class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none"
                                    placeholder="Enter quantity">
                            </div>
                        </div>
                        
                        <!-- Column 2 -->
                        <div class="space-y-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" step="0.01" name="price" id="price" min="0"
                                    class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none"
                                    placeholder="Enter price">
                            </div>
                            
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" id="location"
                                    class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none"
                                    placeholder="Enter location">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-center">
                        <button type="submit"
                            class="w-full md:w-auto bg-gradient-to-r from-green-500 to-teal-500 text-white py-3 px-6 rounded-lg font-semibold shadow-lg hover:from-blue-600 hover:to-teal-600 focus:ring focus:ring-green-200">
                            Add Inventory
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function enableEdit(button) {
    const row = button.closest('tr');
    row.querySelectorAll('input, select').forEach(field => {
        field.disabled = false;
    });
    button.classList.add('hidden');
    row.querySelector('.save-button').classList.remove('hidden');
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.update-form').forEach(form => {
        form.addEventListener('submit', function (event) {
            const fields = form.querySelectorAll('input, select');
            fields.forEach(field => field.disabled = false);
        });
    });

    // Initialize modal toggle functionality
    const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');
    modalToggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-modal-target');
            const modal = document.querySelector(target);
            modal.classList.toggle('hidden');
        });
    });

    // Close modal when clicking outside
    const modals = document.querySelectorAll('[id$="-modal"]');
    modals.forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    });

    @if(session('success'))
    Toastify({
        text: "{{ session('success') }}",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
    }).showToast();
    @elseif(session('error'))
    Toastify({
        text: "{{ session('error') }}",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
    }).showToast();
    @endif
});
</script>