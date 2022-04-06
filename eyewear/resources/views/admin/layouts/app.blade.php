<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layouts.head')
</head>

<!-- (animsition) removed this class from body tag to stop loader -->

<body class="">
<div class="page-wrapper">
 @include('admin.layouts.header')

 @include('admin.layouts.sidebar')

 <div class="page-container">
 @include('admin.layouts.header_desktop')


<div class="main-content">
@yield('content')
</div>

 @include('admin.layouts.footer')
</div>
    
</body>
</html>