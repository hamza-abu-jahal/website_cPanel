<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MainSection;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MainSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // There Is Only One Row In Main Section, Because Of This I Use ( first() )
        $main_section = MainSection::query()->first();

        return view('dashboard.main_section.index', compact('main_section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.main_section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required|max:150',
                'video_link' => 'required|url',
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

        MainSection::create($data);

        // I can use session instead of this toastr, but It is better for appearance
        toastr()->success('Main Section Created Successfully');

        return redirect()->route('main_section.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
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
        $main_section = MainSection::find($id);

        return view('dashboard.main_section.edit', compact('main_section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $main_section = MainSection::find($id);
        // Validation
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required|max:150',
                'video_link' => 'required|url',
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


        $main_section->update($data);

        // I can use session instead of this toastr, but It is better for appearance
        toastr()->success('Main Section Updated Successfully');

        return redirect()->route('main_section.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $main_section = MainSection::find($id);

        $all_sections = MainSection::all();
        // First One Can Not Delete
        if( $all_sections->count() == 1 ) {
            // I can use session instead of this toastr, but It is better for appearance
            toastr()->error('You Can Not Delete The First Section');

            return redirect()->route('main_section.index');
        }

        $main_section->delete();
        // I can use session instead of this toastr, but It is better for appearance
        toastr()->success('Main Section Deleted Successfully');

        return redirect()->route('main_section.index');
    }
}
