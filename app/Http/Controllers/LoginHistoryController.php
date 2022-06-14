<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $search = $request->get('search');
        
        if($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        $loginhistory = LoginHistory::when($search, function ($query) use ($search) {
                $query->where(function ($sub_query) use ($search) {
                    $sub_query->where('username', 'LIKE', "%{$search}%")
                    ->orWhere('time', 'LIKE', "%{$search}%")
                    ->orWhere('ip_address', 'LIKE', "%{$search}%")
                    ->orWhere('user_agent', 'LIKE', "%{$search}%");
                });
        })->when(($order && $by), function ($query)use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate(10);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $loginhistory->appends($query_string);
        return $loginhistory;
        
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
     * Display the specified resource.
     *
     * @param  \App\Models\LoginHistory  $loginHistory
     * @return \Illuminate\Http\Response
     */
    public function show(LoginHistory $loginHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoginHistory  $loginHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(LoginHistory $loginHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoginHistoryRequest  $request
     * @param  \App\Models\LoginHistory  $loginHistory
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoginHistory  $loginHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoginHistory $loginHistory)
    {
        //
    }
}
