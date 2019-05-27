
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.partials.headout')
    @yield('body_tag')
        @include('layouts.compartments.topnavout')
        @yield('content')  
        @include('layouts.partials.footout')
        {{-- @include('layouts.compartments.footer') --}}
    </body>
</html>
