<!doctype html>
<html lang="en">
    <head>
        @include('includes.meta')

        @stack('before-style')
        @include('admin.includes.styles')
        @stack('after-style')

        <title>Admin PMB Polihasnur</title> 
    </head>
    <body>
        <div id="app">
            @include('admin.template.sidebar')

            <div id="main">
                @include('admin.template.navbar')

                <div class="main-content container-fluid">
                    @yield('header')
                
                    @yield('content')
    
                    @include('admin.template.footer')
                </div>
            </div>
        </div>

        @stack('before-script')
        @include('admin.includes.scripts')
        @include('partials.alert')
        @stack('after-script')

    </body>
</html>