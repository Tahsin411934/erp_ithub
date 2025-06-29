<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\PaymentHistory;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
public function dueStudents($batch)
{
    $students = Student::with('payment', 'paymentHistory')
        ->where('batch', $batch)
        ->whereHas('payment', function ($query) {
            $query->where('total_due', '>', 0);
        })
        ->get();

    return view('payment.due_students', compact('students', 'batch'));
}



    
    public function paymentHistory($studentId)
    {
        $student = Student::with('paymentHistory')->findOrFail($studentId);
        
        return response()->json($student->paymentHistory);
    }


public function store(Request $request, $student_id)
{
    // Validate the request
    $validated = $request->validate([
        'payment_amount' => 'required|numeric|min:0',
        'total_due' => 'required|numeric|min:0',
    ]);

    // Create payment history
    PaymentHistory::create([
        'student_id' => $student_id,
        'paid_amount' => $validated['payment_amount'],    
    ]);

    // Update payment record
    $payment = Payment::where('student_id', $student_id)->firstOrFail();
    $payment->total_due = $payment->total_due - $validated['payment_amount'];
    $payment->total_paid = $payment->total_paid + $validated['payment_amount'];
    $payment->save();

    // Get student data
    $student = Student::findOrFail($student_id);
    
    // Get payment history
    $paymentHistory = PaymentHistory::where('student_id', $student_id)->get();

    // Return JSON response for AJAX handling
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'print_url' => route('payment.print', $student_id),
        ]);
    }

    // For non-AJAX requests (fallback)
    return view('payment.slip', [
        'student' => $student,
        'payment' => $payment,
        'paymentHistory' => $paymentHistory,
        'payment_amount' => $validated['payment_amount'],
        'success' => 'Payment processed successfully'
    ]);
}

public function printSlip($student_id)
{
    // Get student data
    $student = Student::findOrFail($student_id);
    $payment = Payment::where('student_id', $student_id)->firstOrFail();
    $paymentHistory = PaymentHistory::where('student_id', $student_id)->get();

    return view('payment.slip', [
        'student' => $student,
        'payment' => $payment,
        'paymentHistory' => $paymentHistory,
    ]);
}
}