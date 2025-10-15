<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function publicIndex()
    {
        $posts = Post::where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        return view('blog.public-index', compact('posts'));
    }

    public function publicShow($id)
    {
        $post = Post::where('status', 'published')
                   ->findOrFail($id);
        return view('blog.public-show', compact('post'));
    }

    public function index()
    {
        // Pengecekan manual tanpa middleware (alternatif)
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('blog.index', compact('posts'));
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
        
        return view('blog.create');
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
        
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'excerpt' => 'required|string|max:500',
                'status' => 'required|in:draft,published',
                'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=1920,max_height=1080',
            ]);

            $postData = [
                'title' => $request->title,
                'content' => $request->content,
                'excerpt' => $request->excerpt,
                'status' => $request->status,
                'author_id' => Auth::id(),
            ];

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                $imagePath = $request->file('featured_image')->store('blog-images', 'public');
                $postData['featured_image'] = $imagePath;
            }

            Post::create($postData);

            return redirect()->route('blog')->with('success', 'Post created successfully.');
        } catch (\Exception $e) {
            Log::error('Blog post creation error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to create post. Please try again.'])->withInput();
        }
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
        
        $post = Post::findOrFail($id);
        return view('blog.edit', compact('post'));
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
        
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'excerpt' => 'required|string|max:500',
                'status' => 'required|in:draft,published',
                'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=1920,max_height=1080',
            ]);

            $post = Post::findOrFail($id);
            
            $postData = [
                'title' => $request->title,
                'content' => $request->content,
                'excerpt' => $request->excerpt,
                'status' => $request->status,
            ];

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                // Hapus gambar lama jika ada
                if ($post->featured_image && Storage::exists('public/' . $post->featured_image)) {
                    Storage::delete('public/' . $post->featured_image);
                }
                
                $imagePath = $request->file('featured_image')->store('blog-images', 'public');
                $postData['featured_image'] = $imagePath;
            }

            $post->update($postData);

            return redirect()->route('blog')->with('success', 'Post updated successfully.');
        } catch (\Exception $e) {
            Log::error('Blog post update error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update post. Please try again.'])->withInput();
        }
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
        
        try {
            $post = Post::findOrFail($id);
            
            // Hapus gambar featured jika ada
            if ($post->featured_image && Storage::exists('public/' . $post->featured_image)) {
                Storage::delete('public/' . $post->featured_image);
            }
            
            $post->delete();
            
            return redirect()->route('blog')->with('success', 'Post deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Blog post delete error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete post. Please try again.']);
        }
    }
}