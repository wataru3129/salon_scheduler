<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Services\ReservationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


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
                    'entry_date' => $request->date,
                    'entry_start_time' => $request->start_time,
                    'entry_end_time' => $request->end_time,
                    'entry_content' => $request->content,
                    'entry_customer_name' => $request->customer_name,
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

        $reservation = Reservation::findOrFail($reservation->id);
        return view('reservations.show');
        // $date= $reservat

        // $users = $event->users;

        // $reservations = [];

        // foreach ($users as $user) {
        //     $reservedInfo = [
        //         'name' => $user->name,
        //         'number_of_people' => $user->pivot->number_of_people,
        //         'canceled_date' => $user->pivot->canceled_date,
        //     ];
        //     array_push($reservations, $reservedInfo);
        // }

        // // dd($reservations);

        // $eventDate = $event->eventDate;
        // $startTime = $event->startTime;
        // $endTime = $event->endTime;

        // // dd($event, $eventDate, $startTime, $endTime);

        // return view('manager.events.show', compact('event', 'users', 'reservations', 'eventDate', 'startTime', 'endTime'));


        return view('reservations.show');
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

    public function list(Reservation $reservation) {

        $today = Carbon::today();

        $reservations = DB::table('reservations')
            ->where('user_id', Auth::id())
            ->whereDate('start_time', '>=', $today)
            ->orderBy('start_time', 'asc')
            ->paginate(10);
        dd($reservations);



        return view('reservations.list', compact('reservations'));
    }
}
