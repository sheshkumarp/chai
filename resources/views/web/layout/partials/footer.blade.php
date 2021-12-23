
@include('web.layout.partials.modal')

<script src="{{ asset('assets/common/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('assets/common/js/jquery.mCustomScrollbar.min.js') }}"></script>
<script src="{{ asset('assets/common/js/jquery.selectbox-0.2.min.js') }}"></script>
<script src="{{ asset('assets/common/js/validator.min.js') }}"></script>
<script src="{{ asset('assets/common/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/admin/js/script.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.options.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalert.js') }}"></script>
<script src="{{ asset('assets/plugins/lodingoverlay/loadingoverlay.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/users/model.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/input-mask/mask.js') }}"></script>
@yield('scripts')

<script type="text/javascript">
	$('.subscribeModal-lg').modal('show');
</script>
</body>

</html>