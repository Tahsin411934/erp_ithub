<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show all students
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        $courses = Course::all();
        return view('students.create',compact('courses'));
    }

    // Store a new student
 public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'phone_number' => 'nullable|string|max:20',
        'father_name' => 'nullable|string|max:100',
        'mother_name' => 'nullable|string|max:100',
        'date_of_birth' => 'nullable|date',
        'course_id' => 'nullable|integer',
        'fee' => 'nullable|numeric',
        'session' => 'nullable|string|max:50',
        'batch' => 'nullable|string|max:255',
        'year' => 'nullable|string|max:20',
        'district' => 'nullable|string|max:255',
        'tana' => 'nullable|string|max:100',
        'vill' => 'nullable|string|max:100',
        'branc_code' => 'nullable|integer',
        'status' => 'nullable|string|max:50',
        'address' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'signature' => 'nullable|image|max:2048',
    ]);

    $student = new Student($request->except(['image', 'signature']));

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('students/images', 'public');
        $student->image = $imagePath;
    }

    if ($request->hasFile('signature')) {
        $signaturePath = $request->file('signature')->store('students/signatures', 'public');
        $student->signature = $signaturePath;
    }

    $student->save();

    return redirect()->back()->with('success', 'Student created successfully.');
}


    // Show a single student
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // Show edit form
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'father_name' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:20',
            'district' => 'nullable|string|max:255',
            'tana' => 'nullable|string|max:100',
            'vill' => 'nullable|string|max:100',
            'course_id' => 'nullable|integer',
            'fee' => 'nullable|numeric',
            'address' => 'nullable|string',
            'session' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:20',
            'signature' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'branc_code' => 'nullable|numeric',
            'date_of_birth' => 'nullable|date',
            'batch' => 'nullable|string|max:255',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Delete student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
