<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.meta')
    
    @stack('before-style')
    @include('includes.styles')
    @stack('after-style')

    <title>PMB | Politeknik Hasnur</title> 
</head>
<body>

    @include('includes.header')
    
    @yield('hero')

    <main id="main">
        @yield('main')
    </main>

    @include('includes.footer')

    <div id="preloader"></div>
    {{-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> --}}
    
    @include('partials.chat')

    @stack('before-script')
    @include('includes.scripts')
    @stack('after-script')
</body>
</html>