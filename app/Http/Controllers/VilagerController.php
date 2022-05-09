<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Vilager;
use App\Helpers\ApiFormatter;

class VilagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // 
        return Vilager::select( 'id','name',
        'nik',
        'kk',
        'email',
        'phone',
        'status',
        'religion',
        'education',
        'job',
        'gender',
        'rt')->get();

        // if($villagers){
        //     return ApiFormatter::createApi(200, 'Berhasil', $villagers);
        // } else{
        //     return ApiFormatter::createApi(400, 'Tidak adak Data');
        // }      
        // return response()->json(
        //     [
        //         'status'    =>  true,
        //         'villagers' =>  $villagers,
        //     ],
        // );
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
            'name' => 'required',
            'nik' => 'required',
            'kk' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'religion' => 'required',
            'education' => 'required',
            'job' => 'required',
            'gender' => 'required',
            'rt' => 'required',
        ]);

        try{           
            Vilager::create($request->post());

            return response()->json([
                'message'=>'Vilager Created Successfully!!'
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
    public function show(Vilager $vilager)
    {
        return response()->json([
            'vilager'=>$vilager
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
    public function update(Request $request, Vilager $vilager )
    {
        $request->validate([            
            'name' => 'required',
            'nik' => 'required',
            'kk' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'status' => 'required',
            'religion' => 'required',
            'education' => 'required',
            'job' => 'required',
            'gender' => 'required',
            'rt' => 'required',
        ]);

        try{
            $vilager->fill($request->post())->update();
        
            return response()->json([
                'message'=>'vilager Updated Successfully!!'
            ]);

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while updating a vilager!!'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vilager $vilager)
    {
        try {
            $vilager->delete();

            return response()->json([
                'message'=>'vilager Deleted Successfully!!'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while deleting a vilager!!'
            ]);
        }
    }
}
