<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $field = $request->has('field') && in_array($request->input('field'), [
            'id',
            'title',
            'description'
        ]) ? $request->input('field') : 'id';

        $direction = $request->has('direction') && in_array($request->input('direction'), [
            'asc',
            'desc'
        ]) ? $request->input('direction') : 'desc';

        $blogs = Blog::when($request->has(['query', 'page']), function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('query') . '%')
                ->orWhere('title', 'like', '%' . $request->input('query') . '%')
                ->orWhere('description', 'like', '%' . $request->input('query') . '%');
        })->orderBy($field, $direction)
            ->where('user_id', auth()->id())->paginate(10);

        $blogs->appends(request()->query());

        return Inertia::render('Blog/Index', [
            'filters' => $request->all(['query', 'field', 'direction', 'page']),
            'blogs' => fn () => BlogResource::collection($blogs),
        ]);
    }

    public function edit(Request $request, Blog $blog)
    {
        return response()->json(['data' => $blog->only(['id', 'title', 'description'])], 200);
    }

    public function store(BlogStoreRequest $request)
    {
        auth()->user()->blogs()->create($request->validated());
        return redirect()->back()->with('success', 'Blog Created Successfully');
    }

    public function update(BlogUpdateRequest $request, Blog $blog)
    {
        $blog->update($request->validated());
        return redirect()->back()->with('success', 'Blog Updated Successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->back()->with('success', 'Blog Deleted Successfully');
    }
}