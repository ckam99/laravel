<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    
    public function index()
    {
        return view('document');
    }

    public function store(Request $request)
    {
        request()->validate([
            'file' => 'required',
            'file.*' => 'mimes:doc,pdf,docx,txt,zip'
        ]);
        if($request->hasfile('file')) { 
            foreach($request->file('file') as $file)
            {
                $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $fileName.'.'.$file->getClientOriginalExtension();
                $file->move(public_path(),$fileName);
                $input['file'] = $fileName;
                File::create($input);
            }
        }         
        
    }
}