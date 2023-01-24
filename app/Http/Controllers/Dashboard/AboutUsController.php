<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $about_us = AboutUs::query()->first();

        return view('dashboard.about_us.index', compact('about_us'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.about_us.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate(
            [
                'title' => 'required',
                'main_image' => 'required|mimes:jpg,png,jpeg',
            ]
        );

        $data = $request->all();

        // Upload Image
        if( $request->hasFile('main_image') ) {
            $file = $request->file('main_image'); // Give Me The File

            $image_path = $file->store('/uploads', [
                'disk' => 'public', // You Can Check It In config/filesystem.php
            ]);

            $data['main_image'] = $image_path;
        }

        AboutUs::create($data);

        // I can use session instead of this toastr, but It is better for appearance
        toastr()->success('About Us Created Successfully');

        return redirect()->route('about_us.index');
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
        $about_us = AboutUs::find($id);
        return view('dashboard.about_us.edit', compact('about_us'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $about_us = AboutUs::find($id);
        // Validation
        $request->validate(
            [
                'title' => 'required',
                'main_image' => 'nullable|mimes:jpg,png,jpeg',
            ]
        );

        $data = $request->all();

        $image_path = null;
        if( !empty($data['main_image']) ) {
            if( $request->hasFile('main_image') ) {
                $file = $request->file('main_image'); // Give Me The File

                $image_path = $file->store('/uploads', [
                    'disk' => 'public', // You Can Check It In config/filesystem.php
                ]);

                $data['main_image'] = $image_path;
            }
        }else{
            $data = $request->except('main_image');
        }


        $about_us->update($data);

        // I can use session instead of this toastr, but It is better for appearance
        toastr()->success('About Us Updated Successfully');

        return redirect()->route('about_us.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $about_us = AboutUs::find($id);

        $all_about_us = AboutUs::all();
        // First One Can Not Delete
        if( $all_about_us ->count() == 1 ) {
            // I can use session instead of this toastr, but It is better for appearance
            toastr()->error('You Can Not Delete The First Section');

            return redirect()->route('about_us.index');
        }

        $about_us->delete();
        // I can use session instead of this toastr, but It is better for appearance
        toastr()->success('About Us Deleted Successfully');

        return redirect()->route('about_us.index');
    }
}
