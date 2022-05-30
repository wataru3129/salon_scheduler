<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Services\ReservationService;

class ReservationController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('calendar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request) {

        $check = ReservationService::checkReservationDuplication($request->date, $request->start_time, $request->end_time);


        if ($check) {
            // session()->flash('status', 'この時間帯は既に他の予約が登録済みです。');
            return to_route('reservations.create')
                ->with([
                    'message' => 'この時間帯は既に他の予約が登録済みです。',
                    'status' => 'alert',
                    'date' => $request->date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'content' => $request->content,
                    'customer_name' => $request->customer_name,
                ]);
        }
        // dd(Customer::where('name', $request->customer_name)
        //     ->first()->id);
        // dd($a->id);

        $customer_id = CustomerService::customerSet($request->customer_name);

        $start_time = ReservationService::joinDateAndTime($request->date, $request->start_time);
        $end_time = ReservationService::joinDateAndTime($request->date, $request->end_time);

        Reservation::create([
            'user_id' => Auth::id(),
            'customer_id' => $customer_id,
            'content' => $request->content,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        // session()->flash('status', '新規予約を登録しました。');

        return to_route('index')
            ->with([
                'message' => '新規予約を登録しました。',
                'status' => 'info'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation) {
        //
    }
}
