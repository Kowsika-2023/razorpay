<?php

namespace App\Http\Controllers;

use App\Models\Ajax;
use Illuminate\Http\Request;
use Log;
class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ajaxes = Ajax::all();
        return view('backendviews.ajaxes.ajaxes',compact('ajaxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backendviews.ajaxes.add_ajax');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info("store func");
        $validatedData = $request->validate([
            'name' => 'required',
            'email'=>'required|unique:ajaxes,email',
            'message' => 'required',
            'mobile' => 'required',
            
                    ]);

                    $ajax =new Ajax;
                    $ajax->name = $request->name;
                    $ajax->email = $request->email;
                    $ajax->message = $request->message;
                    $ajax->mobile = $request->mobile;
                    $ajax->save();
                    return response()->json(['success' => true]);
            
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
