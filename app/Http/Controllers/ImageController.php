<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ImageController extends Controller
{

           public function upload()
           {
               return view('upload');
           }
           
            public function store(Request $request)
            {
                        $this->validate($request, [
                       
                            'images' => 'required',
                            'images.*' => 'mimes:webp,png,jpg'
                    ]);

                      $data = [];

                  
                    if($request->hasfile('images'))
                    {
                        $images = $request->file('images');
                        $group = 'thumbails/'. Str::random(8);
                        $index  = 0;
                        foreach($images as $image)
                        {
                            $name = Str::random(8).'.'.$image->getClientOriginalExtension();
                            $image->move(public_path().'/'.$group.'/', $name); 
                            $image= new Image();
                            $image->name= $name;
                            $image->index= $index;
                            $image->ismain= $index === 0;
                            $image->save();
                            $image = $image->toArray();
                            $image['url'] = url($group.'/'.$name);
                            $data[]=$image;
                            $index += 1;
                        }
                    }

               
                    return response(json_encode($data));
            }


            public function create(Request $request)
            {
                if(!$request->hasFile('fileName')) {
                    return response()->json(['upload_file_not_found'], 400);
                }
            
                $allowedfileExtension=['pdf','jpg','png'];
                $files = $request->file('fileName'); 
                $errors = [];
            
                foreach ($files as $file) {      
            
                    $extension = $file->getClientOriginalExtension();
            
                    $check = in_array($extension,$allowedfileExtension);
            
                    if($check) {
                        foreach($request->fileName as $mediaFiles) {
                            $media = new File();
                            $media_ext = $mediaFiles->getClientOriginalName();
                            $media_no_ext = pathinfo($media_ext, PATHINFO_FILENAME);
                            $mFiles = $media_no_ext . '-' . uniqid() . '.' . $extension;
                            $mediaFiles->move(public_path().'/images/', $mFiles);
                            $media->fileName = $mFiles;
                            $media->clientId = $request->clientId;
                            $media->uploadedBy = auth()->user()->id;
                            $media->save();
                        }
                    } else {
                        return response()->json(['invalid_file_format'], 422);
                    }
            
                    return response()->json(['file_uploaded'], 200);
            
                }
            }
}