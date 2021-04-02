<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="assets/images/admin/favicon.ico" type="image/x-icon" rel="icon" />
<link href="assets/images/admin/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="assets/css/admin/login.css" type="text/css">
<script type="text/javascript">
</script>
<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="assets/js/admin/login.min.js"></script>
<title> CMS | Admin Control Panel</title>
</head>
<body>
<div id="main">
<form action="{{ route('login_admin') }}" method="POST" role="form" class="login-form">
    {{ csrf_field() }}
    <div class="logo"></div>
	<div class="bg_login">
		<div class="divInpUsername">
            <input class="inpLogin" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Username" autofocus/>
           
        </div>
		<div class="divInpPass">
            <input  class="inpLogin" id="password" type="password" name="password" placeholder="Password" />
           
        </div>
        <div class="row">
            <button type="submit" class="btLogin"></button>
        </div>
	</div>
</form>
</div>
</body>
</html>
