<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function createReport(User $user, CreateReport $request)
    {
        $user->reports_received()->create([
            'token' =>  md5(uniqid() . Auth::id()),
            'reporter_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description
        ]);

        return response()->json([
            'title' => 'Report on user received',
            'msg' => "Our adminstrators would tend to your query and take neccessary measures"
        ], 201);
    }
}
