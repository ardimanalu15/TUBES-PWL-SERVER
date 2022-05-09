<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Vilager;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Services::select( 'id','vilager_id',
        'topic',
        'content',
        'status',
        'contact')->get();
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
        $request->validate([
        'nik'  => 'required',
        'topic'  => 'required',
        'content'  => 'required',
        'status'  => 'required',
        'contact'  => 'required'           
        ]);
        $validatedForVilager = $request->validate([
            'topic'  => 'required',
            'content'  => 'required',
            'status'  => 'required',
            'contact'  => 'required'           
            ]);
        try{                    
            $vilager = Vilager::where('nik', $request->nik)->first(); 
            $service = new Services($validatedForVilager);
            // $vilager->services()->create($validatedForVilager);    
            $service->vilager()->associate($vilager)->save();            
            return response()->json([
                'message'=>'Services Created Successfully!!',
                'service'  => $service,  
            ]);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while creating a Vilager!!'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Services $services)
    {
        return response()->json([
            'services'=>$services
        ]);
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
    public function update(Request $request, $services)
    {
        
        try{
                     $request->validate([
                        'nik'  => 'required',
                        'topic'  => 'required',
                        'content'  => 'required',
                        'status'  => 'required',
                        'contact'  => 'required'           
                        ]);
                    $service = Services::find($services);
                    $vilager = Vilager::where('nik', $request->nik)->first();
                    //  return response()->json( $service);
                    
                    $service->update($request->except('nik'));
                    $service->update(['vilager_id'=>$vilager->id]);

                    return response()->json([
                        'message'=>'Vilager Created Successfully!!',
                        'service'  => $services,  
                    ]);
                }catch(\Exception $e){
                    \Log::error($e->getMessage());
                    return response()->json([
                        'message'=>'Something goes wrong while creating a Vilager!!'
                    ],500);
                }
        // $services->services()->fill($request->post())->update();      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $services)
    {
        try {
            $service = Services::find($services);
            $service->delete();

            return response()->json([
                'message'=>'services Deleted Successfully!!'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while deleting a services!!'
            ]);
        }
    }
}
