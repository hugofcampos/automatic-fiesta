<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @group Events
 */
class EventController extends Controller
{
    /**
     * List.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::with(['author', 'eventDates'])->paginate(10);
    }

    /**
     * Show.
     *
     * @urlParam event string required The UUID of the post. Example: 94c102a4-a987-3e2a-b7df-c51805e6e494
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Create.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event($request->all());
        $event->author()->associate(User::firstOrFail());
        $event->save();

        if ($request->input('event_dates')) {
            $event->eventDates()->createMany($request->input('event_dates'));
        }

        return $event;
    }

    /**
     * Update.
     *
     * @urlParam event string required The UUID of the post. Example: 94c102a4-a987-3e2a-b7df-c51805e6e494
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
     * Delete.
     *
     * @urlParam event string required The UUID of the post. Example: 94c102a4-a987-3e2a-b7df-c51805e6e494
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
     * Publish.
     *
     * @urlParam event string required The UUID of the post. Example: 94c102a4-a987-3e2a-b7df-c51805e6e494
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
