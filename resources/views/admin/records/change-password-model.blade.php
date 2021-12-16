@if(auth()->check())
<div id="updateAdminPassword" class="modal fade note-model" role="dialog">
   <div class="modal-dialog w-100">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close opacity-1" data-dismiss="modal">
            <img src="{{ url('/assets/admin/images') }}/icons/model_close.svg" alt="close">
            </button>
            <h4 class="modal-title">Update Admin Password</h4>
         </div>
         <form id="updateUserPasswordForm" action="{{ url('/admin/records/updatePassword') }}" data-toggle="validator" role="form">
            <div class="modal-body border-0">

                  <div class="f-col-12 form-group">
                     <label class="theme-blue">Old Password <span class="required">*</span></label>
                     <input 
                        class="form-control" 
                        type="password" 
                        name="old_password"
                        required 
                        data-error="Old password field is required."
                     >
                     <span class="help-block with-errors">
                        <ul class="list-unstyled">
                           <li class="err_old_password"></li>
                        </ul>
                     </span>
                  </div>

                  <div class="f-col-12 form-group">
                     <label class="theme-blue">@lang('admin.TITLE_PASS') <span class="required">*</span></label>
                     <input 
                        class="form-control" 
                        type="password" 
                        name="password" 
                        required
                        data-error="New password field is required."
                     >
                     <span class="help-block with-errors">
                        <ul class="list-unstyled">
                           <li class="err_password"></li>
                        </ul>
                     </span>
                  </div>
               
                  <div class="f-col-12 form-group">
                     <label class="theme-blue">@lang('admin.TITLE_CONFIRM_PASS') <span
                        class="required">*</span></label>

                     <input 
                        class="form-control" 
                        type="password" 
                        name="confirm_password" 
                        required
                        data-error="@lang('admin.ERR_CONFIRM_PASS')"
                     >
                     <span class="help-block with-errors">
                        <ul class="list-unstyled">
                           <li class="err_confirm_password"></li>
                        </ul>
                     </span>
               
               </div>
               <div class="d-flex pt-4">
                  <button type="submit" class="blue-btn ml-auto">Update</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endif