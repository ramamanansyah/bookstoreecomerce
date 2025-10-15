<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Book;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::where('is_featured', true)->limit(6)->get();
        $topBooks = Book::where('is_featured', true)->limit(6)->get();
        $testimonials = Testimonial::orderBy('created_at', 'desc')->limit(3)->get();

        return view('pages.home', compact('featuredCourses', 'topBooks', 'testimonials'));
    }

    public function courses()
    {
        $courses = Course::orderBy('created_at', 'desc')->paginate(12);
        return view('pages.courses', compact('courses'));
    }

    public function books()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(12);
        return view('pages.books', compact('books'));
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function testimonials()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        return view('pages.testimonials', compact('testimonials'));
    }
}