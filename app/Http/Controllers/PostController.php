<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;

            $posts = Post::with('provinces')
                ->where('local', 'LIKE', '%' . $search . '%')
                ->orWhere('latin', 'LIKE', '%' . $search . '%')
                ->orWhere('khasiat', 'LIKE', '%' . $search . '%')
                ->orWhere('dosis', 'LIKE', '%' . $search . '%')
                ->orWhere('mekanisme', 'LIKE', '%' . $search . '%')
                ->orWhere('dapus', 'LIKE', '%' . $search . '%')
                ->orWhere('link', 'LIKE', '%' . $search . '%')
                ->paginate(5);
        } else {
            $posts = Post::with('provinces')->paginate(5);
        }

        return view("admin.post.index", compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view("admin.post.post", ["category" => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "category_id" => "required | in:1,2,3,4",
            "category_name" => "required",
            "nama_rempah" => "required | max:50",
            "nama_latin" => "required | max:50",
            "slug" => "unique:posts",
            "foto_rempah" => "image | file | max:2048",
            "khasiat" => "required | max:50",
            "dosis" => "required | max:500",
            "mekanisme" => "required | max:500",
            "dapus" => "required",
            "link" => "required"
        ]);

        if ($request->file('foto_rempah')) {
            $validatedData['foto_rempah'] = $request->file('foto_rempah')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Post::create($validatedData);

        return redirect()->route('post.index')->with(['success' => 'Success! Data has been added.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $category = Category::all();
        return view("admin.post.edit", ["category" => $category, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $rules = [
            "category_id" => "required | in:1,2,3,4",
            "nama_rempah" => "required | max:50",
            "nama_latin" => "required | max:50",
            "foto_rempah" => "image | file | max:2048",
            "state_id" => "required | between:1, 33",
            "khasiat" => "required | max:50",
            "dosis" => "required | max:500",
            "mekanisme" => "required | max:500",
            "dapus" => "required",
            "link" => "required"
        ];

        // Update Slug
        if ($request->slug != $post->slug) {
            $rules["slug"] = "unique:posts";
        }

        // if ($request->has('category_name')) {
        //     $rules['category_name'] = 'required';
        // }

        $validatedData = $request->validate($rules);

        // Update Image
        if ($request->file('foto_rempah')) {
            if ($request->file('oldImage')) {
                Storage::delete($request->oldImage);
            }
            $validatedData['foto_rempah'] = $request->file('foto_rempah')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        $post = Post::updateOrCreate(['id' => $post->id], $validatedData);
        // if ($request->has('category_name')) {
        //     $post->category_name = $validatedData['category_name'];
        // }

        // $post->update($validatedData);

        return redirect()->route('post.index')->with(['success' => 'Success! Data has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        if ($post->foto_rempah) {
            Storage::delete($post->foto_rempah);
        }
        $post->delete();
        return redirect('/post')->with('success', 'Success! Your post has been deleted.');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->namarempah);

        return response()->json(['slug' => $slug]);
    }

    public function getCategoryDetails($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }
}
