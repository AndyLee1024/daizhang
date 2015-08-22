<?php
namespace App\Http\Middleware;

use Closure;
use App\Company;
class SessionFilter
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

        if(!\Session::has('company_id')){
            \Session::flash('error', '请您先选择一个代账公司再进行操作');
            return redirect()->to(action('HomeController@getHome'));
        }

        return $next($request);
    }
}
