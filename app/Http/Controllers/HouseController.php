<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Agent;
use Exception;
use Illuminate\Http\Request;
use Throwable;

use Mail;

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
                'is_sold' => 0,
                'agent_id' => $request->agentID
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

        $house->agent->images;
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
    public function update(Request $request, $id)
    {
        //
       
        $house = House::find($id);
        $house->floor_area = $request->floor_area; 
        $house->lot_area = $request->lot_area;
        $house->price = $request->price;
        $house->title = $request->title;
        $house->description = $request->description;
        $house->street = $request->street;
        $house->city = $request->city;
        $house->province = $request->province;
        $house->country = $request->country;
        $house->beds = $request->beds;
        $house->bathroom = $request->bathroom;
        $house->listing_type = $request->listingType;
        $house->is_sold = 0;
        $house->agent_id = $request->agentID;
        $house->save();

        return response()->json(['house' => $house,'status' => 200], 200);

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

    public function sendEmail(Request $request)
    {   
        $data = array(
            'name'=> $request->name,
            'email' => $request->email
        );
        

        Mail::send(['html'=>'mail'], $data, function($message) use($request) {
           $message->to('audjeanrealty2020@gmail.com','audjeanrealty')->subject
              ("Hi I'm Interested");
           $message->from('arneljoshua.payongayon@unc.edu.ph','Arnel Joshua Payongayong');
        });
        // echo "Basic Email Sent. Check your inbox.";
      
        return "Success";
    }
}
