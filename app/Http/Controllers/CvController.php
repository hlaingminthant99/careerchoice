<?php

namespace App\Http\Controllers;

use App\Job;
use App\Cv;
use App\User;
use Illuminate\Http\Request;
use App\Utils\Uploaders\ImageUploader;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($job_id){
        $cvs = Cv::where('job_id', $job_id)->get();
        return view('admin.cv.index', compact('cvs','job_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($job_id)
    {
        $users = User::pluck('name', 'id');
        return view('admin.cv.create', compact('job_id' , 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $job_id)
    {

        if($request->hasFile('attachment')) {
            // Get filename with extension            
            $filenameWithExt = $request->file('attachment')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
           // Get just ext
            $extension = $request->file('attachment')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
          // Upload Image
            $path = $request->file('attachment')->storeAs('public/attachment', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $cv = new Cv([
            'user_id' => $request->get('user_id'),
            'job_id' => $job_id,
            'attachment' => $fileNameToStore,
        ]);

        $cv->save();
        
        return redirect("admin/job/{$job_id}/cv");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function edit($job_id, $id)
    {
        $cv = Cv::find($id);
        $users = User::pluck('name', 'id');
        return view('admin.cv.edit', compact('cv','id','users','job_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $job_id, $id)
    {
        $cv = Cv::find($id);
        if($request->hasFile('attachment')) {
            unlink(storage_path('app/public/attachment/'.$cv->attachment));
            // Get filename with extension            
            $filenameWithExt = $request->file('attachment')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
           // Get just ext
            $extension = $request->file('attachment')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
          // Upload Image
            $path = $request->file('attachment')->storeAs('public/attachment', $fileNameToStore);
        } else {
            $fileNameToStore = $request->prev_image;
        }

        $cv->user_id = $request->get('user_id');
        $cv->job_id = $job_id;
        $cv->attachment = $fileNameToStore;
        $cv->save();
        
        return redirect("admin/job/{$job_id}/cv");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function destroy($job_id, $id)
    {
        $job = Job::find($job_id);
        $cv = Cv::find($id);
        $cv->delete();
        return redirect("admin/job/{$job_id}/cv");
    }
}
