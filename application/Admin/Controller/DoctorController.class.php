<?php
/**
 * Created by PhpStorm.
 * User: susunsheng
 * Date: 16/9/19
 * Time: 上午1:34
 */

namespace Admin\Controller;


use Portal\Model\AppointmentModel;
use Portal\Model\DoctorModel;
use Portal\Model\ScoreItemModel;
use Common\Controller\AdminbaseController;

define(CONTROLLER, __CONTROLLER__);

class  DoctorController extends AdminbaseController
{
//    function table(){
//        //获取系统常量, 并分组
//        //var_dump(get_defined_constants(true));
//
//        $this -> display();
//    }

    function table($queryStr = "", $page = 1, $pagesize = 10)
    {


        \Think\Log::write('login table:', "INFO");

        $db = new DoctorModel();

        //使用map作为查询条件,混合模式
        $where['realname'] = array('like', '%' . $queryStr . '%');
        $where['_logic'] = 'or';
        $map['_complex'] = $where;
//        dump($map);

        //利用page函数。来进行自动的分页
        $data = $db->alias('a')->page($page, $pagesize)
            ->join('__DICT_STATUS__ as status ON status.id = a.status')
            ->field('a.*,a.status as statusCode,
                 status.title as status')
            ->where($map)
            ->select();
        $recordnum = $db->page($page, $pagesize)
            ->where($map)
            ->count();

        //计算分页
        $pagenum = $recordnum / $pagesize;
        //如果不能整除，则自动加1页
        if ($pagenum % 1 !== 0) {
            \Think\Log::write('login record pagenum: '.$pagenum, "INFO");
            $pagenum = (int)$pagenum + 1;
        }

//        var_dump(($data),true);
        \Think\Log::write('login write', 'WARN' . $data);

        $this->data = $data;
        $this->pagenum = $pagenum;
        $this->page = $page;
        $this->pagesize = $pagesize;
        $this->recordnum = $recordnum;
        $this->title = "医生列表";

        $this->display();
        \Think\Log::write('login end', "INFO");

    }


    /*
     * 医生信息
     * */
    function form()
    {
        \Think\Log::write('form begin:', "INFO");
        $db = new DoctorModel();

        if (isset($_GET['doctorId'])) {
            $this->data = $db->alias('a')->join('__DICT_TITLE__ as title ON title.id = a.title')
                ->where('a.id='.$_GET['doctorId'])->find();

            $cureTime = explode(',', $this->data["curetime"]);
            $cureTimes = [];
            foreach($cureTime as $ct){
                    $cureTimes[$ct["id"]] = 'checked';
            }
            $this->cureTimes =$cureTimes;

            $this->retCode = "00";
            $this->msg = "查找成功";
            $this->doctorId = $_GET['doctorId'];


        } else {
            $this->retCode = "01";
            $this->msg = "未找到该信息";

        }

        $this->title = "医生信息";
        $this->statuscode = $_GET['statuscode'];
        $this->display();
        \Think\Log::write('login form end', "INFO");

    }


    /*
     * 预约信息-后台显示
     * */
    function appointment($queryStr = '', $page = 1, $pagesize = 10)
    {
        \Think\Log::write('login appointment:', "INFO");

        $DoctorController = new \Portal\Controller\DoctorController();

        list($data, $recordnum, $pagenum) = $DoctorController->innerAppointment($queryStr, $page, $pagesize);

//        var_dump(($data),true);
        \Think\Log::write('login write', 'WARN' . $data);

        $this->data = $data;
        $this->pagenum = $pagenum;
        $this->page = $page;
        $this->pagesize = $pagesize;
        $this->recordnum = $recordnum;
        $this->title = "预约信息";

        $this->display();
        \Think\Log::write('login end', "INFO");
    }

    //审核通过预约
    function passAppointment($id)
    {
        \Think\Log::record('passAppointment record:'.$id);
        \Think\Log::record('passAppointment record APPOINTMENT_ADMIN_PASS:'.APPOINTMENT_ADMIN_PASS);
        $db = new AppointmentModel();
//        $db->where('id=' . $id)->delete();
        $db->where('id=' . $id)->setField('status',APPOINTMENT_ADMIN_PASS);
        \Think\Log::record('passAppointment record end');
    }

    //审核失败预约
    function cancelAppointment($id)
    {
        \Think\Log::record('cancelAppointment record:'.$id);
        $db = new AppointmentModel();
//        $db->where('id=' . $id)->delete();
        $db->where('id=' . $id)->setField('status',APPOINTMENT_FAIL);
        \Think\Log::record('cancelAppointment record end');
    }

    //删除医生
    function deleteDoctor($id){
        \Think\Log::record('deleteDoctor record:'.$id);
        $db = new DoctorModel();
        $db->where('id=' . $id)->delete();
        \Think\Log::record('deleteDoctor record end');
    }

    //审核通过医生
    function passDoctor($id, $x, $y){
        \Think\Log::record('passDoctor record:'.$id);
        \Think\Log::record('setDoctorPosition record:'.$x);
        \Think\Log::record('setDoctorPosition record:'.$y);
        $db = new DoctorModel();
        $db->where('id=' . $id)->setField('status',DOCTOR_PASS);
        $db->where('id=' . $id)->setField('x',$x);
        $db->where('id=' . $id)->setField('y',$y);

        \Think\Log::record('passDoctor record end');
    }

    //审核失败医生
    function cancelDoctor($id){
        \Think\Log::record('cancelDoctor record:'.$id);
        $db = new DoctorModel();
        $db->where('id=' . $id)->setField('status',DOCTOR_FAIL);

        $db->where('id=' . $id)->delete();
        \Think\Log::record('cancelDoctor record end');
    }


    /*
      * 专家团队-后台显示
      * */
    function score()
    {
        \Think\Log::write('score:', "INFO");

        $db = new ScoreItemModel();

        if (!empty($_POST)) {   //post 提交更新专家信息
            \Think\Log::write('post expert:', "INFO");

            foreach ($_POST as $key => $value)
            {
                $data['value'] = $value;
                $db->where('id='.'\''.$key.'\'')->save($data);
                \Think\Log::write('score:'.$key, "INFO");
            }
        } else {
            //利用page函数。来进行自动的分页
            $data = $db->select();
            $this->data = $data;
            $this->title = "积分项目列表";
            $this->display();

        }

        \Think\Log::write('expert end', "INFO");
    }

}