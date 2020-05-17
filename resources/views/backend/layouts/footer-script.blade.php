        <!-- JAVASCRIPT -->
        <script src="{{ URL::asset('backend/libs/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript">ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); </script>
        <script src="{{ URL::asset('backend/libs/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{ URL::asset('backend/libs/metismenu/metismenu.min.js')}}"></script>
        <script src="{{ URL::asset('backend/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ URL::asset('backend/libs/node-waves/node-waves.min.js')}}"></script>
        <script type="text/javascript">$(function() { ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); });</script>

        <!-- Plugins DataTables js -->
        <script src="{{ URL::asset('backend/libs/datatables/datatables.min.js')}}"></script>
        <script src="{{ URL::asset('backend/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ URL::asset('backend/libs/pdfmake/pdfmake.min.js')}}"></script>
        @yield('script')

        <script type="text/javascript">$(function() { ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); });</script>
        <!-- App js -->
        <script src="{{ URL::asset('backend/js/app.min.js')}}"></script>

        <script type="text/javascript">$(function() { ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); });</script>
        @yield('script-bottom')
