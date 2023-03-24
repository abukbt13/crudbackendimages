<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function saveImage(Request $request)
    {
        $image_save=new Image();
        $image_name=$request->name;

        $image = $request->image->getClientOriginalName();
        $image_size = $request->image->getSize();
        $request->image->storeAs('public/uploads/', $image);
//        echo $image;
//        echo $image_size;
        $image_save->title=$request->title;
        $image_save->name=$image;

        $image_save->save();
        return response()->json(
            [
            'message' => 'Image uploaded successfully',
                'data' => $image_save,
                'code' => 200
            ]
        );
    }
    public function fetchImage()
    {
        $images=Image::all();
        return response()->json($images);
    }
    public  function deleteImage($id){
        $delete=Image::find($id);
        $delete->delete();
        return response()->json("deleted successfully");
    }
    public  function editImage($id){
        $edit=Image::find($id);
        return response()->json($edit);
    }
    public  function updateImage(Request $request, $id){
        $update=Image::find($id);


        $imagename="";

        if($request->hasFile('new_image')){
            $path='/app/uploads/';
            $path = storage_path().$path.$update->name;
            if(file_exists($path)){
                file::delete($path);
            }

            $uploaded_imagename = $request->new_image->getClientOriginalName();



            $filename=$request->file('new_image')->storeAs('public/uploads/',$uploaded_imagename);
            $imagename=$request->new_image->getClientOriginalName();
        }
        else{
            $imagename=$update->name;
        }
        $update->title=$request->title;
        $update->name=$imagename;
        $update->update();
        return response()->json('Successully saved');
    }

}
