<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class UserInfo extends Model
{
    protected $table = 'userinfo';
    public $timestamps = true;
    public $primaryKey = 'id';

    /**
     * 查询用户个人历史信息
     * @param $name
     * @return |null
     */
    public static function getUserInfo($name){
        try {
            $res = self::join('lab','userinfo.lab_id','lab.lab_id')
                -> select('userinfo.user_name','userinfo.mobile','userinfo.create_at','lab.lab_name')
                -> where('userinfo.user_name',$name)
                -> orderby('create_at','DESC')
                -> get();
            return $res;
        }catch (\Exception $e){
            logError('查询用户个人信息失败',[$e->getMessage()]);
            return null;
        }
    }


    /**
     * 存储个人进入实验室信息
     * @param $name
     * @param $lab_id
     * @return false
     */
    public static function insertUserInfo($name,$mobile,$lab_id){
        try {
            $res = self::insert([
                'user_name' => $name,
                'mobile' => $mobile,
                'lab_id' => $lab_id,
                'create_at' => date('Y-m-d H:i:s')
            ]);
            return $res;
        }catch (\Exception $e){
            logError('录入信息失败',[$e->getMessage()]);
            return false;
        }
    }
    public static function tsy_selectLab(){
        $data = DB::table('tsy_view1')->get();
        return $data;
    }


    //获取指定时间段的时间
    public static function tsy_select($date,$beforeDate,$lab_id){
        try {

            $sql= "select lab_id,count(*) as num  from userinfo where DATE_FORMAT(create_at,'%Y-%m-%d %H')>= :beforeDate and DATE_FORMAT(create_at,'%Y-%m-%d %H')< :date1 and lab_id = :lab_id group by lab_id";

            $data = DB::select(
                    $sql,
                    [':date1' => $date ,':beforeDate' => $beforeDate,':lab_id' => $lab_id]
            );
            return $data;
        }catch(\Exception $e){
            logError("shibai",[$e->getMessage()]);
        }
    }

    /**
     * 获取进出人员信息
     * @return \Illuminate\Http\JsonResponse
     */
    public static function LabInOut1(){
        try {
            $res = DB::table('view3')->get();
            return $res;
        } catch (\Exception $e) {
            logError('失败',[$e->getMessage()]);
            return null;
        }

    }

    /**
     * 获取进出人员信息(本周，本月，本学期)
     * @return \Illuminate\Http\JsonResponse
     */
    public static function LabInOut2(){
        try {
            $res = DB::table('view2')->get();
            return $res;
        } catch (\Exception $e) {
            logError('失败',[$e->getMessage()]);
            return null;
        }

    }


    //数据模
    public function Lab(){
        return $this -> belongsTo(Lab::class);
    }
}
