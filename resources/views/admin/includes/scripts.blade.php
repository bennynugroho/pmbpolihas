{{-- template script --}}
<script src="{{ asset('admin/js/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('admin/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('admin/js/app.js') }}"></script>
<script src="{{ asset('admin/js/main.js') }}"></script>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
{{-- <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

{{-- sidebar --}}
{{-- <script type='text/Javascript'>
    document.addEventListener("DOMContentLoaded", function(event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)
    
    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
            // show navbar
            nav.classList.toggle('show')
            // change icon
            toggle.classList.toggle('bx-x')
            // add padding to body
            bodypd.classList.toggle('body-pd')
            // add padding to header
            headerpd.classList.toggle('body-pd')
            })
        }
    }
    
    showNavbar('header-toggle','nav-bar','body-pd','header')
    
    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')
    
    function colorLink(){
    if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'))
            this.classList.add('active')
        }
    }
    linkColor.forEach(l=> l.addEventListener('click', colorLink))
    
    // Your code to run since DOM is loaded and ready
    });
</script> --}}