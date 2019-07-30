<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<form class="form-horizontal" role="form" action="adds" method="post">

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">班车车次</label>
		<div class="col-sm-8">
			<select name="bid">
				@foreach ($data as $key => $val)
					<option value="{{$val->b_id}}">{{$val->bus_trains}}</option>
				@endforeach
			  </select>
		</div>
	</div>


	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生姓名</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="s_name" 
				   placeholder="请输入学生姓名">
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">身份证号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="id_number" name="id_number" 
				   placeholder="请输入学生身份证号">
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生性别</label>
		<input type="radio" name="sex" value="男">男
		<input type="radio" name="sex" value="女">女
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生单位</label>
		<div class="col-sm-8">
			<input type="text" class="form-control"  name="unit" 
				   placeholder="请输入学生单位">
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生类型</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="type" 
				   placeholder="请输入学生类型">
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">代理人姓名</label>
		<div class="col-sm-8">
			<input type="text" class="form-control"  name="agent_name" 
				   placeholder="请输入代理人姓名">
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">代理人单位</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="agent_unit" 
				   placeholder="请输入代理人单位">
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">流程状态</label>
		<div class="col-sm-8">
			<select name="state">
					<option value="1">已确认</option>
					<option value="0">已获取</option>
			  </select>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">预约状态</label>
		<div class="col-sm-8">
			<select name="mid">
					<option value="1">预约成功</option>
					<option value="2">预约失败</option>
			  </select>
		</div>
	</div>


	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

</body>
</html>

<script type="text/javascript">
	$('#id_number').blur(function () {
		var id_number = $('#id_number').val();
		$.ajax({
			url: "id_Number",
			method: "get",
			dataType: "html",
			data: {
				id_number : id_number
			},success:function (mag) {
				if (mag == 1) {
					alert('此人已预约');
				}else{
				}
			}
		});
	})
</script>