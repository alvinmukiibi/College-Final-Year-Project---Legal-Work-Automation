{{-- 
What    :   The Main Layout file that will be extended by all pages
Author  :   Alvin Mukiibi
Date    :   6th-February-2019
 --}}

 <!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     @include('layouts.partials.headin')
     @yield('body_tag')
     <div class="wrapper">

            @include('layouts.compartments.topnavin')
            @include('layouts.compartments.sidebar')
            <div class="content-wrapper">
                @yield('content')  
            </div>
            
            @include('layouts.partials.footin')

    
        </div>
         
         {{-- @include('layouts.compartments.footer') --}}
     </body>
 </html>
 