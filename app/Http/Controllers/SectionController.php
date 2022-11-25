<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorSections;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();

        $list_Grades = Grade::all();
        $teachers=Teacher::all();
$sec=section::all();


        //dd($list_Grades)
        return view('pages.Sections',compact('Grades','list_Grades','teachers'));

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
    public function store(StorSections $request)
    {

            try {

             $validated = $request->validated();
                $Sections = new section();

                $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
                $Sections->Grade_id = $request->Grade_id;
                $Sections->Class_id = $request->Class_id;
                $Sections->Status = 1;







                $Sections->save();
                $Sections->teachers()->attach($request->teacher_id);

                toastr()->success(trans('messages.success'));

                return redirect()->route('Sections.index');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

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
    public function update(StorSections $request)
    {

        try {
            $validated = $request->validated();
            $Sections = section::findOrFail($request->id);

            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;

            if(isset($request->Status)) {
                $Sections->Status = 1;
            } else {
                $Sections->Status = 2;
            }
            if(isset($request->teacher_id)) {
                $Sections->teachers()->sync($request->teacher_id) ;
            } else {
                $Sections->teachers()->sync(array()) ;
            }




            $Sections->save();
            toastr()->success(trans('messages.Update'));

            return redirect()->route('Sections.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Sections.index');

    }

    public function getclasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");
//dd($list_classes);
        return $list_classes;
    }

}
