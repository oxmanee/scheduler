<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagePeopleController extends Controller
{

    public function index()
    {
        // $infoDoc = DB::table('info_doctor')->get();
        return view('add');
    }

    public function viewAdd()
    {
        return view('add');
    }

    public function addDoc(Request $request)
    {
        $nameDoc = $request->input('nameDoc');
        $fts = $request->input('txtFTimeStart');
        $fte = $request->input('txtFTimeEnd');
        $sts = $request->input('txtSTimeStart');
        $ste = $request->input('txtSTimeEnd');

        DB::insert('insert into info_doctor (doc_name,doc_fts,doc_fte,doc_sts,doc_ste) values (?,?,?,?,?)', ["$nameDoc", "$fts", "$fte", "$sts", "$ste"]);

        return view('add');
    }

    public function addPatient(Request $request)
    {

        $namePatient = $request->input('namePatient');
        $dp = $request->input('txtDatePatient');
        $des = $request->input('des');

        DB::insert('insert into info_patient (pa_name,pa_time,pa_des,pa_active) values (?,?,?,?)', ["$namePatient", "$dp", "$des", 0]);

        return view('add');
    }

    public function viewEdit()
    {
        $infoPatient = DB::table('info_patient')->where('pa_active', 0)->get();
        $infoDoc = DB::table('info_doctor')->get();
        return view('edit', ['infoP' => $infoPatient, 'infoD' => $infoDoc]);
    }

    public function getInfoPatient(Request $request)
    {
        $id = $request->message;
        $infoPatient = DB::table('info_patient')->where('pa_id', '=', $id)->get();
        $listDoc = DB::table('info_doctor')->get();
        $response = array(
            'status' => 'success',
            'msg' => $infoPatient,
            'list' =>$listDoc
        );
        return response()->json($response);
    }

    public function editPatient(Request $request)
    {

        $id = $request->input('namePatient');
        $dp = $request->input('txtDatePatient');
        $des = $request->input('des');

        DB::table('info_patient')->where('pa_id', $id)->update(['pa_time' => "$dp", 'pa_des' => "$des"]);

        return redirect()->route('viewEdit');
    }

    public function getInfoDoc(Request $request)
    {
        $id = $request->message;
        $infoDoc = DB::table('info_doctor')->where('doc_id', '=', $id)->get();
        $response = array(
            'status' => 'success',
            'msg' => $infoDoc,
        );
        return response()->json($response);
    }

    public function editDoc(Request $request)
    {
        $id = $request->input('nameDoc');
        $fts = $request->input('txtFTimeStart');
        $fte = $request->input('txtFTimeEnd');
        $sts = $request->input('txtSTimeStart');
        $ste = $request->input('txtSTimeEnd');
        DB::table('info_doctor')->where('doc_id', $id)->update(['doc_fts' => "$fts", 'doc_fte' => "$fte", 'doc_sts' => "$sts", 'doc_ste' => "$ste"]);

        return redirect()->route('viewEdit');
    }

    public function delPatient(Request $request)
    {
        $id = $request->message;
        DB::table('info_patient')->where('pa_id', '=', $id)->delete();
        $response = array(
            'status' => 'success'
        );
        return response()->json($response);
    }

    public function delDoc(Request $request)
    {
        $id = $request->message;
        DB::table('info_doctor')->where('doc_id', '=', $id)->delete();
        $response = array(
            'status' => 'success'
        );
        return response()->json($response);
    }
}
