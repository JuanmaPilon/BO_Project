<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index() {
    

        $contacts = Contact::all();
        if($contacts-> count() > 0) {
        return response()->json([
            'status' => 200,
            'contacts' => $contacts
        ], 200);
    } else
    return response()->json([
        'status' => 404,
        'message' => 'No contacts found'
    ],404);
}

public function store(Request $request) {
    $validator = Validator::make($request->all(), [
        'name'=> 'required|string|max:191',
        'position'=> 'required|string|max:191',
        'adress'=> 'required|string|max:191',
        'email'=> 'required|email|max:191',
        'number'=> 'required|string|max:191',
    ]);

    if($validator->fails()) {
        return response()->json([[
            'status'=> 422,
            'errors' => $validator->messages()
        ]],422);

    } else {
        $contact = Contact::create([
            'name'=> $request->name,
            'position'=> $request->position,
            'adress'=> $request->adress,
            'email'=> $request->email,
            'number'=> $request->number
        ]);

        if($contact) {
            return response()->json ([
                'status'=> 200,
                'message'=> 'Contact created successfully'
            ]);
        } else {
            return response()->json ([
                'status'=> 500,
                'message'=> 'Somethig went wrong, try again'
            ]);
        }
    }
}
}