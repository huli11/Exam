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
<center>
	<h2>详情页面</h2>
</center>
	@foreach ($data as $key => $v)
		<center>
			学员名称：{{$v->s_name}}<br>
			学员身份证号：{{$v->id_number}}<br>
			学员性别：{{$v->sex}}<br>
			学员单位：{{$v->unit}}<br>
			是否预约：@if ($v->mid == 1)
						是
					 @else
					 	否
					 @endif
		</center>
	@endforeach
</body>
</html>