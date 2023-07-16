<!doctype html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
            crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard</title>
</head>
<body>
<a href="{{route('logout')}}" style="color: red;font-size: 30px;position: relative;float: right;right: 50px;">exit
    account</a>
<br><br><br><br>
@if(App\Enums\userlevel::admin == $user->level)
    admin
    <div style="color: red;font-size: 30px;position: fixed;float: left;left: 50px;top: 0">your grade is
        :
@if($user->grade !== "")
    {{$user->grade}}
        @else()
    no grade
        @endif
    </div>
    <form action="{{route('image_upload')}}" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="click me">
        @csrf
    </form>
    @if($user->image_access !== "")
        <img src='{{url('/images/'.$user->image_access)}}' alt="" width="250" height="250">
    @endif
@elseif(App\Enums\userlevel::client == $user->level)
    client


@endif
</body>
</html>
