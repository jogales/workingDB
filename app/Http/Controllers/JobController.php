<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return view('job.index');
    }
}
