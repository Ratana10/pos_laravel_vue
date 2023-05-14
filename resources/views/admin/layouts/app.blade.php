<!DOCTYPE html>

<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>AdminLTE 3 | Starter</title>

   @vite(['resources/css/app.css', 'resources/js/app.js'])

<body class="hold-transition sidebar-mini">
   <div class="wrapper" id="app">

      @include('admin.layouts.navbar')

      @include('admin.layouts.sidebar')

      <div class="content-wrapper">

         <router-view></router-view>

      </div>

      @include('admin.layouts.footer')
   </div>

</body>

</html>