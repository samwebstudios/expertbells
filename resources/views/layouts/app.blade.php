<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1">
<link rel="icon" href="{{asset('frontend/img/favicon.ico')}}" type="image/x-icon">
<link rel="apple-touch-icon" href="{{asset('frontend/img/favicon.ico')}}">
<!-- <link rel="manifest" href="manifest.json"> -->
<meta name="theme-color" content="#d9ae00">
<!-- Bootstrap CSS -->
<!-- <link rel="preload" as="style" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" onload="this.rel='stylesheet'" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
<link rel="preload" as="style" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" onload="this.rel='stylesheet'" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- Main CSS -->
@stack('css')
<link rel="stylesheet" href="{{asset('frontend/css/main-style.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="//www.samwebstudio.co">
<link rel="dns-prefetch" href="//cdn.jsdelivr.net">
<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="//pro.fontawesome.com">
<link rel="dns-prefetch" href="//code.jquery.com">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .error{font-size: 13px;color: #ea6b6b;}
</style>
@vite([])
</head>
<body id="app">
    <x-nav/> 
    @yield('content')    
    <x-footer/>
</body>
</html>