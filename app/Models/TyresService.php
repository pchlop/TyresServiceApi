<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TyresService extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_of_service',
        'client'
    ];

    public static $createRules = [
        'date' => [
            'required',
            'regex:/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/'
        ],
        'time' => [
            'required',
            'regex:/(?:[01]\d|2[0-3]):(?:[0-5]\d):(?:[0-5]\d)/'
        ],
        [
            'date.regex' => "Invalid format. Enter the date in the format YYYY-MM-DD. For example: 2021-11-17",
            'time.regex' => "Invalid format. Enter the time in the format HH:MM:SS. For example: 14:45.00"
        ]
    ];

    public static $updateRules = [
        'registration_plate' => [
            'required',
            'string'
        ]
    ];

    public static function clientHasVisit($registration)
    {
        $query = TyresService::where('date_of_service', '>', new DateTime('NOW'))->where('client', $registration)->get();

        if($query->isEmpty()) {
            return true;
        }
        else {
            return false;
        }
    }
}
