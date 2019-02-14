{{-- 
What    :   The Main Layout file that will be extended by all pages
Author  :   Alvin Mukiibi
Date    :   6th-February-2019
 --}}

 <!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     @include('layouts.partials.head')
     @yield('body_tag')
         @include('layouts.compartments.topnavin')
         @include('layouts.compartments.sidebar')
         @yield('content')  
         @include('layouts.partials.foot')
         @include('layouts.compartments.footer')
     </body>
 </html>
 