<x-app-layout>
    <div class="mx-auto w-[98%]">
        <div class="flex justify-between items-center w-[90%] mx-auto my-8">
            <h1 class="text-2xl font-bold">Due Students - Batch {{ $batch }}</h1>
        </div>

        <div class="shadow-lg rounded-lg p-8 w-full overflow-x-auto">
            <table id="example" class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">SL</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Total Payable</th>
                        <th class="px-4 py-2">Total Paid</th>
                        <th class="px-4 py-2">Current Due</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $key => $student)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $key + 1 }}</td>
                        <td class="px-4 py-2">
                            <div class="w-full border border-gray-300 rounded px-2 py-1">{{ $student->name }}</div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="w-full border border-gray-300 rounded px-2 py-1">{{ number_format($student->payment->total_payable ?? 0, 2) }}</div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="w-full border border-gray-300 rounded px-2 py-1">{{ number_format($student->payment->total_paid ?? 0, 2) }}</div>
                        </td>
                        <td class="px-4 py-2 font-medium {{ ($student->payment->total_due ?? 0) > 0 ? 'text-red-600' : 'text-green-600' }}">
                            <div class="w-full border border-gray-300 rounded px-2 py-1">{{ number_format($student->payment->total_due ?? 0, 2) }}</div>
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <button onclick="showPaymentHistory({{ $student->id }}, '{{ $student->name }}')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                History
                            </button>
                            <button onclick="showPayNowModal({{ $student->id }}, '{{ $student->name }}', {{ $student->payment->total_due ?? 0 }})"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Pay Now
                            </button>
 <a href="{{ url('/duepayment/save/' . $student->id) }}" target="_blank" class="bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Slip Print</a>


                            <!-- Hidden payment history data -->
                            <div id="history-data-{{ $student->id }}" class="hidden">
                                @if($student->paymentHistory && count($student->paymentHistory) > 0)
                                    @foreach($student->paymentHistory as $history)
                                    <div data-date="{{ $history->created_at->format('d M Y h:i A') }}" 
                                         data-amount="{{ number_format($history->paid_amount, 2) }}"></div>
                                    @endforeach
                                @else
                                    <div data-empty="true"></div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payment History Modal -->
    <div id="paymentHistoryModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Payment History - <span id="studentName"></span>
                            </h3>
                            <div class="mt-4">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount Paid</th>
                                            </tr>
                                        </thead>
                                        <tbody id="historyTableBody" class="bg-white divide-y divide-gray-200">
                                            <!-- History data will be inserted here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeModal('paymentHistoryModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pay Now Modal -->
    <div id="payNowModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="paymentForm" method="POST" action="" target="paymentTab">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="payNowModalTitle">
                                    Make Payment - <span id="payNowStudentName"></span>
                                </h3>
                                <div class="mt-4">
                                    <div class="mb-4">
                                        <label for="totalDue" class="block text-sm font-medium text-gray-700">Total Due:</label>
                                        <input type="text" id="totalDue" name="total_due" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-100" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="paymentAmount" class="block text-sm font-medium text-gray-700">Payment Amount:</label>
                                        <input type="number" id="paymentAmount" name="payment_amount" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required min="0.01" step="0.01">
                                    </div>
                                    <div class="mb-4">
                                        <label for="remainingDue" class="block text-sm font-medium text-gray-700">Remaining Due:</label>
                                        <input type="text" id="remainingDue" name="remaining_due" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-100" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Confirm Payment
                        </button>
                        <button type="button" onclick="closeModal('payNowModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Payment History Modal
        function showPaymentHistory(studentId, studentName) {
            document.getElementById('studentName').textContent = studentName;
            const historyContainer = document.getElementById(`history-data-${studentId}`);
            const tableBody = document.getElementById('historyTableBody');
            tableBody.innerHTML = '';
            
            if (historyContainer.querySelector('[data-empty="true"]')) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No payment history found
                        </td>
                    </tr>
                `;
            } else {
                historyContainer.querySelectorAll('div[data-date]').forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.getAttribute('data-date')}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.getAttribute('data-amount')}</td>
                    `;
                    tableBody.appendChild(row);
                });
            }
            
            document.getElementById('paymentHistoryModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
        
        // Pay Now Modal
        function showPayNowModal(studentId, studentName, totalDue) {
            document.getElementById('payNowStudentName').textContent = studentName;
            document.getElementById('totalDue').value = totalDue.toFixed(2);
            document.getElementById('paymentAmount').value = '';
            document.getElementById('remainingDue').value = totalDue.toFixed(2);
            
            const form = document.getElementById('paymentForm');
            form.action = `/duepayment/save/${studentId}`;
            
            document.getElementById('payNowModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            
            document.getElementById('paymentAmount').addEventListener('input', function() {
                const paymentAmount = parseFloat(this.value) || 0;
                const totalDue = parseFloat(document.getElementById('totalDue').value) || 0;
                const remainingDue = Math.max(0, totalDue - paymentAmount);
                document.getElementById('remainingDue').value = remainingDue.toFixed(2);
            });
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
        
        // Close modals when clicking outside
        document.getElementById('paymentHistoryModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal('paymentHistoryModal');
        });
        
        document.getElementById('payNowModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal('payNowModal');
        });

        // Form validation and submission
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const paymentAmount = parseFloat(document.getElementById('paymentAmount').value);
            const totalDue = parseFloat(document.getElementById('totalDue').value);
            
            if (!paymentAmount || paymentAmount <= 0) {
                e.preventDefault();
                alert('Please enter a valid payment amount');
                return;
            }
            
            if (paymentAmount > totalDue) {
                e.preventDefault();
                alert('Payment amount cannot be greater than total due');
                return;
            }
            
            // Close modal immediately after submission
            closeModal('payNowModal');
            
            // Reset form after a short delay
            setTimeout(() => {
                document.getElementById('paymentAmount').value = '';
                document.getElementById('remainingDue').value = totalDue.toFixed(2);
            }, 500);
        });

        // Initialize DataTable if available
        if (typeof $.fn.DataTable === 'function') {
            $(document).ready(function() {
                $('#example').DataTable();
            });
        }
    </script>
</x-app-layout>