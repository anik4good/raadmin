<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('all.js') }}"></script>
<x:notify-messages />
@notifyJs


{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>--}}
<!-- Stack array for including inline js or scripts -->
@stack('script')

<script src="{{ asset('dist/js/theme.js') }}"></script>
<script src="{{ asset('js/chat.js') }}"></script>
