<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Category;
use Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $event = Event::all();
        return view('Events.event',compact('event'));
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
        $event->organizer = auth::id();
        $event->category_id = $request->categoryid;
        if ($request->hasfile('eventPicture')){
            $event->eventPicture = $request->eventPicture;
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
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }



    public function showExploreEventView(){
        return view('Events.explore');
    }
    public function showYourEventView(){
        $events = Event::orderBy('startDate')->get();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('Events.yourEvents', compact('categories', 'data','events'));
    }
}
