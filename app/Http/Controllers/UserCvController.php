<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Job;
use App\User;
use App\Cv;

class UserCvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($job_id)
    {
        $id = Auth::id();
        $cvs = Cv::where('job_id', $job_id)->get();
        return view('user.cv.index', compact('cvs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($job_id)
    {
        $id = Auth::id();
        return view('user.cv.create', compact('job_id', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $job_id)
    {
        // request() -> validate([
        //     'attachment' => 'required|file|mimes:jpg,jpeg,png,doc,pdf,svg,gif|max:2048',
        // ]);

        // Handle File Upload
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
            'job_id' => $request->get('job_id'),
            'attachment' => $fileNameToStore,
        ]);

        $cv->save();
        
        return redirect("jobs/cv");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($job_id, $id)
    {
        $cv = Cv::find($id);
        
        return view('user.cv.edit', compact('cv','job_id','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $job_id, $id)
    {
        $user_id = Auth::id();
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
        $cv->user_id = $user_id;
        $cv->job_id = $request->get('job_id');
        $cv->attachment = $fileNameToStore;
        $cv->save();
        
        return redirect("jobs/cv");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($job_id, $id)
    {
        $cv = Cv::find($id);
        $cv->delete();
        return redirect("jobs/cv");
    }
}
