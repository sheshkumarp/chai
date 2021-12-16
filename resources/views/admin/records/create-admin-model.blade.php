<div id="addAdmin" class="modal fade note-model" role="dialog">
   <div class="modal-dialog w-100">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close opacity-1" data-dismiss="modal">
            <img src="{{ url('/assets/admin/images') }}/icons/model_close.svg" alt="close">
            </button>
            <h4 class="modal-title">@lang('admin.TITLE_ADD_USER_BUTTON')</h4>
         </div>
         <form id="adminForm" action="{{ route('admin.records.store') }}" data-toggle="validator" role="form">
            <div class="modal-body border-0">
               <div class="row d-flex mb-3">
                  <div class="f-col-6 form-group">
                     <label class="theme-blue">@lang('admin.TITLE_FIRST_NAME') <span
                        class="required">*</span></label>
                     <input class="form-control" type="text" name="first_name" required
                        data-error="@lang('admin.ERR_FIRST_NAME')">
                     <span class="help-block with-errors">
                        <ul class="list-unstyled">
                           <li class="err_first_name"></li>
                        </ul>
                     </span>
                  </div>
                  <div class="f-col-6 form-group">
                     <label class="theme-blue">@lang('admin.TITLE_LAST_NAME') <span
                        class="required">*</span></label>
                     <input class="form-control" type="text" name="last_name" required
                        data-error="@lang('admin.ERR_LAST_NAME')">
                     <span class="help-block with-errors">
                        <ul class="list-unstyled">
                           <li class="err_last_name"></li>
                        </ul>
                     </span>
                  </div>
               </div>
               <div class="d-flex flex-column mb-3 form-group">
                  <label class="theme-blue">@lang('admin.TITLE_EMAIL') <span class="required">*</span></label>
                  <input class="form-control" type="text" name="email" required
                     data-error="@lang('admin.ERR_EMAIL_NAME')"
                     pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$'
                     data-pattern-error="@lang('admin.ERR_EMAIL_FORMAT')">
                  <span class="help-block with-errors">
                     <ul class="list-unstyled">
                        <li class="err_email"></li>
                     </ul>
                  </span>
               </div>
               <div class="row d-flex mb-3 ">
                  <div class="f-col-6 form-group">
                     <label class="theme-blue">@lang('admin.TITLE_PASS') <span class="required">*</span></label>
                     <input class="form-control" type="password" name="password" id="password" required
                        data-error="@lang('admin.ERR_PASS')">
                     <span class="help-block with-errors">
                        <ul class="list-unstyled">
                           <li class="err_password"></li>
                        </ul>
                     </span>
                  </div>
                  <div class="f-col-6 form-group">
                     <label class="theme-blue">@lang('admin.TITLE_CONFIRM_PASS') <span
                        class="required">*</span></label>
                     <input class="form-control" type="password" name="confirm_password" required
                        data-error="@lang('admin.ERR_CONFIRM_PASS')">
                     <span class="help-block with-errors">
                        <ul class="list-unstyled">
                           <li class="err_confirm_password"></li>
                        </ul>
                     </span>
                  </div> 
               </div>
               <div class="row d-flex mb-3">
                  <div class="mb-3 f-col-6 form-group">
                     <label class="theme-blue">@lang('admin.TITLE_SELECT_ROLE') <span
                        class="required">*</span></label>
                     <select class="form-control my-select" name="role" required
                        data-error="@lang('admin.ERR_ROLE')">
                        <option value="">@lang('admin.TITLE_SELECT_ROLE')</option>
                        @if(!empty($roles) && sizeof($roles) > 0)
                        @foreach($roles as $key => $role)
                        <option value="{{ base64_encode(base64_encode($role->id)) }}">
                           {{ ucfirst(str_replace('-', ' ',$role->name)) }}
                        </option>
                        @endforeach 
                        @endif
                     </select>
                     <span class="help-block with-errors">
                        <ul class="list-unstyled">
                           <li class="err_role"></li>
                        </ul>
                     </span>
                  </div>
               </div>
               <div class="d-flex pt-4">
                  <button type="submit" class="blue-btn ml-auto">@lang('admin.TITLE_SUBMIT_BUTTON')</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>