<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class DataViewsController extends Controller
{
    /**
     * 获取进出人员信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function LabInOut1(){
        $res=UserInfo::LabInOut1();
        return $res != null ?
            json_success('获取成功!', $res, 200) :
            json_fail('获取失败!', null, 100);
    }

    /**获取进出人员信息(本周，本月，本学期)
     * @return \Illuminate\Http\JsonResponse
     */
    public function LabInOut2(){
        //echo "实验室进出统计2";
        $res=UserInfo::LabInOut2();
        return $res != null ?
            json_success('获取成功!', $res, 200) :
            json_fail('获取失败!', null, 100);
    }


    public function select(){
        $lab_id=UserInfo::tsy_selectLab();
        $before = now()->format("Y-m-d H");

        for ($j = 0;$j<count($lab_id);$j++) {
            $lab = $lab_id[$j]->labid;
            $lab_name = Lab::labName($lab)['lab_name'];
            $data[$j]['lab_name'] = $lab_name;
            for($i = 1,$k=5; $i <7;$i++,$k--){
                $date = $before;
                $before =date("Y-m-d H",time()-$i*3600);
                $data1 = $this->selectAfter($date, $before, $lab);
                if ($data1 != null){
                    $data[$j]['data'][$k] = $data1[0]->num;
                }else{
                    $data[$j]['data'][$k] = 0;
                }
            }
        }
        $number = count($lab_id);
        $data[$number][5] = now()->format("H:00");
        $data[$number][4] = date("H:00",time()-1*3600);
        $data[$number][3] = date("H:00",time()-2*3600);
        $data[$number][2] = date("H:00",time()-3*3600);
        $data[$number][1] = date("H:00",time()-4*3600);
        $data[$number][0] = date("H:00",time()-5*3600);
        return json_success("成功",$data,200);
    }


    public function selectAfter($date,$before,$lab_id){
        $data = UserInfo::tsy_select($date, $before, $lab_id);
        return $data;
    }
}



