<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Illuminate\Http\Request;

class ExamController extends BaseController
{
    public function add()
    {
    	//查找出车辆信息
    	$data = DB::table('bus')
    				->get()
    				->toArray();
    	// echo "<pre>";
    	// print_r($data);die;
    	return view('exam.add',['data'=>$data]);
    }


    public function adds(Request $res)
    {
    	//进行添加入库
    	$data = DB::table('study')->insert([
    		's_name' => $res->s_name,
    		'id_number' => $res->id_number,
    		'sex' => $res->sex,
    		'unit' => $res->unit,
    		'type' => $res->type,
    		'agent_name' => $res->agent_name,
    		'agent_unit' => $res->agent_unit,
    		'state' => $res->state,
    		'bid' => $res->bid,
    		'mid' => $res->mid
    	]);
    	if ($data) {
    		echo "<a href='show'>添加成功</a>";
    	}else{
    		echo "<a href='add'>添加失败</a>";
    	}
    }



    public function show(Request $res)
    {
    	//接受搜索值
    	$s_name = $res->s_name;
    	$bus_trains = $res->bus_trains;
    	$id_number = $res->id_number;
    	$m_id = $res->m_id;
    	//利用where把搜索条件和到一起
    	$where = '1';
    	if (!empty($s_name)) {
    		$where.=" and s_name like '%$s_name%'";
    	}

    	if (!empty($bus_trains)) {
    		$where.=" and bus_trains = $bus_trains";
    	}

    	if (!empty($id_number)) {
    		$where.=" and id_number = $id_number";
    	}

    	if (!empty($m_id)) {
    		$where.=" and m_id = $m_id";
    	}
    	//接受当前页
    	$page = $res->page;
    	if (empty($page)) {
    		$page = 1;
    	}
    	//每页的条数
    	$size = 3;
    	//查出数据库总条数
    	if ($where == '1') {
    		$count = count(DB::select("select * from study inner join bus on study.bid=bus.b_id inner join make on study.mid=make.m_id"));
    	}else{
    		$count = count(DB::select("select * from study inner join bus on study.bid=bus.b_id inner join make on study.mid=make.m_id where $where"));
    	}
    	//算出最后一页
    	$last = ceil($count/$size);
    	//上一页
    	$prev = ($page-1)<1?1:$page-1;
    	//下一页
    	$next = ($page+1)>$last?$last:$page+1;
    	//求出偏移量
    	$limit = ($page-1)*$size;
    	//查找数据库数据
    	if ($where == '1') {
    		$data = DB::select("select * from study inner join bus on study.bid=bus.b_id inner join make on study.mid=make.m_id limit $limit,$size");
    	}else{
    		$data = DB::select("select * from study inner join bus on study.bid=bus.b_id inner join make on study.mid=make.m_id where $where limit $limit,$size");
    	}
    	$make = DB::table('make')
    				->get()
    				->toArray();
    	// echo "<pre>";
    	// print_r($count);die;
    	return view('exam.show',['data'=>$data,'prev'=>$prev,'next'=>$next,'last'=>$last,'make'=>$make,'count'=>$count,'s_name'=>$s_name,'bus_trains'=>$bus_trains,'id_number'=>$id_number,'m_id'=>$m_id]);
    }




    public function details(Request $res)
    {
    	//接受id
    	$sid = $res->sid;
    	//查出指定id的详细信息
    	$data = DB::table('study')
    				->join('bus','study.bid','=','bus.b_id')
    				->join('make','study.mid','=','make.m_id')
    				->where('sid','=',$sid)
    				->get()
    				->toArray();
    	// echo "<pre>";
    	// print_r($data);die;
    	return view('exam.details',['data'=>$data]);
    }



    public function del(Request $res)
    {
    	//接受要删除的id
    	$sid = $res->sid;
    	//根据id指定删除数据
    	$data = DB::table('study')->where('sid','=',$sid)->delete();
    	if ($data) {
    		echo 1;
    	}else{
    		echo 2;
    	}
    }



    public function id_Number(Request $res)
    {
    	//接受身份证号
    	$id_number = $res->id_number;
    	//查找数据库中是否有此身份证号
    	$data = DB::table('study')->where('id_number','=',$id_number)->first();
    	if ($data) {
    		echo "1";
    	}else{
    		echo "0";
    	}
    }


}
