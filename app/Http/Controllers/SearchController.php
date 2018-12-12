<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Job;
use App\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function jobindex()
    {
        $jobs = Job::all();
        
        return view('user.job.search', compact('jobs'));
    }

    public function cvindex()
    {
        $id = Auth::id();
        $cvs = Cv::where('user_id', $id)->get();
        
        return view('user.cv.search', compact('cvs'));
    }

    public function jobsearch()
    {
        $q = Input::get ( 'q' );
        $job = Job::where('job_name','LIKE','%'.$q.'%')->get();
        if(count($job) > 0)
            return view('home')->withDetails($job)->withQuery ( $q );
        else 
            return view ('home')->withMessage('No Details found. Try to search again !');
    }
}
