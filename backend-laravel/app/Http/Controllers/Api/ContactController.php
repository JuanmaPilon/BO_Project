<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}