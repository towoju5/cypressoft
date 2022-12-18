<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Events::all()->makeHidden(['user_id', 'created_at', 'updated_at']);
        return view('events.create', compact('events'));
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
        $this->validate($request, [
            'event_title'           =>  'required',
            'event_image'           =>  'required',
            'event_start'           =>  'required',
            'event_description'     =>  'required',
        ]);

        // check limits
        $events = Events::where('created_at', Carbon::today())->count();
        if($events >= 4){
            return back()->with('error', "Event limit reached for today");
        } 
        $event = new Events();
        $event->title         = $request->event_title;
        $event->user_id       = $request->user_id;
        $event->slug          = Str::slug($request->event_title);
        $event->start         = $request->event_start;
        $event->end           = $request->event_end;
        $event->image         = save_image('events', $request->event_image);
        $event->description   = $request->event_description;
        if($event->save()):
            return back()->with('success', "Event added successfully");
        else :
            return back()->with('error', "Error encountered while saving event");
        endif;
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
        return $event = Events::with('user')->findorFail($id);
        return view('event.edit', compact('event'));
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
