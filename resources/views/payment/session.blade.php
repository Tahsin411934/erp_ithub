<x-app-layout>
    <div class="mx-auto w-[98%] ">
        <div class="flex justify-between items-center w-[90%] mx-auto my-8">
            <h1 class="text-2xl font-bold">Select Session</h1>
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
                        <td class="px-4 py-2">
                            <a href="{{ route('due.students', ['batch' => $session->batch]) }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Select
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>