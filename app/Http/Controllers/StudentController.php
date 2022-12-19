<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::orderBy('registrationDate', 'DESC')->get();
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
        $newStudent = new Student;
        $newStudent->firstName = $request->student['firstName'];
        $newStudent->lastName = $request->student['lastName'];
        $newStudent->documents = $request->student['documents'];
        $newStudent->status = $request->student['status'];
        $newStudent->registrationDate = Carbon::now();
        $newStudent->save();

        return response($newStudent);
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
        //
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
        $existingStudent = Student::find($id);
        if (is_null($existingStudent)) {
            return response("Student with id $id does not exist.");
        }

        $firstName = $request->student['firstName'];
        if (empty($firstName) == false && $existingStudent->firstName !== $firstName) {
            $existingStudent->firstName = $firstName;
        }
        $lastName = $request->student['lastName'];
        if (empty($lastName) == false && $existingStudent->lastName !== $lastName) {
            $existingStudent->lastName = $lastName;
        }
        $status = $request->student['status'];
        if ($status > -1 && $status < 4 && $existingStudent->status !== $status) {
            $existingStudent->status = $status;
        }
        $existingStudent->save();

        return response(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingStudent = Student::find($id);
        if (is_null($existingStudent)) {
            return response("Student with id $id does not exist.");
        }

        $existingStudent->delete();
        return response(200);
    }
}
