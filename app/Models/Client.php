<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'tbl_clientLogs';

    protected $fillable = [
        'emailAddress',
        'region',
        'province',
        'municipality',
        'barangay',
        'clientType',
        'firstName',
        'middleName',
        'lastName',
        'gender',
        'birthDate',
        'contact',
        'divisionOfResidence',
        'officeConcerned',
        'purposeId',
        'virtualIdNumber',
        'timeIn',
        'timeOut',
        'logsNumber',
        'series'
    ];
}
