<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Category;
use App\User;
use Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('Events.event', compact('events', 'categories', 'data'));
    }
    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $event = new Event();
        $event->location = $request->city;
        $event->title = $request->title;
        $event->startDate = $request->startDate;
        $event->endDate = $request->endDate;
        $event->startTime = $request->startTime;
        $event->endTime = $request->endTime;
        $event->description = $request->description;
        $event->category_id = $request->categoryid;
        $event->organizer = auth::id();
        if ($request->hasfile('eventPicture')) {
            $file = $request->file('eventPicture');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('image/', $filename);
            $event->eventPicture = $filename;
        }
        $event->save();
        return redirect('yourEventsView');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEvent(Request $request, $id)
    {
        $events = Event::orderBy('startDate')->get();

        $event = Event::find($id);

        $event->location = $request->location;
        $event->title = $request->title;
        $event->startDate = $request->startDate;
        $event->endDate = $request->endDate;
        $event->startTime = $request->startTime;
        $event->endTime = $request->endTime;
        $event->description = $request->description;
        $event->category_id = $request->categoryid;
        if ($request->hasfile('eventPicture')) {
            $file = $request->file('eventPicture');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('image/', $filename);
            $event->eventPicture = $filename;
        }
        $event->save();
        return back();
    }


    /**
     * Remove event
     *
     * @param  $id is the number
     * @return \Illuminate\Http\Response
     */
    public function deleteEvent($id)
    {
        $deleteEvents = Event::find($id);
        $deleteEvents->delete();
        return back();
    }
    /**
     * Display Explore event view
     * @return \Illuminate\Http\Response
     */


    public function showExploreEventView()
    {
        $users = User::all();
        $events = Event::orderBy('startDate')->get();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('Events.explore', compact('categories', 'data', 'events', 'users'));
    }

    /**
     * 
     *Display your event veiw
     * @return \Illuminate\Http\Response
     */
    public function showYourEventView()
    {
        $events = Event::orderBy('startDate')->get();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('Events.yourEvents', compact('categories', 'data', 'events'));
    }

    /**
     * join event
     *
     * @param  \App\Event  $id
     * @return \Illuminate\Http\Response
     */
    public function joinEvent($id)
    {
        $event = Event::find($id);
        $event->numberOfMember = $event->numberOfMember + 1;
        $event->save();
        $event->users()->attach(auth::id());
        return back();
    }
    /**
     * Quit event from event that joined
     *
     * @param  \ get the specific id of event \\ $id
     * @return \Illuminate\Http\Response
     */

    public function quitEvent($id)
    {
        $event = Event::find($id);
        $event->numberOfMember = $event->numberOfMember - 1;
        $event->save();
        $event->users()->detach();
        return back();
    }
    /**
     * Display calendar view
     * @return \Illuminate\Http\Response
     */

    public function calendarView()
    {
        $events = Event::orderBy('startDate')->get();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('Events.calendar', compact('categories', 'data', 'events'));
    }

    /**
     * Show events on calendar
     * @return \Illuminate\Http\Response
     */
    public function calendarviews()
    {
        $events = Event::all();
        return view('Events.calendar', compact('events'));
    }

    /**
     * Check event has been joined
     * @return \Illuminate\Http\Response
     */
    public function onlyJoinEvent()
    {
        $events = Event::orderBy('startDate')->get();
        $users = User::all();
        return view("Events.onlyJoinEvent", compact('events', 'users'));
    }
}
