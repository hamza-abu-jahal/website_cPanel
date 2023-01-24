<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $services = Service::all();

        if( $request->ajax() ) {
            return view('dashboard.services.table-data', compact('services'))->render();
        }

        return view('dashboard.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.services.create');
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
                'description' => 'required|max:150',
                'icon' => 'required|mimes:jpg,png,jpeg',
            ]
        );

        $data = $request->all();

        // Upload Image
        if( $request->hasFile('icon') ) {
            $file = $request->file('icon'); // Give Me The File

            $image_path = $file->store('/uploads', [
                'disk' => 'public', // You Can Check It In config/filesystem.php
            ]);

            $data['icon'] = $image_path;
        }

        if( isset($data['status']) ) {
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }

        Service::create($data);

        // I can use session instead of this toastr, but It is better for appearance
        toastr()->success('Service Created Successfully');

        return redirect()->route('service.index');
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
        $service = Service::find($id);

        return view('dashboard.services.edit', compact('service'));
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
        $service = Service::find($id);

        // Validation
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required|max:150',
                'icon' => 'nullable|mimes:jpg,png,jpeg',
            ]
        );

        $data = $request->all();

        $image_path = null;
        if( !empty($data['icon']) ) {
            if( $request->hasFile('icon') ) {
                $file = $request->file('icon'); // Give Me The File

                $image_path = $file->store('/uploads', [
                    'disk' => 'public', // You Can Check It In config/filesystem.php
                ]);

                $data['icon'] = $image_path;
            }
        }else{
            $data = $request->except('icon');
        }

        if( isset($data['status']) ) {
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }

        $service->update($data);

        // I can use session instead of this toastr, but It is better for appearance
        toastr()->success('Service Updated Successfully');

        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $service = Service::find($request->id)->delete();

        return redirect()->route('service.index');
    }

    /**
     * @param Request $request
     * @return void
     * ? Change Status Of Service ( Ajax Request )
     */
    public function changeStatus(Request $request)
    {
        $service = Service::find($request->id);

        if ( $service->status == 0 ){
            $service->update(['status' => 1]);
        }else{
            $service->update(['status' => 0]);
        }
    }
}
