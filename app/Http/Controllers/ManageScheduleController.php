<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageScheduleController extends Controller
{
    public function viewSchedule()
    {

        $infoPatient = DB::table('info_patient')->where('pa_active', 0)->get();
        $infoDoc = DB::table('info_doctor')->get();
        $infoDate = DB::table('schedule_plan')->get();
        return view('schedule', ['infoP' => $infoPatient, 'infoD' => $infoDoc, 'infoDate' => $infoDate]);
    }

    public function addSchedule(Request $request)
    {
        $doc_id = $request->doc_id;
        $pa_id = $request->pa_id;
        $date = $request->date;
        $time = $request->time;

        DB::insert('insert into schedule_plan (sc_pa_id,sc_doc_id,sc_date,sc_time) values (?,?,?,?)', ["$pa_id", "$doc_id", "$date", "$time"]);
        DB::table('info_patient')->where('pa_id', $pa_id)->update(['pa_active' => 1]);

        $schedule = DB::table('schedule_plan')
            ->join('info_patient', 'schedule_plan.sc_pa_id', '=', 'info_patient.pa_id')
            ->join('info_doctor', 'schedule_plan.sc_doc_id', '=', 'info_doctor.doc_id')
            ->where('schedule_plan.sc_doc_id', '=', $doc_id)->where('schedule_plan.sc_date', '=', $date)
            ->orderBy('schedule_plan.sc_time', 'asc')
            ->get();

        $timeDoc = DB::table('info_doctor')->where('doc_id', '=', $doc_id)->get();
        $listPatient = DB::table('info_patient')->where('pa_id', '=', $pa_id)->get();
        $response = array(
            'status' => 'success',
            'schedule' => $schedule,
            'docTime' => $timeDoc,
            'listPatient' => $listPatient
        );
        return response()->json($response);
    }

    public function changeDoc(Request $request)
    {
        $doc_id = $request->doc_id;
        $date = $request->date;

        $timeDoc = DB::table('info_doctor')->where('doc_id', '=', $doc_id)->get();
        $schedule = DB::table('schedule_plan')
            ->join('info_patient', 'schedule_plan.sc_pa_id', '=', 'info_patient.pa_id')
            ->join('info_doctor', 'schedule_plan.sc_doc_id', '=', 'info_doctor.doc_id')
            ->where('schedule_plan.sc_doc_id', '=', $doc_id)->where('schedule_plan.sc_date', '=', "$date")
            ->orderBy('schedule_plan.sc_time', 'asc')
            ->get();

        $response = array(
            'status' => 'success',
            'schedule' => $schedule,
            'docTime' => $timeDoc
        );
        return response()->json($response);
    }

    public function getPatientOfDoc(Request $request)
    {
        $doc_id = $request->doc_id;
        $listDate = DB::table('schedule_plan')
            ->join('info_patient', 'schedule_plan.sc_pa_id', '=', 'info_patient.pa_id')
            ->join('info_doctor', 'schedule_plan.sc_doc_id', '=', 'info_doctor.doc_id')
            ->where('schedule_plan.sc_doc_id', '=', $doc_id)
            ->get();
        $response = array(
            'status' => 'success',
            'listD' => $listDate
        );
        return response()->json($response);
    }

    public function delPatientSchedule(Request $request)
    {
        $sc_id = $request->id;

        $idPatient = DB::table('schedule_plan')->select('sc_pa_id')->where('sc_id', '=', $sc_id)->get();
        DB::table('info_patient')->where('pa_id', $idPatient[0]->sc_pa_id)->update(['pa_active' => "0"]);
        DB::table('schedule_plan')->where('sc_id', '=', $sc_id)->delete();
        $response = array(
            'status' => 'success'
        );
        return response()->json($response);
    }
}
