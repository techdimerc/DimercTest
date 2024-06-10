<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\Contact\StoreRequest;
use App\Http\Requests\Contact\UpdateRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Inertia\Inertia;



class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts=Contact::where('user_id',Auth::user()->id)->get();

        return Inertia::render('Contact/Index',compact('contacts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('Contact/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //
        $data =$request->except('avatar');

        if($request->hasFile('avatar'))
        {

            $file=$request->file('avatar');

            $routeName=$file->store('avatars',['disk'=>'public']);

            $data['avatar']=$routeName;
        }

        $data['user_id']=Auth::user()->id;

        Contact::create($data);

        to_route('contact.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
        return Inertia::render('Contact/Edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Contact $contact)
    {
        //
        $data =$request->except('avatar');

        if($request->hasFile('avatar'))
        {        
            $file=$request->file('avatar');
            $routeName=$file->store('avatars',['disk'=>'public']);
            $data['avatar']=$routeName;

            if($contact->avatar){
                Storage::disk('public')->delete($contact->avatar);
            }
        }

        $contact->update($data);       
        return to_route('contact.edit',$contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
        if($contact->avatar){
            Storage::disk('public')->delete($contact->avatar);
        }

        $contact->delete();

        return to_route('contact.index');

    }
}
