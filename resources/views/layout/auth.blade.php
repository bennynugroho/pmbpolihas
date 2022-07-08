<!doctype html>
<html lang="en">
    <head>
        @include('includes.meta')

        @stack('before-style')
        @include('includes.styles')
        @stack('after-style')

        <title>Login PMB Polihasnur</title>
    </head>
    <body style="background-image: url('{{ asset('assets/img/picture/kampus.jpg') }}'); background-size: cover;">
        
        <div class="container">
            @yield('content')
        </div>

        @stack('before-script')
        @include('includes.scripts')
        @stack('after-script')

        {{-- @include('includes.footer') --}}
    </body>
</html>