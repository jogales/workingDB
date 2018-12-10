<?php

namespace App\Http\Controllers;

use App\Connector\myConnector;
use App\Employee;
use App\Job;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $conn;

    public function __construct()
    {
        $this->conn = new myConnector();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job = Job::all();
        return view('employees.index',compact($job));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function fillTable()
    {
        $employees = $this->conn->getAllEmployee();
        foreach ($employees as $key=>$value)
        {
            $data[] = array(
                'job_id' => $value->job_id,
                'name' => $value->name,
                'phone' => $value->phone,
                'salary' => $value->salary,
            );
        }
        $dataCount = $this->conn->getCountEmployee();
        $json_data = array('recordsTotal' => $dataCount  , 'recordsFiltered' =>  $dataCount, 'data' =>  $data );
        return json_encode($json_data);

    }
}
