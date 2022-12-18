<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->has('date_from') && !empty($request->date_from)) {
                if ($request->date_from > $request->date_to) {
                    $response = get_error_response(400, 'Invalid request', ['error' => 'Date from should be earlier']);
                    return response()->json($response, 400);
                }
                
                $date_from = Carbon::parse($request->date_from);

                if($request->has('date_to') && !empty($request->date_to)){
                    $date_to = Carbon::parse($request->date_to)->addDay();
                } else {
                    $date_to = Carbon::now()->addDay();
                }

                $events = Events::where('user_id', 1)
                    ->whereBetween('created_at', [$date_from, $date_to])
                    ->get()
                    ->makeHidden(['created_at', 'updated_at'])
                    ->toArray();
                $response = get_success_response($events);
                return response()->json($response, 200);
            }

            $events = Events::paginate(10)->toArray();
            return response()->json($events);

        } catch (\Throwable $th) {
            return get_error_response($th->getCode(), $th->getMessage(), [
                'error' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        try {
            $date_from = Carbon::parse($request->date_from);
            $date_to = Carbon::parse($request->date_to)->addDay();
            $events = Events::whereBetween('created_at', [$date_from, $date_to])
                ->get()
                ->makeHidden(['created_at', 'updated_at'])
                ->toArray();
            return get_success_response($events);
        } catch (\Throwable $th) {
            return get_error_response($th->getCode(), $th->getMessage(), [
                'error' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
