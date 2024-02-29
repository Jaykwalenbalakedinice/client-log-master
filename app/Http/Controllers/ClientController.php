<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Carbon\Carbon;
use DB;

class ClientController extends Controller
{
    public function applicationForm()
    {
        $fd = DB::table('tbl_fd')->where('office_level_id', 1)->get();
        return view('client.applicationForm', compact('fd'));
    }

    public function clientLogs()
    {

        $clients = Client::all();
        return view('client.clientLogs', ['clients' => $clients]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'emailAddress' => 'required',
            'region' => 'required',
            'province' => 'required',
            'municipality' => 'required',
            'barangay' => 'required',
            'clientType' => 'required',
            'firstName' => 'required',
            'middleName' => 'nullable',
            'lastName' => 'required',
            'gender' => 'required',
            'birthDate' => 'required',
            'contact' => 'required',
            'divisionOfResidence' => 'required',
            'officeConcerned' => 'required',
            'purposeId' => 'required',
            'virtualIdNumber' => 'required',
            'timeOut' => 'nullable',
        ]);

        $data['timeIn'] = Carbon::now();
        $data['series'] = Carbon::now()->year;

        $newClient = Client::create($data);
        return redirect()->route('client.store')->with('submited', 'Application submited successfully.');
    }

    // Controller method for logging out client
    public function logout(Client $client)
    {
        //Update the timeOut field in the database
        $client->update(['timeOut' => Carbon::now()]);
        return redirect()->route('client.clientLogs')->with(['success' => 'Logged out successfully.', 'logsNumber' => $client->id]);
    }

}