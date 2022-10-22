<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::all();
        return response()->json($addresses);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = \request()->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);
//
        if (request('image')) {
            $inputs['image'] = \request('image')->store('images');
        }

        $address = Address::create($inputs);
        return response()->json($inputs);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {

        $inputs = \request()->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
        ]);


        if (request('image')) {
            $inputs['image'] = \request('image')->store('images');
        }else {
            $inputs['image'] = $address->image;
        }

        $addres_data = $address->update($inputs);
        return response()->json('updated',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json("deleted");

    }
}
