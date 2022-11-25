<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class GradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $Grade = Grade::all();
        return view('pages.Grades')->with('Grades', $Grade);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreGrades $request)
    {   try {
            $validate= $request->validated();
            $Grade = new Grade();
            $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $Grade->Notes = $request->Notes;
            $Grade->save();

            toastr()->success('Data has been saved successfully!');
            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(StoreGrades $request)
    {
        try {
//$validate= $request->validate();
            $Grade = Grade::findOrFail($request->id);
            $Grade->update(
                [$Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name],
                    $Grade->Notes = $request->Notes,
//          $Grade->save();
                ]);
            toastr()->success('Data has been saved successfully!');
            return redirect()->route('Grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        //$validate= $request->validate();
         $my_class=Classroom::where('Grade_id',$request->id)->get();
         if($my_class->count()==0) {
             toastr()->error('Data has been removed successfully!');
             $Grade = Grade::findOrFail($request->id)->delete();


             return redirect()->route('Grades.index');
         }
         else{
             toastr()->error('you should remove the class  first!');
             return redirect()->route('Grades.index');

         }

    }
}
?>
