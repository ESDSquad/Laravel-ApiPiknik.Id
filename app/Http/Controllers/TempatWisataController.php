<?php

namespace App\Http\Controllers;

use App\Models\TempatWisata;
use App\Models\Review;
use Illuminate\Http\Request;

class TempatWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return TempatWisata::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TempatWisata  $tempatWisata
     * @return \Illuminate\Http\Response
     */
    public function show(TempatWisata $tempatWisata,$id)
    {
       $findid = TempatWisata::with('review.user')->find($id);
        return $findid;
    }


    public function image($fileName){

        $path = public_path().'/images/'.$fileName;
        return response()->download($path);    
          
    }

    public function map($fileName){

        $path = public_path().'/mapimages/'.$fileName;
        return response()->download($path);    
          
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TempatWisata  $tempatWisata
     * @return \Illuminate\Http\Response
     */
    public function edit(TempatWisata $tempatWisata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TempatWisata  $tempatWisata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TempatWisata $tempatWisata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TempatWisata  $tempatWisata
     * @return \Illuminate\Http\Response
     */
    public function destroy(TempatWisata $tempatWisata)
    {
        //
    }
}
