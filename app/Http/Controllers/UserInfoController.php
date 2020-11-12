<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    public function ddSaoMa(Request $request){
        $lab_id = $request['qrcode'];
        $code = $request['code'];
        $userid = $this->getUserIdByCode($code);
        $userinfos = $this->getUserInfos($userid);
        $name = $userinfos['name'];
        $mobile = $userinfos['mobile'];

        $exists = Lab::labIsExist($lab_id);
        if ($exists){
            // 记录该用户的信息
            $res = UserInfo::insertUserInfo($name,$mobile,$lab_id);
            return $res?
                json_success('录入成功！',null,200):
                json_fail('录入失败！',null,100);
        }else{
            return json_fail('此二维码错误，请扫描正确的二维码！',null,100);
        }
    }

    /**
     * 获取用户的历史信息
     * @param Request $request
     *      [code] => '授权码'
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfo(Request $request){
        $code = $request['code'];
        $userid = $this->getUserIdByCode($code);
        $userinfos = $this->getUserInfos($userid);

        $name = $userinfos['name'];
        $res = UserInfo::getUserInfo($name);
        return $res != null ?
            json_success('获取个人信息成功', $res, 200) :
            json_fail('获取个人信息失败', null, 100);
    }

    /**
     * 获取userid
     * @param $code 授权码
     * @return mixed
     */
    public function getUserIdByCode($code){
        $app = getApp();
        $res = $app->user->getUserByCode($code);
        return $res['userid'];
    }


    /**
     * 获取用户信息
     * @param $userid 钉钉内部的唯一用户id
     * @return mixed
     */
    public function getUserInfos($userid){
        $app = getApp();
        $res = $app->user->get($userid, $lang = null);
        return $res;
    }
}
