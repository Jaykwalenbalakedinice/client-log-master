<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application Form</title>
    <link rel="stylesheet" href="{{asset ('css/ajax-4.0.6.css')}}">
    <link href="{{asset('css/bootstrap-5.0.2.css')}}" rel="stylesheet">
    <script src="{{asset('script/bootstrap-5.0.2.js')}}"></script>

    <title>Document</title>
    @yield('additionalStyle')
    @include('css.applicationForm')
</head>
<body>
    @yield('content')
    @include('layout.AppFormScript')
</body>
</html>