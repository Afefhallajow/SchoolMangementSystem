<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentsRequest;
use App\Repository\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $Student;

    public function __construct(StudentRepository $Student)
    {
        $this->Student = $Student;
    }

    public function index()
    {
        return $this->Student->Get_Student();
    }


    public function create()
    {
        return $this->Student->Create_Student();
    }

    public function store(StoreStudentsRequest $request)
    {
        return $this->Student->Store_Student($request);
    }



    public function edit($id)
    {
        return $this->Student->Edit_Student($id);
    }


    public function update(StoreStudentsRequest $request)
    {
        return $this->Student->Update_Student($request);
    }


    public function destroy(Request $request)
    {
        return $this->Student->Delete_Student($request);
    }

    public function Get_classrooms($id)
    {
        return $this->Student->Get_classrooms($id);
    }

    public function Get_Sections($id)
    {
        return $this->Student->Get_Sections($id);
    }

}
