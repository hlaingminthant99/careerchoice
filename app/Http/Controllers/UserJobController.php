<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Job;
use App\User;

class UserJobController extends Controller
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

    public function index()
    {
        $jobs = Job::all();
        
        return view('user.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::id();
        return view('user.job.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'job_name' => 'required',
            'job_type' => 'required',
            'job_discription' => 'required',
            'job_location' => 'required',
            'requirement' => 'required',
            'salary' => 'required',
        ]);

        $job = new Job([
            'user_id' => $request->get('user_id'),
            'job_name' => $request->get('job_name'),
            'job_type' => $request->get('job_type'),
            'job_discription' => $request->get('job_discription'),
            'job_location' => $request->get('job_location'),
            'requirement' => $request->get('requirement'),
            'salary' => $request->get('salary'),
        ]);

        $job->save();
        return redirect('/job');
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
    public function edit($id)
    {
        $job = Job::find($id);
        $id = Auth::id();
        return view('user.job.edit', compact('job', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        $job->job_name = $request->get('job_name');
        $job->job_type = $request->get('job_type');
        $job->salary = $request->get('salary');
        $job->job_discription = $request->get('job_discription');
        $job->job_location = $request->get('job_location');
        $job->requirement = $request->get('requirement');    
        $job->save();
        return redirect('/job');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        $job->delete();

        return redirect('/job');
    }

}
