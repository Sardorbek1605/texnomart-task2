<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FakeApiController extends Controller
{
    public function fake_sms(Request $request){
        $request->validate([
            'phone' => 'required',
        ]);
        $phone = $request->phone;
        $message = $request->message??null;
        return response()->json($request->all());
    }
}
