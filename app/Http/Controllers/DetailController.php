<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;

use Session;
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
    public function index(Request $request)
    {
        $schildabbr= $request->schildabbr_id;
        if(Session::has('schildabbr_id')) {
            $schildabbr = Session::get('schildabbr_id');
        }
        else {
            Session::put('schildabbr_id', $schildabbr);
        }
        $dep = DB::select('select * from V_EXECUTOR t');
        $data = DB::select('select * from RIBBON_DETAIL t, ZUTLENT.NBT_ZURCHIL_YARALTAITORMOZ w, V_EXECUTOR v where w.ribbon_id = t.ribbon_id(+) and v.executor_id(+)=t.dep_id');
        return view('home', compact('data', 'dep','schildabbr'));
       
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
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
            $det->ribbon_id = $request->ribbon_id;
            $det->info_file = $imageName;
            
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
    public function report()
    {
        $dep = DB::select('select * from V_EXECUTOR t');
        $data = DB::select('select * from RIBBON_DETAIL t, ZUTLENT.NBT_ZURCHIL_YARALTAITORMOZ w, V_EXECUTOR v where w.ribbon_id = t.ribbon_id and v.executor_id(+)=t.dep_id');
        return view('report', compact('data', 'dep'));
       
    }
    public function filter_childabbr($schildabbr_id) {
        Session::put('schildabbr_id',$schildabbr_id);
        return back();
    }
}
