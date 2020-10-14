<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{url('/')}}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>

<!------ Include the above in your HEAD tag ---------->

<body>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    {!! Form::open(['route' => 'admin.login.post', 'class' => 'login-form']) !!}
                    <h3 class="text-center text-info">Admin Login</h3>
                    <div class="form-group">
                        <label for="email" class="text-info">Email:</label><br>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-info">Password:</label><br>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" id="btn_login" class="btn btn-info btn-md" value="submit">
                    </div>
                    {!!   Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
