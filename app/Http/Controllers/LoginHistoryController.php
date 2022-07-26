<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $this->recordActivity('Akses Login History');
        $search = $request->get('search');
        $search_username = $request->get('search_username');
        $search_time = $request->get('search_time');
        $search_ip_address = $request->get('search_ip_address');
        $search_user_agent = $request->get('search_user_agent');

        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        $loginhistory = LoginHistory::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('username', 'LIKE', "%{$search}%")
                    ->orWhere('time', 'LIKE', "%{$search}%")
                    ->orWhere('ip_address', 'LIKE', "%{$search}%")
                    ->orWhere('user_agent', 'LIKE', "%{$search}%");
            });
        })
            ->when($search_username, function ($query) use ($search_username) {
                $query->where('username', 'LIKE', "%{$search_username}%");
            })
            ->when($search_time, function ($query) use ($search_time) {
                $query->where('time', 'LIKE', "%{$search_time}%");
            })
            ->when($search_ip_address, function ($query) use ($search_ip_address) {
                $query->where('ip_address', 'LIKE', "%{$search_ip_address}%");
            })
            ->when($search_user_agent, function ($query) use ($search_user_agent) {
                $query->where('user_agent', 'LIKE', "%{$search_user_agent}%");
            })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })
            ->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $loginhistory->appends($query_string);

        return $loginhistory;
    }
}