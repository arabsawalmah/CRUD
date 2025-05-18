<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['event'] = \App\Models\Event::all(); // Fetch all events from the database
        $data['title'] = 'Data Event'; // Set the title for the view
        return view('event/data_event', $data); // Return the view with the data
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $data['event'] = new \App\Models\Event(); 
    
      $data['route'] = 'dataevent.store'; 
    
      $data['method'] = 'post';
    
      $data['titleForm'] = 'Form Input Event'; 
    
      $data['submitButton'] = 'Submit';
    
      return view('event/form_event', $data); 
   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required',
        'ID' => 'required', 
        'status' => 'required', 
        'Time'=>'required',
        'Date' => 'required|date'
    ]);

    $inputEvent = new \App\Models\Event(); 
    $inputEvent->name = $request->name;
    $inputEvent->ID = $request->ID;
    $inputEvent->status = $request->status;     
    $inputEvent->Time = $request->Time; 
    $inputEvent->Date = $request->event_date;  
    $inputEvent->save();
    return redirect('/dataevent'); 

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    
        $data['event'] = \App\Models\Event::findOrFail($id);
        $data['route'] = ['dataevent.update',$id]; 
        $data['method'] = 'put';
        $data['titleForm'] = 'Form Edit Event'; 
        $data['submitButton'] = 'Submit';
        return view('event/form_event', $data); 
   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validData = $request->validate([
        'name' => 'required',
        'ID' => 'required', 
        'status' => 'required', 
        'Time'=>'required',
        'Date' => 'required|date'
        ]);
        $editEvent=\App\Models\Event::findOrfail($id);
        $editEvent->update($validData);
        return redirect('/dataevent');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteData=\App\Models\Event::where('id',$id)->firstOrFail();
        $deleteData->delete();
        return redirect('/dataevent');
    }
}
