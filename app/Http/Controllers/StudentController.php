<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentResquest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studets = Student::orderBy('id', 'desc')->paginate(10);
        return view('pages.student', ['models' => $studets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentResquest $request)
    {
        $data = $request->all();
        Student::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        $data = $request->all();
        $student->update($data);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return back();
    }
}
