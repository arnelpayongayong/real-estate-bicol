<?php

namespace App\Http\Controllers;

use App\Models\House;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $houses =  House::all();

        foreach($houses as $house)
        {
            //
            foreach($house->images as $image)
            {
                //
            }
        }

        return response()->json([
            'houses' => $houses
        ],200);
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
        $house = '';
        try{
            $house = House::create([
                'floor_area' => $request->floor_area, 
                'lot_area' => $request->lot_area,
                'price' => $request->price,
                'title' => $request->title,
                'description' => $request->description,
                'street' => $request->street,
                'city' => $request->city,
                'province' => $request->province,
                'country' => $request->country,
                'beds' => $request->beds,
                'bathroom' => $request->bathroom,
                'listing_type' => $request->listingType,
                'is_sold' => 0
                ]);
        }
        catch(Throwable $e){
            return response($e,'500');
        }



        return response([
            'house' => $house,
            'status' => '200'
        ]
        ,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $house = House::find($id);

        foreach($house->images as $image)
        {

        }
        foreach($house->features as $feature)
        {
            
        }

        return $house;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        //
    }
}
