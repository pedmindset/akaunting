@stack('scripts_start')
<!-- Core -->
<script src="{{ asset('public/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('public/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/vendor/js-cookie/js.cookie.js') }}"></script>

<script src="{{ asset('public/js/install.js?v=' . version('short')) }}"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5f0edb5d5b59f94722bac432/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
@stack('body_css')

@stack('body_stylesheet')

@stack('body_js')

@stack('body_scripts')

@stack('scripts_end')
