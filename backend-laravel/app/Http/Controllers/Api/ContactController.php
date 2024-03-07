<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $contacts = $user->contacts;

        if ($contacts->count() > 0) {
            return response()->json([
                'status' => 200,
                'contacts' => $contacts
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No contacts found for the user'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'position' => 'required|string|max:191',
            'adress' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'number' => 'required|string|max:191',
            'image' => 'nullable|url|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $user = Auth::user();
            $contact = $user->contacts()->create([
                'name' => $request->name,
                'position' => $request->position,
                'adress' => $request->adress,
                'email' => $request->email,
                'number' => $request->number,
                'image' => $request->image,
            ]);

            if ($contact) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Contact created successfully',
                    'id' => $contact->id,
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong, try again'
                ]);
            }
        }
    }

    public function show($id)
{
    $user = Auth::user();
    $contact = Contact::find($id);

    if (!$contact) {
        return response()->json([
            'status' => 404,
            'message' => 'Contact not found'
        ], 404);
    }

    if ($user->id !== $contact->user_id) {
        return response()->json([
            'status' => 403,
            'message' => 'You dontt have permission to access this contact'
        ], 403);
    }

    return response()->json([
        'status' => 200,
        'contact' => $contact
    ], 200);
}

public function update(Request $request, $id){
    $user = Auth::user();
    $contact = Contact::find($id);

    if (!$contact) {
        return response()->json([
            'status' => 404,
            'message' => 'Contact not found'
            ], 404);
         }
         if ($user->id !== $contact->user_id) {
            return response()->json([
                'status' => 403,
                'message' => 'You don\'t have permission to update this contact'
            ], 403);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'position' => 'required|string|max:191',
            'adress' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'number' => 'required|string|max:191',
            'image' => 'nullable|url|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $contact->update([
                'name' => $request->name,
                'position' => $request->position,
                'adress' => $request->adress,
                'email' => $request->email,
                'number' => $request->number,
                'image' => $request->image,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Contact updated successfully',
                'contact' => $contact
            ]);
        }
    }
}