<x-app-layout>
    <div class="mx-auto w-[98%] ">
        <div class="flex justify-between items-center w-[90%] mx-auto my-8">
            <h1 class="text-2xl font-bold">Course List</h1>
            <button data-modal-target="course-modal" data-modal-toggle="course-modal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                type="button">
                Add Course
            </button>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-8 w-full overflow-x-auto">
            <table id="example" class="w-full text-left border-collapse">
                <thead>
                    <tr class="">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Fee</th>
                        <th class="px-4 py-2">Discount</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                    <tr class="border-t">
                        <form action="{{ route('courses.update', $course->id) }}" method="POST" class="update-form">
                            @csrf
                            @method('PUT')
                            <td class="px-4 py-2">{{ $course->id }}</td>
                            <td class="px-4 py-2">
                                <textarea name="name" class="w-full border border-gray-300 rounded px-2 py-1 resize-none" disabled>{{ $course->name }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="fee" class="w-full border border-gray-300 rounded px-2 py-1 resize-none" disabled>{{ $course->fee }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="discount" class="w-full border border-gray-300 rounded px-2 py-1 resize-none" disabled>{{ $course->discount }}</textarea>
                            </td>
                            <td class="px-4 py-2 flex space-x-2">
                                <button type="button" onclick="enableEdit(this)" class="bg-blue-900 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 hidden save-button">Save</button>
                        </form>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline">
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

    <!-- Add Course Modal -->
    <div id="course-modal" class="hidden fixed inset-0 z-50 overflow-y-auto flex items-center justify-center">
        <div class="relative w-full max-w-2xl mx-auto p-4">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex justify-between items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Add Course</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="course-modal">
                        ✖
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <form action="{{ route('courses.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
                            <input type="text" name="name" id="name" required
                                class="p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none"
                                placeholder="Course Name">
                        </div>
                        <div>
                            <label for="fee" class="block text-sm font-medium text-gray-700">Fee</label>
                            <input type="number" step="0.01" name="fee" id="fee" required
                                class="p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none"
                                placeholder="Course Fee">
                        </div>
                        <div>
                            <label for="discount" class="block text-sm font-medium text-gray-700">Discount (%)</label>
                            <input type="number" name="discount" id="discount"
                                class="p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none"
                                placeholder="Optional Discount">
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-500 to-teal-500 text-white py-3 px-6 rounded-lg font-semibold shadow-lg hover:from-blue-600 hover:to-teal-600 focus:ring focus:ring-green-200">
                            Add Course
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
    row.querySelectorAll('textarea').forEach(textarea => textarea.disabled = false);
    button.classList.add('hidden');
    row.querySelector('.save-button').classList.remove('hidden');
}

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.update-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            const textareas = form.querySelectorAll('textarea');
            textareas.forEach(textarea => textarea.disabled = false);
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
