<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Deposit;
use App\Models\pengajuanInvestasi;
class notif
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $data = Deposit::with('oUser')->whereDate('created_at', Carbon::today())
        ->latest()
        ->get()->toArray();
        $pi = pengajuanInvestasi::with('oUser')->whereDate('created_at', Carbon::today())
        ->latest()
        ->get()->toArray();
        $col = collect($data);
       $merge = $col->merge($pi);
       $re = $merge->all();
       $request->session()->put('notifs', $re);


        return $next($request);
    }
}
