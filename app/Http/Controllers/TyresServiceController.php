<?php

namespace App\Http\Controllers;


use App\Http\Resources\TyresServiceResource;
use DateTime;
use Illuminate\Http\Request;
use App\Models\TyresService;
use Illuminate\Support\Facades\App;

class TyresServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return TyresServicesResource
     */
    public function index()
    {
        return TyresServiceResource::collection(TyresService::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate(TyresService::$createRules);

        $concat_datetime = $fields['date'].' '.$fields['time'];
        $visit_datetime = date('Y-m-d H:i:s', strtotime($concat_datetime));

        return TyresService::create([
            'date_of_service' => new DateTime($visit_datetime)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return TyresServicesResource
     */
    public function show($id)
    {
        return new TyresServiceResource(TyresService::find($id));
    }
    /**
     * Display the resource where client values is not null.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_busy()
    {
        return TyresServiceResource::collection(TyresService::where('date_of_service', '>', new DateTime('NOW'))
        ->whereNotNull('client')->get());
    }

    /**
     * Display the resource where client values not null.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_free()
    {
        return TyresServiceResource::collection(TyresService::where('date_of_service', '>', new DateTime('NOW'))
            ->whereNull('client')->get());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fields = $request->validate(TyresService::$updateRules);
        $isFreeVisit = TyresService::where('id', $id)
                ->where('date_of_service', '>', new DateTime('NOW'))
                ->where('client')->get();
        $hasNoVisit = TyresService::clientHasNoVisit($fields['registration_plate']);
        if (!($isFreeVisit->isEmpty()) && $hasNoVisit) {
            return TyresService::where('id', $id)
                ->update(['client' => $fields['registration_plate']]);
        }
        return response('The date of the visit has already expired, visit is already booked or you have a booked visit in future', 404);

    }

    public function cancel(Request $request) {

        $fields = $request->validate(TyresService::$updateRules);
        $record = TyresService::firstWhere('client', $fields['registration_plate']);

        if($record == null) {
            return response('Your registration plate is not in our database.', 401);
        }
        else {
            return TyresService::where('date_of_service', '>', new DateTime('NOW'))
                ->firstWhere('client', $fields['registration_plate'])
                ->update(['client' => null]);
        }
    }

    public function bookFirst(Request $request)
    {
        $fields = $request->validate(TyresService::$updateRules);
        $hasNoVisit = TyresService::clientHasNoVisit($fields['registration_plate']);

        if ($hasNoVisit) {
        return TyresService::whereNull('client')
            ->where('date_of_service', '>', new DateTime('NOW'))
            ->first()
            ->update(['client' => $fields['registration_plate']]);
        }
        return response('You already have a date of visit', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return TyresService::destroy($id);
    }
}
