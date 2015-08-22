<?php
/**
 * @Author Xiaoming <minco.wang@gmail.com>
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WxUser extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'wx_users';

    public static function getByOpenId($openId)
    {
        return self::where('openid', $openId)->first();
    }


    /**
     * 保存微信用户信息
     * @param $user
     * @return mixed
     * @throws \Exception
     */
    public static function saveWxUser($obj)
    {
        $user = new self;
        $user->nickname = isset($obj->nickname) ? $obj->nickname : '';
        $user->openid = $obj->openid;
        $user->sex = isset($obj->sex) ? $obj->sex : 0;
        $user->province = isset($obj->province) ? $obj->province : '';
        $user->city = isset($obj->city) ? $obj->city : '';
        $user->country = isset($obj->country) ? $obj->country : '';
        $user->headimgurl = isset($obj->headimgurl) ? $obj->headimgurl : '';
        $user->subscribe = $obj->subscribe;
        $user->unionid = isset($obj->unionid) ? $obj->unionid : null;
        $user->save();
        return $user;
    }

    /**
     * 更新
     * @param $user
     * @return mixed
     * @throws \Exception
     */
    public function updateWxUser($obj)
    {
        $this->nickname = isset($obj->nickname) ? $obj->nickname : '';
        $this->openid = $obj->openid;
        $this->sex = isset($obj->sex) ? $obj->sex : 0;
        $this->province = isset($obj->province) ? $obj->province : '';
        $this->city = isset($obj->city) ? $obj->city : '';
        $this->country = isset($obj->country) ? $obj->country : '';
        $this->headimgurl = isset($obj->headimgurl) ? $obj->headimgurl : '';
        $this->subscribe = $obj->subscribe;
        $this->unionid = isset($obj->unionid) ? $obj->unionid : null;
        $this->save();
    }
}
