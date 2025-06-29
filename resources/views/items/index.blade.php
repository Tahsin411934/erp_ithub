<x-app-layout>
    <div class="mx-auto w-[98%]">
        <div class="flex justify-between items-center w-[90%] mx-auto my-8">
            <h1 class="text-2xl font-bold">Items</h1>
            <button data-modal-target="item-modal" data-modal-toggle="item-modal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                type="button">
                Add Item
            </button>
        </div>

        <div class="shadow-lg rounded-lg p-8 w-full overflow-x-auto">
            <table id="example" class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">UOM</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr class="border-t">
                        <form action="{{ route('items.update', $item->item_id) }}" method="POST" enctype="multipart/form-data" class="update-form">
                            @csrf
                            @method('PUT')
                            <td class="px-4 py-2">{{ $item->item_id }}</td>
                            <td class="px-4 py-2">
                                <textarea name="name" class="w-full border border-gray-300 rounded px-2 py-1 resize-none" disabled>{{ $item->name }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}" class="h-12 w-12 object-cover rounded">

                                <input type="file" name="image" class="hidden mt-2 w-full" disabled>
                            </td>
                            <td class="px-4 py-2">
                                <select name="category_id" class="w-full border border-gray-300 rounded px-2 py-1" disabled>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}" {{ $category->category_id == $item->category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="uom" class="w-full border border-gray-300 rounded px-2 py-1 resize-none" disabled>{{ $item->uom }}</textarea>
                            </td>
                            <td class="px-4 py-2 flex space-x-2">
                                <button type="button" onclick="enableEdit(this)" class="bg-blue-900 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 hidden save-button">Save</button>
                        </form>
                        <form action="{{ route('items.destroy', $item->item_id) }}" method="POST" class="inline">
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

   <div id="item-modal" class="hidden fixed inset-0 z-50 overflow-y-auto flex items-center justify-center">
        <div class="relative w-full max-w-2xl mx-auto p-4">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex justify-between items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Add New Item</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="item-modal">
                        ✖
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Column 1 -->
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Item Name</label>
                                <input type="text" name="name" id="name" required
                                    class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none"
                                    placeholder="e.g. Blue Pen, A4 Notebook">
                            </div>
                            
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category_id" id="category_id" required
                                    class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <!-- Column 2 -->
                        <div class="space-y-6">
                            <div>
                                <label for="uom" class="block text-sm font-medium text-gray-700">Unit of Measure</label>
                                <input type="text" name="uom" id="uom" required
                                    class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none"
                                    placeholder="e.g. piece, box, kg">
                            </div>
                            
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                <input type="file" name="image" id="image"
                                    class="mt-1 p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-center">
                        <button type="submit"
                            class="w-full md:w-auto bg-gradient-to-r from-green-500 to-teal-500 text-white py-3 px-6 rounded-lg font-semibold shadow-lg hover:from-blue-600 hover:to-teal-600 focus:ring focus:ring-green-200">
                            Add Item
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
    row.querySelectorAll('textarea, select, input[type="file"]').forEach(field => {
        field.disabled = false;
        if(field.classList.contains('hidden')) {
            field.classList.remove('hidden');
        }
    });
    button.classList.add('hidden');
    row.querySelector('.save-button').classList.remove('hidden');
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.update-form').forEach(form => {
        form.addEventListener('submit', function (event) {
            const fields = form.querySelectorAll('textarea, select, input[type="file"]');
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