<?php

namespace App\Http\Middleware;

use Closure;
use App\CustomerCompany as Company;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CompanyFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->segment(2) == ''){
            $request->session()->flash('error', '您访问的公司不存在!');
            return redirect()->back();
        }
        $map = [
            'id' => $request->segment(2),
            'user_id' => $request->session()->get('company_id')
        ];

        try {
            $company = Company::where($map)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $request->session()->flash('error', '您访问的公司不存在!');
            return redirect()->back();
        }

        $company->last_active_time = time();
        $company->save();

        view()->share('customer', $company);

        $request->session()->put('customer_id', $company->id);

        view()->share('customer_id', $company->id);

        return $next($request);
    }
}
