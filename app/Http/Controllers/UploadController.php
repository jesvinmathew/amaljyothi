<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUploadRequest;
use App\Http\Requests\UpdateUploadRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Redirect;
use mikehaertl\pdftk\Pdf;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = Auth::user();
        $data['uploads']=array();
        if(isset($auth->user_type_id)&&$auth->user_type_id==1){
            $data['uploads']=Upload::with("User")->where('user_id', $auth->id)->paginate(10);
        }
        else if(isset($auth->user_type_id)&&$auth->user_type_id==2){
            $data['uploads']=Upload::with("User")->paginate(10);
        }
        else{
            return Redirect::route('login');
        }
        return view('uploads.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $auth = Auth::user();
        if(isset($auth->user_type_id)&&$auth->user_type_id==1){
            return view('uploads.create');
        }
        return Redirect::route('uploads.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUploadRequest $request)
    {
        $auth = Auth::user();
        $file=Storage::put('public/pdf', $request->file);
        $data = $request->all();
        $data['user_id']=$auth->id;
        $data['url'] = Storage::url($file);
        $data['path'] = $file;
        Upload::create($data);
        return Redirect::route('uploads.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Upload $upload)
    {
        $filePath = public_path($upload->url);



        $pdf = new Pdf($filePath);



        $password = '123456';

        $userPassword = '123456a';



        $result = $pdf->allow('AllFeatures')

                        ->setPassword($password)

                        ->setUserPassword($userPassword)

                        ->passwordEncryption(128)

                        ->saveAs($filePath);



        if ($result === false) {

            $error = $pdf->getError();

        }



        return response()->download($filePath);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUploadRequest $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upload $upload)
    {
        //
    }
}
