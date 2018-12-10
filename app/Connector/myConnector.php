<?php
/**
 * Created by PhpStorm.
 * User: Jose
 * Date: 2018-12-10
 * Time: 16:11
 */

namespace App\Connector;


use App\Employee;

class myConnector
{
    function getAllEmployee()
    {
        $employees = Employee::all();
        return json_decode($employees);
    }

    function getCountEmployee()
    {
        $emp = Employee::all()->count();
        return $emp;
    }


}