<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $table = 'lab';
    public $timestamps = false;
    protected $primaryKey = 'id';

    /**
     * 判断该实验室是否存在
     * @param $lab_id   实验室编号
     * @return mixed
     */
    public static function labIsExist($lab_id){
        try {
            $res = Lab::where('lab_id',$lab_id)
                -> exists();
            return $res;
        }catch (\Exception $e){
            logError('查询实验室信息失败！',[$e->getMessage()]);
            return false;
        }
    }

    public static function labName($lab_id){
        try{
            $data = self::where('lab_id',$lab_id)
                ->select('lab_name')
                ->first();
            return $data;
        }catch (\Exception $e){
            logError("失败",[$e->getMessage()]);
        }
    }
    //数据模
    public function UserInfo(){
        return $this -> hasMany(UserInfo::class);
    }


}
