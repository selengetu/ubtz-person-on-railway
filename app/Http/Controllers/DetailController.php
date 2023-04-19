<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Detail;

class DetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dep = DB::select('select * from V_EXECUTOR t');
        $data = DB::select('select * from ZUTLENT.NBT_ZURCHIL_YARALTAITORMOZ');
        $det = DB::table('RIBBON_DETAIL')->orderby('detail_id')->get();
        return view('home', compact('data', 'dep','det'));
       
    }
    public function store(Request $request)
    {

        if ($request->id ==  null) {
            $det = new Detail;
            $det->dep_id = $request->dep_id;
            $det->people_count = $request->people_count;
            $det->is_ubtz = $request->is_ubtz;
            $det->info_no = $request->info_no;
            $det->info_date = $request->info_date;
            $det->info_job = $request->info_job;
            $det->info_employee = $request->info_employee;
            $det->description = $request->description;
            $det->time = $request->time;
            $det->save();

        } else {

            $det = DB::table('RIBBON_DETAIL')
                ->where('detail_id', $request->detail_id)
                ->update(['dep_id' => $request->dep_id, 'people_count' => $request->people_count, 'is_ubtz' => $request->is_ubtz, 'info_no' => $request->info_no, 'info_date' => $request->info_date, 'info_job' => $request->info_job,
                'info_employee' => $request->info_employee, 'time' => $request->time, 'description' => $request->description]);
        }
        return Redirect('detail');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id', '=', $id)->delete();
        return 1;
    }
}
