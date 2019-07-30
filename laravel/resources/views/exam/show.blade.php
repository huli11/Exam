<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 条纹表格</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div id="box">
	<center><a href="add">信息录入</a></center>
<center>
	姓名： <input type="text" name="s_name" class="s_name" value="{{$s_name}}">
	身份证号： <input type="text" name="id_number" class="id_number" value="{{$id_number}}">
	班车班次： <input type="text" name="bus_trains" class="bus_trains" value="{{$bus_trains}}">
	预约状态： <input type="hidden" value="{{$m_id}}" class="mid">
			  <select name="m_id" class="m_id">
				@foreach ($make as $key => $val)
					<option value="{{$val->m_id}}">{{$val->make_name}}</option>
				@endforeach
			  </select>
	<button type="button" class="btn btn-default" id="search">搜索</button>
</center>
<table class="table table-striped">
	总条数{{$count}}
	<thead>
		<tr>
			<th>行号</th>
			<th>班车车次</th>
			<th>姓名</th>
			<th>身份证号</th>
			<th>性别</th>
			<th>单位</th>
			<th>乘客类型</th>
			<th>代理人姓名</th>
			<th>代理人单位</th>
			<th>流程状态</th>
			<th>预约状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($data as $key => $v)
			<tr>
				<td>{{$v->sid}}</td>
				<td>{{$v->bus_trains}}</td>
				<td>{{$v->s_name}}</td>
				<td>{{$v->id_number}}</td>
				<td>{{$v->sex}}</td>
				<td>{{$v->unit}}</td>
				<td>{{$v->type}}</td>
				<td>{{$v->agent_name}}</td>
				<td>{{$v->agent_unit}}</td>
				<td>
					@if ($v->state == 1)
						已确认
					@elseif ($v->state == 0)
						已获取
					@endif
				</td>
				<td>{{$v->make_name}}</td>
				<td sid="{{$v->sid}}">
					<a href="javascript:void(0)" class="del">删除</a>
					<a href="details?sid={{$v->sid}}">查看</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<center>
	<div class="btn-group">
		<button type="button" class="btn btn-default" onclick="page(1)">首页</button>
		<button type="button" class="btn btn-default" onclick="page(<?php echo $prev; ?>)">上一页</button>
		<button type="button" class="btn btn-default" onclick="page(<?php echo $next; ?>)">下一页</button>
		<button type="button" class="btn btn-default" onclick="page(<?php echo $last; ?>)">尾页</button>
	</div>
</center>
</div>
</body>
</html>


<script type="text/javascript">


	$('#search').click(function () {
		var s_name = $('.s_name').val();
		var bus_trains = $('.bus_trains').val();
		var id_number = $('.id_number').val();
		var m_id = $('.m_id').val();
		// alert(m_id)
		$.ajax({
			url: "show",
			method: "get",
			dataType: "html",
			data: {
				s_name : s_name,
				bus_trains : bus_trains,
				id_number : id_number,
				m_id : m_id
			},success:function (mag) {
				$('#box').html(mag)
			}
		});
	})


	$('.del').click(function () {
		var sid = $(this).parents('td').attr('sid');
		$.ajax({
			url: "del",
			method: "get",
			dataType: "html",
			data: {
				sid : sid
			},success:function (mag) {
				if (mag == 1) {
					alert('删除成功');
					location.reload();
				}else{
					alert('删除失败')
				}
			}
		});
	})



	function page(page) {
		var s_name = $('.s_name').val();
		var bus_trains = $('.bus_trains').val();
		var id_number = $('.id_number').val();
		var m_id = $('.mid').val();
		$.ajax({
			url: "show",
			method: "get",
			dataType: "html",
			data: {
				page : page,
				s_name : s_name,
				bus_trains : bus_trains,
				id_number : id_number,
				m_id : m_id
			},success:function (mag) {
				$('#box').html(mag)
			}
		});

	}
</script>