<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Customer;
use App\Models\User;
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

        $start_date = ReservationService::joinDateAndTime($request->date, $request->start_time);
        $end_date = ReservationService::joinDateAndTime($request->date, $request->end_time);

        Reservation::create([
            'user_id' => Auth::id(),
            'customer_id' => $customer_id,
            'content' => $request->content,
            'start_date' => $start_date,
            'end_date' => $end_date,
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
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation) {

        $reservation = Reservation::findOrFail($reservation->id);
        if ($reservation->customer->name === '設定なし') {
            $reservation->customer->name = '';
        }

        // $date = $reservation->start_date;
        $date = Carbon::parse($reservation->start_date)->format('Y-m-d');
        return view('reservations.edit', compact('reservation', 'date'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation) {
        // dd($request, $reservation);

        $check = ReservationService::checkReservationDuplicationExceptOwn($request->id, $request->date, $request->start_time, $request->end_time);
        // dd($check);
        $reservation = Reservation::findOrFail($reservation->id);
        // dd($reservation->id);

        if ($check) {
            // session()->flash('status', 'この時間帯は既に他の予約が登録済みです。');
            $date = $request->date;
            return to_route('reservations.edit', compact('reservation', 'date'))
                ->with([
                    'message' => 'この時間帯は既に他の予約が登録済みです。',
                    'status' => 'alert',
                    // 'entry_date' => $request->date,
                    // 'entry_start_time' => $request->start_time,
                    // 'entry_end_time' => $request->end_time,
                    // 'entry_content' => $request->content,
                    // 'entry_customer_name' => $request->customer_name,
                ]);
        }

        $customer_id = CustomerService::customerSet($request->customer_name);

        $start_date = ReservationService::joinDateAndTime($request->date, $request->start_time);
        $end_date = ReservationService::joinDateAndTime($request->date, $request->end_time);

        $reservation->customer_id = $customer_id;
        $reservation->start_date = $start_date;
        $reservation->end_date = $end_date;
        $reservation->content = $request->content;
        $reservation->save();

        return to_route('list')
            ->with([
                'message' => '予約を修正しました。',
                'status' => 'info'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation) {
        $reservation->delete();
        return redirect()->route('list')
            ->with([
                'message' => '予約を削除しました。',
                'status' => 'alert'
            ]);
    }

    public function list() {

        $today = Carbon::today();

        // $reservations = DB::table('reservations')
        //     ->where('user_id', Auth::id())
        //     ->whereDate('start_time', '>=', $today)
        //     ->orderBy('start_time', 'asc')
        //     ->with('customer')
        //     ->paginate(1);

        $reservations = Reservation::where('user_id', Auth::id())
            ->whereDate('start_date', '>=', $today)
            ->orderBy('start_date', 'asc')
            ->with('customer')
            ->paginate(10);
        // dd($reservations->reservedDate);




        return view('reservations.list', compact('reservations'));
    }

    public function past() {

        $today = Carbon::today();

        // $reservations = DB::table('reservations')
        //     ->where('user_id', Auth::id())
        //     ->whereDate('start_time', '>=', $today)
        //     ->orderBy('start_time', 'asc')
        //     ->with('customer')
        //     ->paginate(1);

        $reservations = Reservation::where('user_id', Auth::id())
            ->whereDate('start_date', '<', $today)
            ->orderBy('end_date', 'desc')
            ->with('customer')
            ->paginate(10);
        // dd($reservations->reservedDate);




        return view('reservations.past', compact('reservations'));
    }

    public function daily($today) {
        $reservations = Reservation::whereDate('start_date', '=', $today)->get();
        $dayOfWeek = dayOfWeekJapanese($today);


        $todayForView = Carbon::parse($today)->format('m月d日');
        $myId = Auth::id();
        return view('calendar.daily', compact('today', 'dayOfWeek', 'todayForView', 'reservations', 'myId'));
    }
}
