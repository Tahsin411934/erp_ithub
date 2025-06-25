<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Display a listing of the courses
    public function index()
    {
        $courses = Course::latest()->get();
        return view('courses.index', compact('courses'));
    }

    // Store a newly created course in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fee' => 'required|numeric',
            'discount' => 'nullable|integer|min:0|max:100',
        ]);

        Course::create($request->only('name', 'fee', 'discount'));

        return redirect()->route('courses.index')->with('success', 'Course added successfully.');
    }

  
    // Update the specified course in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fee' => 'required|numeric',
            'discount' => 'nullable|integer|min:0|max:100',
        ]);

        $course = Course::findOrFail($id);
        $course->update($request->only('name', 'fee', 'discount'));

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    // Remove the specified course from storage
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
