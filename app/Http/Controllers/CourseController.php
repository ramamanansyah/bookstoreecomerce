<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->paginate(12);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        // Pengecekan manual
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        
        return view('courses.create');
    }

    public function store(Request $request)
    {
        // Pengecekan manual
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'level' => 'required|string|in:Pemula, Menengah, Lanjutan',
            'students_count' => 'nullable|integer|min:0',
            'lessons_count' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean', // Ubah dari nullable|boolean menjadi boolean
        ]);

        $courseData = [
            'title' => $request->title,
            'description' => $request->description,
            'level' => $request->level,
            'students_count' => $request->students_count,
            'lessons_count' => $request->lessons_count,
            'price' => $request->price,
            'is_featured' => $request->boolean('is_featured'), // Perbaikan ini
        ];

        // Handle image upload
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('course-images', 'public');
            $courseData['image_path'] = $imagePath;
        }

        Course::create($courseData);

        return redirect()->route('courses')->with('success', 'Course created successfully.');
    }

    public function edit($id)
    {
        // Pengecekan manual
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        // Pengecekan manual
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'level' => 'required|string|in:Pemula, Menengah, Lanjutan',
            'students_count' => 'nullable|integer|min:0',
            'lessons_count' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean', // Ubah dari nullable|boolean menjadi boolean
        ]);

        $course = Course::findOrFail($id);
        
        $courseData = [
            'title' => $request->title,
            'description' => $request->description,
            'level' => $request->level,
            'students_count' => $request->students_count,
            'lessons_count' => $request->lessons_count,
            'price' => $request->price,
            'is_featured' => $request->boolean('is_featured'), // Perbaikan ini
        ];

        // Handle image upload
        if ($request->hasFile('image_path')) {
            // Hapus gambar lama jika ada
            if ($course->image_path && Storage::exists('public/' . $course->image_path)) {
                Storage::delete('public/' . $course->image_path);
            }
            
            $imagePath = $request->file('image_path')->store('course-images', 'public');
            $courseData['image_path'] = $imagePath;
        }

        $course->update($courseData);

        return redirect()->route('courses')->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        // Pengecekan manual
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        
        $course = Course::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($course->image_path && Storage::exists('public/' . $course->image_path)) {
            Storage::delete('public/' . $course->image_path);
        }
        
        $course->delete();
        
        return redirect()->route('courses')->with('success', 'Course deleted successfully.');
    }
}