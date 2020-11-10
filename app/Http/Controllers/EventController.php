<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::with('eventDates')->paginate(10);
    }

    /**
     * Show an event.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return $event->audits;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dump($request->input('event_dates')); die;

        $event = new Event($request->all());
        $event->author()->associate(User::firstOrFail());
        $event->save();

        if ($request->input('event_dates')) {
            $event->eventDates()->createMany($request->input('event_dates'));
        }

        return $event;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event        $event
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        return $event;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return 204;
    }

    /**
     * Publish an event.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event        $event
     *
     * @return \Illuminate\Http\Response
     */
    public function publish(Event $event)
    {
        if ($event->published) {
            return $event;
        }
        $event->publish();

        return $event;
    }
}
