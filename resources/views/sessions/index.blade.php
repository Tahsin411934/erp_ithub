<x-app-layout>
    <div class="mx-auto w-[98%] ">
        <div class="flex justify-between items-center w-[90%] mx-auto my-8">
            <h1 class="text-2xl font-bold">Session List</h1>
            <button data-modal-target="session-modal" data-modal-toggle="session-modal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                type="button">
                Add Session
            </button>
        </div>

        <div class=" shadow-lg rounded-lg p-8 w-full overflow-x-auto">
            <table id="example" class="w-full text-left border-collapse">
                <thead>
                    <tr class="">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Session</th>
                        <th class="px-4 py-2">Year</th>
                        <th class="px-4 py-2">Batch</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sessions as $session)
                    <tr class="border-t">
                        <form action="{{ route('sessions.update', $session->id) }}" method="POST" class="update-form">
                            @csrf
                            @method('PUT')
                            <td class="px-4 py-2">{{ $session->id }}</td>
                            <td class="px-4 py-2">
                                <textarea name="session" class="w-full border border-gray-300 rounded px-2 py-1 resize-none" disabled>{{ $session->session }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="year" class="w-full border border-gray-300 rounded px-2 py-1 resize-none" disabled>{{ $session->year }}</textarea>
                            </td>
                            <td class="px-4 py-2">
                                <textarea name="batch" class="w-full border border-gray-300 rounded px-2 py-1 resize-none" disabled>{{ $session->batch }}</textarea>
                            </td>
                            <td class="px-4 py-2 flex space-x-2">
                                <button type="button" onclick="enableEdit(this)" class="bg-blue-900 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 hidden save-button">Save</button>
                        </form>
                        <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" class="inline">
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

    <!-- Add Session Modal -->
    <div id="session-modal" class=" hidden fixed inset-0 z-50 overflow-y-auto flex items-center justify-center">
        <div class="relative w-full max-w-2xl mx-auto p-4">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex justify-between items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Add Session</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="session-modal">
                        ✖
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <form action="{{ route('sessions.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="session" class="block text-sm font-medium text-gray-700">Session</label>
                            <input type="text" name="session" id="session" required
                                class="p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none"
                                placeholder="e.g. january-June">
                        </div>
                        <div>
                            <label for="session" class="block text-sm font-medium text-gray-700">Year</label>
                            <input type="number" name="year" id="year" required
                                class="p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none"
                                placeholder="e.g. 2024">
                        </div>
                        <div>
                            <label for="batch" class="block text-sm font-medium text-gray-700">Batch</label>
                            <input type="text" name="batch" id="batch" required
                                class="p-3 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-200 focus:outline-none"
                                placeholder="e.g. A, B, C">
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-500 to-teal-500 text-white py-3 px-6 rounded-lg font-semibold shadow-lg hover:from-blue-600 hover:to-teal-600 focus:ring focus:ring-green-200">
                            Add Session
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

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.update-form').forEach(form => {
        form.addEventListener('submit', function (event) {
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
