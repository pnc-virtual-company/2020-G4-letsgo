<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Category;
use App\User;
use Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function deleteEvent($id)
    {
        $deleteEvents = Event::find($id);
        $deleteEvents->delete();
        return back();
    }



    public function showExploreEventView()
    {
        $users = User::all();
        $events = Event::orderBy('startDate')->get();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('Events.explore', compact('categories', 'data', 'events', 'users'));
    }
    public function showYourEventView()
    {
        $events = Event::orderBy('startDate')->get();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('Events.yourEvents', compact('categories', 'data', 'events'));
    }
    public function joinEvent($id)
    {
        $event = Event::find($id);
        $event->numberOfMember = $event->numberOfMember + 1;
        $event->save();
        $event->users()->attach(auth::id());
        return back();
    }
}
