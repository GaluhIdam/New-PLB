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
        $search_email = $request->get('search_email');
        $search_last_login_at = $request->get('search_last_login_at');
        $search_last_login_ip = $request->get('search_last_login_ip');
        $search_last_login_device = $request->get('search_last_login_device');

        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'last_login_at';
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
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('last_login_at', 'LIKE', "%{$search}%")
                    ->orWhere('last_login_ip', 'LIKE', "%{$search}%")
                    ->orWhere('last_login_device', 'LIKE', "%{$search}%");
            });
        })
            ->when($search_username, function ($query) use ($search_username) {
                $query->where('username', 'LIKE', "%{$search_username}%");
            })
            ->when($search_email, function ($query) use ($search_email) {
                $query->where('email', 'LIKE', "%$search_email%");
            })
            ->when($search_last_login_at, function ($query) use ($search_last_login_at) {
                $query->where('last_login_at', 'LIKE', "%{$search_last_login_at}%");
            })
            ->when($search_last_login_ip, function ($query) use ($search_last_login_ip) {
                $query->where('last_login_ip', 'LIKE', "%{$search_last_login_ip}%");
            })
            ->when($search_last_login_device, function ($query) use ($search_last_login_device) {
                $query->where('last_login_device', 'LIKE', "%$search_last_login_device%");
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