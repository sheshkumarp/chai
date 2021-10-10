<div id="addCategory" class="modal fade note-model" role="dialog">
   <div class="modal-dialog w-100">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close opacity-1" data-dismiss="modal">
            <img src="{{ url('/assets/admin/images') }}/icons/model_close.svg" alt="close">
            </button>
            <h4 class="modal-title">Add Cateegory</h4>
         </div>
         <form id="categoriesForm" action="{{ route('admin.categories.store') }}" data-toggle="validator" role="form">
            <div class="modal-body border-0">
               <div class="row d-flex mb-3">
                  <div class="f-col-12 form-group">
                     <label class="theme-blue">TItle<span
                        class="required">*</span></label>
                     <input class="form-control" type="text" name="title" required
                        data-error="Category title field is required">
                     <span class="help-block with-errors">
                        <ul class="list-unstyled">
                           <li class="err_first_name"></li>
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