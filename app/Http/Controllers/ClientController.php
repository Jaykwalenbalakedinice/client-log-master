<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;

class ClientController extends Controller
{
    public function applicationForm()
    {
        $purpose = DB::table('tbl_purpose')->where('purpose_id', 1)->get();
        $fd = DB::table('tbl_fd')->where('office_level_id', 1)->get();
        $virtualId = DB::table('tbl_virtual_id')->where('status', 'available')->get();
        return view('client.applicationForm', compact('fd', 'purpose', 'virtualId'));
    }

    public function clientLogs()
    {
        $clients = Client::all();
        return view('client.clientLogs', ['clients' => $clients]);
    }

    public function storse(Request $request)
    {
        foreach ($request->get('officeConcerned') as $office) {
            echo $office . '<br>';
        }
    }
    public function store(Request $request)
    {
        $query = DB::table('tbl_clientLogs')->whereYear('timeIn', date('Y'))
            ->orderBy('clientNumber', 'DESC')->first();
        if ($query) {
            $lastNumber = explode('-', $query->clientNumber);
            $incrementedNumber = (int) $lastNumber[1] + 1; // Convert the string to an integer before adding 1
            if ($incrementedNumber < 10) {
                $clientNumber = date('Y') . '-0000' . $incrementedNumber;
            } elseif ($incrementedNumber < 100) {
                $clientNumber = date('Y') . '-000' . $incrementedNumber;
            } elseif ($incrementedNumber < 1000) {
                $clientNumber = date('Y') . '-00' . $incrementedNumber;
            } elseif ($incrementedNumber < 10000) {
                $clientNumber = date('Y') . '-0' . $incrementedNumber;
            } else {
                $clientNumber = date('Y') . '-' . $incrementedNumber;
            }
        } else {
            $clientNumber = date('Y') . '-00001';
        }

        $request->merge(['clientNumber' => $clientNumber]); // Add the clientNumber to the request data


        $data = $request->validate([
            'clientNumber' => 'required',
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
            'birthDate' => 'required|date',
            'contact' => 'nullable',
            'virtualIdNumber' => 'nullable',
            'timeOut' => 'nullable',
        ]);

        // Encrypt email and contact
        $data['emailAddress'] = encrypt($data['emailAddress']);
        $data['contact'] = $data['contact'] ? encrypt($data['contact']) : null;
        $data['birthDate'] = encrypt($data['birthDate']);

        // Get the virtual ID from the form submission
        $virtualIdNumber = $request->input('virtualIdNumber');
        \Log::info('Virtual ID Number: ' . $virtualIdNumber);

        // Update the status of the virtual ID to 'occupied'
        DB::table('tbl_virtual_id')
            ->where('id_number', $virtualIdNumber)
            ->update(['status' => 'occupied']);

        //saving client office concerned (Kung alin ang opisinang kanyang mga pupuntahan)
        foreach ($request->get('officeConcerned') as $office) {
            DB::table('tbl_client_office_concerned')->insert(['logsNumber' => $clientNumber, 'officeName' => $office]);
        }

        //saving client purposes
        foreach ($request->get('purpose') as $purpose) {
            DB::table('tbl_client_purpose')->insert(['logsNumber' => $clientNumber, 'clientPurpose' => $purpose]);
        }

        $data['timeIn'] = Carbon::now();
        $data['series'] = Carbon::now()->year;

        $newClient = Client::create($data);
        return redirect()->route('client.store')->with('submited', 'Application submitted successfully.');
    }

    public function logout(Request $request)
    {
        try {
            DB::table('tbl_clientLogs')->where('id', $request->id)->update(['timeOut' => date('Y-m-d H:i:s ')]);
            $getVirtualId = DB::table('tbl_clientLogs')->where('id', $request->id)->first();
            // Update the status of the virtual ID to 'available'
            DB::table('tbl_virtual_id')
                ->where('id_number', $getVirtualId->virtualIdNumber)
                ->update(['status' => 'available']);
                session('logsNumber', $getVirtualId->clientNumber);
                return response()->json($getVirtualId->clientNumber);
            // return redirect()->route('client.clientLogs')->with(['success' => 'Logged out successfully.', 'logsNumber' => $getVirtualId->clientNumber]);
        } catch (\Exception $e) {
            return response()->json(['Message' => 'Error'], 400);
        }
    }

    public function getClientLogs()
    {
        $clients = Client::where('timeOut', null)->get();
        return response()->json($clients);
    }

    public function getViewClientLogs()
    {
        $clients = Client::whereNull('timeOut')->get();
        return view('client.clientLogsViewOnly', ['clients' => $clients]);
    }
}

