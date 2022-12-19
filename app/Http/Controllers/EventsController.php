<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\User;
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
        $users  = User::all();
        return view('events.create', compact(['events', 'users']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $events = Events::all()->makeHidden(['created_at', 'updated_at']);
        $users  = User::all();
        return view('events.list', compact(['events', 'users']));
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
        if ($events >= 4) {
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
        if ($event->save()) :
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
    public function show(Request $request, $slug)
    {
        $event = Events::where('slug', $slug)->count();
        if ($event < 1) :
            $result = get_error_response(404, "Event not found",  ["error" => "Event not found"]);
            return response()->json($result, 404);
        elseif ($event > 0) :
            $event = Events::where(['user_id', $request->user->id])->where('slug', $slug)->first();
            $result = get_success_response($event);
            return response()->json($result, 200);
        else :
            $event = Events::where('user_id', 0)->where('slug', $slug)->first();
            $result = get_success_response($event);
            return response()->json($result, 200);
        endif;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Events::findorFail($id);
        $users  = User::all();
        return view('events.edit', compact(['event', 'users']));
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
        $this->validate($request, [
            'event_title'           =>  'required',
            'event_start'           =>  'required',
            'event_description'     =>  'required',
        ]);

        if ($request->user_id != 0) :
            $check_event = Events::where('id', $id)->where('user_id', $request->user_id)->count();
            if ($check_event < 1) :
                // create event for user
                if ($this->store($request)) :
                    return back()->with('success', "Event updated successfully");
                else :
                    return back()->with('error', "Error encountered while updating event");
                endif;
            endif;
        endif;

        $event = Events::findorFail($id);
        $event->title         = $request->event_title;
        $event->user_id       = $request->user_id;
        $event->slug          = Str::slug($request->event_title);
        $event->start         = $request->event_start;
        $event->end           = $request->event_end;
        if ($request->has('event_image')) :
            $event->image     = save_image('events', $request->event_image);
        endif;
        $event->description   = $request->event_description;

        if ($event->save()) :
            return back()->with('success', "Event updated successfully");
        else :
            return back()->with('error', "Error encountered while updating event");
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Events::destroy([$id])) :
            return back()->with('success', "Event deleted successfully");
        else :
            return back()->with('error', "Unable to delete event");
        endif;
    }
}
