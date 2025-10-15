<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(12);
        return view('books.index', compact('books'));
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
        
        return view('books.create');
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
            'author' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240', // Max 10MB
            'rating' => 'nullable|integer|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'is_featured' => 'boolean', // Ubah dari nullable|boolean menjadi boolean
        ]);

        $bookData = [
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'price' => $request->price,
            'rating' => $request->rating,
            'review_count' => $request->review_count,
            'is_featured' => $request->boolean('is_featured'), // Perbaikan ini
        ];

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('book-covers', 'public');
            $bookData['cover_image'] = $imagePath;
        }

        // Handle PDF file upload
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('book-pdfs', 'public');
            $bookData['pdf_file'] = $pdfPath;
        }

        Book::create($bookData);

        return redirect()->route('books')->with('success', 'Book created successfully.');
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
        
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
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
            'author' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240', // Max 10MB
            'rating' => 'nullable|integer|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'is_featured' => 'boolean', // Ubah dari nullable|boolean menjadi boolean
        ]);

        $book = Book::findOrFail($id);
        
        $bookData = [
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'price' => $request->price,
            'rating' => $request->rating,
            'review_count' => $request->review_count,
            'is_featured' => $request->boolean('is_featured'), // Perbaikan ini
        ];

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama jika ada
            if ($book->cover_image && Storage::exists('public/' . $book->cover_image)) {
                Storage::delete('public/' . $book->cover_image);
            }
            
            $imagePath = $request->file('cover_image')->store('book-covers', 'public');
            $bookData['cover_image'] = $imagePath;
        }

        // Handle PDF file upload
        if ($request->hasFile('pdf_file')) {
            // Hapus file PDF lama jika ada
            if ($book->pdf_file && Storage::exists('public/' . $book->pdf_file)) {
                Storage::delete('public/' . $book->pdf_file);
            }
            
            $pdfPath = $request->file('pdf_file')->store('book-pdfs', 'public');
            $bookData['pdf_file'] = $pdfPath;
        }

        $book->update($bookData);

        return redirect()->route('books')->with('success', 'Book updated successfully.');
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
        
        $book = Book::findOrFail($id);
        
        // Hapus gambar cover jika ada
        if ($book->cover_image && Storage::exists('public/' . $book->cover_image)) {
            Storage::delete('public/' . $book->cover_image);
        }
        
        // Hapus file PDF jika ada
        if ($book->pdf_file && Storage::exists('public/' . $book->pdf_file)) {
            Storage::delete('public/' . $book->pdf_file);
        }
        
        $book->delete();
        
        return redirect()->route('books')->with('success', 'Book deleted successfully.');
    }
}