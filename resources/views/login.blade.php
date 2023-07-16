<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include this in your blade layout -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>
<body>
@include('sweetalert::alert')

<form style="position: relative;margin: 200px" method="post" action="{{route('login_register')}}">
    <div style="font-size: 30px;text-align: center;position:relative;bottom: 20px;">login</div>
    <div class="form-outline mb-4">
        <input type="phone" id="form2Example1" class="form-control" name="phone"/>
        <label class="form-label" for="form2Example1">phone</label>
    </div>
@csrf

    <center>
    <input type="submit" class="btn btn-primary btn-block mb-4" value="click me">
    </center>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif
</form>
</body>
</html>
