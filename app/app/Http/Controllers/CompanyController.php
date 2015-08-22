<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\UserNexus;
use App\Http\Requests;
use App\Http\Controllers\BaseController;

/**
 * 代账公司设置
 * @description 需要中间件进行保护 要求必须有Session::has('company_id')
 * @package App\Http\Controllers
 * @version 1.0
 * @author  AndyLee <root@lostman.org>
 */

/**
 * Class CompanyController
 * @package App\Http\Controllers
 * @version 1.0
 * @author  AndyLee <root@lostman.org>
 */
class CompanyController extends BaseController
{
    /**
     * 获取代账公司信息
     * @return mixed
     * @Param integer $id
     * @param Request $request
     * @author AndyLee <root@lostman.org>
     */
    public function getCompanyInfo(Request $request, $id)
    {

        $company_id = $request->session()->get('company_id');

        try{

            $nexus = UserNexus::whereRaw('user_id =? and operator_id = ?',
                [$company_id, Auth::user()->id]
            )->firstOrFail();

        }catch (ModelNotFoundException $e){
            $request->session()->flash('error', '当前纪录不存在!');
            return redirect()->back();
        }

        $users = UserNexus::where('user_id', $company_id)->get();

        return view('user.company')->with('nexus', $nexus)
            ->with('users', $users)
            ->with('count', $users->count())
            ->with('company', $nexus->company);

    }

    /**
     * 列出公司成员
     * @param string $id 公司id
     * @return view
     * @author AndyLee <root@lostman.org>
     */
    public function getMember($id)
    {
        return view('user.user_list');
    }

    /**
     * 创建邀请链接
     * @author AndyLee <root@lostman.org>
     */
    public function getInvite()
    {
        return view('user.invite');
    }
}
