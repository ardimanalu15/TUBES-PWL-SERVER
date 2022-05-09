<?php

namespace App\Http\Controllers;

use App\Models\Ktp;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ktp::select('id','title','description','status', 'imagertrw','image','imagepbb','imagekk')->get();
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
            'title'=>'required',
            'description'=>'required',
               'status'=>'required',
            'imagertrw'=>'required|image',
            'image'=>'required|image',
            'imagepbb'=>'required|image',
            'imagekk'=>'required|image',
            
        ]);

        try{
            // $fileName = time().$request->file('imagertrw', 'image', 'imagepbb', 'imagekk')->getClientOriginalExtension();
            // $path = $request->file('imagertrw', 'image', 'imagepbb', 'imagekk')->storeAs('uploads/ktp',$fileName);
            // $validasiss['imagertrw, image,imagepbb,imagekk '] = $path;
            
            // Ktp::create($validasi);

            $imagertrww = Str::random().'.'.$request->imagertrw->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('ktp/imagertrw', $request->imagertrw,$imagertrww);

            $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('ktp/image', $request->image,$imageName);
            $imagepbbb = Str::random().'.'.$request->imagepbb->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('ktp/imagepbb', $request->imagepbb,$imagepbbb);
            $imagekkk = Str::random().'.'.$request->imagekk->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('ktp/imagekk', $request->imagekk,$imagekkk);

            Ktp::create($request->post()+['imagertrw'=>$imagertrww]+['image'=>$imageName]+[ 'imagepbb'=>$imagepbbb]+['imagekk'=>$imagekkk]);

            
            return response()->json([
                'message'=>'Pengajuan KTP Created Successfully!!'
            ]);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while creating a ktp!!'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ktp  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Ktp $product)
    {
        return response()->json([
            'product'=>$product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ktp  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Ktp $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ktp $ktp)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required', 
            'status'=>'required',          
            'imagertrw'=>'nullable',
            'image'=>'nullable',
            'imagepbb'=>'nullable',
            'imagekk'=>'nullable',
        ]);

        try{

            $ktp->fill($request->post())->update();

            if($request->hasFile('imagertrw')){

                // remove old image
                if($ktp->image){
                    $exists = Storage::disk('public')->exists("ktp/imagertrw/{$ktp->imagertrw}");
                    if($exists){
                        Storage::disk('public')->delete("ktp/imagertrw/{$ktp->imagertrw}");
                    }
                }
                $imagertrww = Str::random().'.'.$request->imagertrw->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('ktp/imagertrw', $request->imagertrw,$imagertrww);
               
                $ktp->imagertrw = $imagertrww;
                $ktp->save();
            }
            if($request->hasFile('image')){

                // remove old image
                if($ktp->image){
                    $exists = Storage::disk('public')->exists("ktp/image/{$ktp->image}");
                    if($exists){
                        Storage::disk('public')->delete("ktp/image/{$ktp->image}");
                    }
                }

                $imageName = Str::random().'.'.$request->image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('ktp/image', $request->image,$imageName);
                $ktp->image = $imageName;
                $ktp->save();
            }
            if($request->hasFile('imagepbb')){

                // remove old image
                if($ktp->image){
                    $exists = Storage::disk('public')->exists("ktp/imagepbb/{$ktp->imagepbb}");
                    if($exists){
                        Storage::disk('public')->delete("ktp/imagepbb/{$ktp->imagepbb}");
                    }
                }

                $imagepbbb = Str::random().'.'.$request->imagepbb->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('ktp/imagepbb', $request->imagepbb,$imagepbbb);
                $ktp->imagepbb = $imagepbbb;
                $ktp->save();
            }
            if($request->hasFile('imagekk')){

                // remove old image
                if($ktp->image){
                    $exists = Storage::disk('public')->exists("ktp/imagekk/{$ktp->imagekk}");
                    if($exists){
                        Storage::disk('public')->delete("ktp/imagekk/{$ktp->imagekk}");
                    }
                }

                $imagekkk = Str::random().'.'.$request->imagekk->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('ktp/imagekk', $request->imagekk,$imagekkk);
                $ktp->imagekk = $imagekkk;
                $ktp->save();
            }

            return response()->json([
                'message'=>'surat ktp Updated Successfully!!'
            ]);

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while updating a product!!'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ktp $ktp)
    {
        try {

            if($ktp->imagertrw){
                $exists = Storage::disk('public')->exists("product/image/{$ktp->imagertrw}");
                if($exists){
                    Storage::disk('public')->delete("product/image/{$ktp->imagertrw}");
                }
            }
            if($ktp->image){
                $exists = Storage::disk('public')->exists("product/image/{$ktp->image}");
                if($exists){
                    Storage::disk('public')->delete("product/image/{$ktp->image}");
                }
            }
            if($ktp->imagepbb){
                $exists = Storage::disk('public')->exists("product/image/{$ktp->imagepbb}");
                if($exists){
                    Storage::disk('public')->delete("product/image/{$ktp->imagepbb}");
                }
            }
            if($ktp->imagekk){
                $exists = Storage::disk('public')->exists("product/image/{$ktp->imagekk}");
                if($exists){
                    Storage::disk('public')->delete("product/image/{$ktp->imagekk}");
                }
            }

            $ktp->delete();

            return response()->json([
                'message'=>'Product Deleted Successfully!!'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while deleting a product!!'
            ]);
        }
    }
}
