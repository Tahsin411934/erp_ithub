<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-8 py-6">
            <h2 class="text-2xl font-bold text-gray-950">Add New Student</h2>
            <p class="text-gray-600 mt-1">Fill in the student details below</p>
        </div>

        <!-- Session Messages -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-8 mt-4" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any()))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mx-8 mt-4" role="alert">
                <p class="font-bold">Validation Errors</p>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Content -->
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf

            <!-- Student Info Section -->
            <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Student Information</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone_number" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Father's Name</label>
                        <input type="text" name="father_name" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Name</label>
                        <input type="text" name="mother_name" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <textarea name="address" rows="2" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                </div>
            </div>

            <!-- Academic Info Section -->
            <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Academic Information</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Course <span class="text-red-500">*</span></label>
                        <select name="course_id" id="course_id" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" data-fee="{{ $course->fee }}" data-discount="{{ $course->discount }}">
                                    {{ $course->name }} (৳{{ number_format($course->fee) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fee (৳) <span class="text-red-500">*</span></label>
                        <input type="number" name="fee" id="fee" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Discount (৳)</label>
                        <input type="number" name="discount" id="discount" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Payable Amount (৳)</label>
                        <input type="number" name="payable_amount" id="payable_amount" class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100" readonly>
                    </div>
                    
                    <!-- Payment Option -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Option</label>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <input id="pay_later" name="payment_option" type="radio" value="later" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <label for="pay_later" class="ml-2 block text-sm text-gray-700">Pay Later</label>
                            </div>
                            <div class="flex items-center">
                                <input id="pay_now" name="payment_option" type="radio" value="now" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <label for="pay_now" class="ml-2 block text-sm text-gray-700">Pay Now</label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Fields (Hidden by default) -->
                    <div id="payment_fields" class="hidden md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Paid Amount (৳)</label>
                            <input type="number" name="paid_amount" id="paid_amount" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Due Amount (৳)</label>
                            <input type="number" name="due_amount" id="due_amount" class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100" readonly>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Session <span class="text-red-500">*</span></label>
                        <select name="session_id" id="session_id" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Select Session</option>
                            @foreach($sessions as $session)
                                <option value="{{ $session->id }}" data-year="{{ $session->year }}" data-batch="{{ $session->batch }}">
                                    {{ $session->session }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                        <input type="text" name="year" id="year" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Batch</label>
                        <input type="text" name="batch" id="batch" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500" readonly>
                    </div>
                </div>
            </div>

            <!-- Additional Info Section -->
            <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Additional Information</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">District</label>
                        <input type="text" name="district" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Thana</label>
                        <input type="text" name="tana" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Village</label>
                        <input type="text" name="vill" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                   
                    
                </div>
            </div>

            <!-- Documents Section -->
            <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Documents</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Student Image</label>
                        <div class="mt-1 flex items-center">
                            <label for="image" class="cursor-pointer">
                                <span class="inline-block px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Upload Image
                                </span>
                                <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                            </label>
                            <span id="image-name" class="ml-2 text-sm text-gray-500">No file chosen</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Signature</label>
                        <div class="mt-1 flex items-center">
                            <label for="signature" class="cursor-pointer">
                                <span class="inline-block px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Upload Signature
                                </span>
                                <input id="signature" name="signature" type="file" accept="image/*" class="sr-only">
                            </label>
                            <span id="signature-name" class="ml-2 text-sm text-gray-500">No file chosen</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('students.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Save Student
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript for form functionality -->
    <script>
        // File input display
        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            document.getElementById('image-name').textContent = fileName;
        });

        document.getElementById('signature').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            document.getElementById('signature-name').textContent = fileName;
        });

        // Course selection handler
        document.getElementById('course_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const fee = selectedOption.getAttribute('data-fee');
            const discount = selectedOption.getAttribute('data-discount') || 0;
            
            document.getElementById('fee').value = fee;
            document.getElementById('discount').value = discount;
            calculatePayableAmount();
        });

        // Session selection handler
        document.getElementById('session_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const year = selectedOption.getAttribute('data-year');
            const batch = selectedOption.getAttribute('data-batch');
            
            document.getElementById('year').value = year || '';
            document.getElementById('batch').value = batch || '';
        });

        // Discount change handler
        document.getElementById('discount').addEventListener('input', calculatePayableAmount);

        // Payment option change handler
        document.querySelectorAll('input[name="payment_option"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const paymentFields = document.getElementById('payment_fields');
                if (this.value === 'now') {
                    paymentFields.classList.remove('hidden');
                    calculateDueAmount();
                } else {
                    paymentFields.classList.add('hidden');
                }
            });
        });

        // Paid amount change handler
        document.getElementById('paid_amount').addEventListener('input', calculateDueAmount);

        // Calculate payable amount
        function calculatePayableAmount() {
            const fee = parseFloat(document.getElementById('fee').value) || 0;
            const discount = parseFloat(document.getElementById('discount').value) || 0;
            const payableAmount = fee - discount;
            
            document.getElementById('payable_amount').value = payableAmount > 0 ? payableAmount : 0;
            
            // Recalculate due amount if payment fields are visible
            if (!document.getElementById('payment_fields').classList.contains('hidden')) {
                calculateDueAmount();
            }
        }

        // Calculate due amount
        function calculateDueAmount() {
            const payableAmount = parseFloat(document.getElementById('payable_amount').value) || 0;
            const paidAmount = parseFloat(document.getElementById('paid_amount').value) || 0;
            const dueAmount = payableAmount - paidAmount;
            
            document.getElementById('due_amount').value = dueAmount > 0 ? dueAmount : 0;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            calculatePayableAmount();
            
            // Show payment fields if "Pay Now" is selected by default
            if (document.getElementById('pay_now').checked) {
                document.getElementById('payment_fields').classList.remove('hidden');
                calculateDueAmount();
            }
        });
    </script>
</x-app-layout>