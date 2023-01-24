<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $blogs = Blog::all();

        if( $request->ajax() ) {
            return view('dashboard.blogs.table-data', compact('blogs'))->render();
        }

        return view('dashboard.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required|max:150',
                'cover_image' => 'required|mimes:jpg,png,jpeg',
            ]
        );

        $data = $request->all();

        // Upload Image
        if( $request->hasFile('cover_image') ) {
            $file = $request->file('cover_image'); // Give Me The File

            $image_path = $file->store('/uploads', [
                'disk' => 'public', // You Can Check It In config/filesystem.php
            ]);

            $data['cover_image'] = $image_path;
        }

        if( isset($data['status']) ) {
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }

        Blog::create($data);

        // I can use session instead of this toastr, but It is better for appearance
        toastr()->success('Blog Created Successfully');

        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $blog = Blog::find($id);

        return view('dashboard.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        // Validation
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required|max:150',
                'cover_image' => 'nullable|mimes:jpg,png,jpeg',
            ]
        );

        $data = $request->all();

        $image_path = null;
        if( !empty($data['cover_image']) ) {
            if( $request->hasFile('cover_image') ) {
                $file = $request->file('cover_image'); // Give Me The File

                $image_path = $file->store('/uploads', [
                    'disk' => 'public', // You Can Check It In config/filesystem.php
                ]);

                $data['cover_image'] = $image_path;
            }
        }else{
            $data = $request->except('cover_image');
        }

        if( isset($data['status']) ) {
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }

        $blog->update($data);

        // I can use session instead of this toastr, but It is better for appearance
        toastr()->success('Blog Updated Successfully');

        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $blog = Blog::find($request->id)->delete();
    }

    /**
     * @param Request $request
     * @return void
     * ? Change Status Of Blog ( Ajax Request )
     */
    public function changeStatus(Request $request)
    {
        $blog = Blog::find($request->id);

        if ($blog->status == 0) {
            $blog->update(['status' => 1]);
        } else {
            $blog->update(['status' => 0]);
        }
    }
}
