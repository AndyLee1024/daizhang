<?php
namespace App\Http\Middleware;

use App\WxUser;
use Closure;
use Illuminate\Support\Facades\Session;
use Overtrue\Wechat\Auth;
use Overtrue\Wechat\User;


class WeixinAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $appId = 'wx22be62c5077abcfe';
        $secret = 'f364efc269da0f33e7f376e0ca4c9cc0';

        $auth = new Auth($appId, $secret);
        $wxUser = Session::has("wxUser");
        if (!$wxUser) {
            $user = $auth->authorize(null, 'snsapi_base');
            $userService = new User($appId, $secret);
            $userInfo = $userService->get($user->openid);
            $wxUser = WxUser::getByOpenId($user->openid);
            if (!$wxUser) {
                $wxUser = WxUser::saveWxUser($userInfo);
            } else {
                $wxUser->updateWxUser($userInfo);
            }
            Session::put('wxUser', $wxUser);
        }
        return $next($request);
    }
}
