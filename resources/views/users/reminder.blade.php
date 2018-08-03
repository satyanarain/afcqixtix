<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>
<body>
<h2>Welcome to the site {{$username}}</h2>
<br/>
Your registered email-id is {{$email}} , Please click on the below link to create password
<br/>
<a href="{{url('create_passwords', $set_password_token)}}">Click Here</a>
</body>
</html>