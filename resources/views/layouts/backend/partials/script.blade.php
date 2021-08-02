<script src="{{ asset('assets/backend/js/script.js') }}"></script>
<script src="{{ asset('assets/backend/all.js') }}"></script>
<x:notify-messages />
@notifyJs


{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>--}}
<!-- Stack array for including inline js or scripts -->
@stack('script')


<script src="{{ asset('assets/backend/dist/js/theme.js') }}"></script>
{{--<script src="{{ asset('assets/backend/js/chat.js') }}"></script>--}}
