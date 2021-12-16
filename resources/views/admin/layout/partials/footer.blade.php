
@section('models')
	@include('admin.users.create-user-model')
	@include('admin.teams.create-team-model')
	@include('admin.teams.update-team-model')
	@include('admin.categories.create-category-model')
	@include('admin.categories.update-category-model')
	@include('admin.records.create-admin-model')
	@include('admin.records.change-password-model')
@show

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
<script src="{{ asset('assets/admin/js/records/model.js') }}"></script>
<script src="{{ asset('assets/admin/js/teams/model.js') }}"></script>
<script src="{{ asset('assets/admin/js/categories/model.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/input-mask/mask.js') }}"></script>
@yield('scripts')
</body>

</html>