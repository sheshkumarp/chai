@extends('web.layout.master')

@section('title')
{{ $moduleAction ?? 'Dashboard' }}
@endsection

@section('styles')
    <link href="{{ asset('/') }}assets/plugins/dropzone/dist/dropzonenew.css" rel="stylesheet">
    <style>
        .dropzoneDragArea { background-color: #fbfdff; border: 1px dashed #c0ccda; border-radius: 6px; padding: 60px; text-align: center; margin-bottom: 15px; cursor: pointer; }
        .dropzone{ box-shadow: 0px 2px 20px 0px #f2f2f2; border-radius: 10px; }
    </style>
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-xs-12">
        <form action="{{ route($modulePath.'store') }}" id="formdata" method="post" data-toggle="validator"
        autocomplete="off" enctype='multipart/form-data' >
        <div class="card border-0 shadow">
            <h1 class="title blue-border-bottom">
                {{ strtoupper($moduleTitle) ?? 'ADD ASSET DETAILS' }}
            </h1>
            <div class="card-footer d-flex theme-bg-blue-light blue-border-bottom">
                <a class="btn-normal ml-auto blue-btn-inverse" href="{{ route('web.asset.index') }}" >Back</a>
            </div>
            <h1 class="card-subtitle blue-border-bottom text-capitalize">
                Asset Information
                {{ csrf_field() }}
            </h1>
            <div class="card-body">
                <div class="f-col-8 p-10">

                    <input type="hidden" class="asset_id" name="asset_id" id="asset_id" value="">

                    <div class="f-row mb-25">
                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Teams <span class="red"> *</span></label>
                            <select class="form-control my-select" name="fk_team_id" id="fk_team_id" required data-error="Please select team" >
                                <option value="">Select Team</option>
                                @if(!empty($teams) && count($teams)> 0)
                                @foreach($teams as $t)
                                <option value="{{ $t->id }}">{{ ucfirst($t->title) }}</option>
                                @endforeach
                                @endif
                            </select>
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_fk_team_id"></li>
                                </ul>
                            </span>
                        </div>
                    </div>

                    <div class="f-row mb-25">
                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Assets Type <span class="red"> *</span></label>
                            <select class="form-control my-select" name="fk_category_id" id="fk_category_id" required data-error="Please select asset type" >
                                <option value="">Select Assets Type</option>
                                @if(!empty($assetTypes) && count($assetTypes)> 0)
                                @foreach($assetTypes as $at)
                                <option value="{{ $at->id }}">{{ ucfirst($at->name) }}</option>
                                @endforeach
                                @endif
                            </select>
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_fk_category_id"></li>
                                </ul>
                            </span>
                        </div>
                        <!-- <div class="f-col-6 form-group">
                            <label class="theme-blue">Code Bar ID</label>
                            <input class="form-control" type="text" name="code_bar_id">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_code_bar_id"></li>
                                </ul>
                            </span>
                        </div> -->
                    </div>

                    <div class="d-flex flex-column mb-25 form-group">
                        <label class="theme-blue">Equipment Description <span class="red">*</span></label>
                        <textarea class="form-control" type="text" name="equipment_description" required
                        data-error="Equipment description field is required"></textarea>
                        <span class="help-block with-errors">
                            <ul class="list-unstyled">
                                <li class="err_equipment_description"></li>
                            </ul>
                        </span>
                    </div>
                </div>              
            </div>

            <h1 class="card-subtitle blue-border-bottom text-capitalize blue-border-top">
                Acquisition Information
            </h1>

            <div class="card-body">

                <div class="f-col-8 p-10">
                                        
                    <div class="f-row mb-25">
                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Acquisition Date <span class="red"> *</span></label>
                            <input class="form-control" type="text"  name="acquisition_date" id="acquisition_date" required
                            data-error="Acquisition Date field is required">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_acquisition_date"></li>
                                </ul>
                            </span>
                        </div>
                    </div>

                    <div class="f-row mb-25">

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Acquisition Cost (CDF)</label>
                            <input oninput="getUsd(this)" class="form-control" type="text" id="acquisition_cost_local" name="acquisition_cost_local" >
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_acquisition_cost_local"></li>
                                </ul>
                            </span>
                        </div>

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Acquisition Cost (USD)</label>
                            <input class="form-control" oninput="getCDF(this)" type="text" id="acquisition_cost_usd" name="acquisition_cost_usd">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_acquisition_cost_usd"></li>
                                </ul>
                            </span>
                        </div>
                    </div>

                </div>
            </div>


            <h1 class="card-subtitle blue-border-bottom text-capitalize blue-border-top">
                Purchase Information
            </h1>

            <div class="card-body">

                <div class="f-col-8 p-10">

                    <div class="f-row mb-25">

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Purchased With Donor Funds</label>
                            <select class="form-control my-select" name="purchased_with_donor_funds">
                                <option value="">Please Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_purchased_with_donor_funds"></li>
                                </ul>
                            </span>
                        </div>

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Project ID</label>
                            <input class="form-control" type="text" name="project_id">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_project_id"></li>
                                </ul>
                            </span>
                        </div>
                    </div>
                                        
                    <div class="f-row mb-25">

                        

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">In Country Location</label>
                            <input class="form-control" type="text" name="in_country_location">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_in_country_location"></li>
                                </ul>
                            </span>
                        </div>


                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Asset Location <span class="red"> *</span></label>
                            <input class="form-control" type="text" name="asset_location" >
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_asset_location"></li>
                                </ul>
                            </span>
                        </div>

                    </div>

                    <div class="f-row mb-25">

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Invoice Number <span class="red"> *</span></label>
                            <input class="form-control" type="text" name="invoice" required
                            data-error="Invoice Number field is required">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_invoice"></li>
                                </ul>
                            </span>
                        </div>

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Invoice Document </label>
                            <input class="form-control" type="file" name="invoice_document" >
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_invoice_document"></li>
                                </ul>
                            </span>
                        </div>

                    </div>

                </div>
            </div>

            <h1 class="card-subtitle blue-border-bottom text-capitalize blue-border-top">
                Manufacturer Information
            </h1>

            <div class="card-body">

                <div class="f-col-8 p-10">

                    <div class="f-row mb-25">
                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Manufacturer</label>
                            <input class="form-control" type="text"  name="manufacturer">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_manufacturer"></li>
                                </ul>
                            </span>
                        </div>
                    </div>
                                        
                    <div class="f-row mb-25">
                        

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Inventory Confirmation Date </label>
                            <input class="form-control" type="text"  name="inventory_confirmation_date" id="inventory_confirmation_date" >
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_inventory_confirmation_date"></li>
                                </ul>
                            </span>
                        </div>

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Confirmed By</label>
                            <input class="form-control" type="text"  name="confirmed_by">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_confirmed_by"></li>
                                </ul>
                            </span>
                        </div>
                    </div>

                    <div class="f-row mb-25">

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Model</label>
                            <input class="form-control" type="text" name="model">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_model"></li>
                                </ul>
                            </span>
                        </div>

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Serial/Vehicle/Identification/Logbook</label>
                            <input class="form-control" type="text" name="serial_vehicle_identification_logbook">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_serial_vehicle_identification_logbook"></li>
                                </ul>
                            </span>
                        </div>
                    </div>

                    <div class="f-row mb-25">

                        <div class="f-col-12 form-group">
                            <label class="theme-blue">Comments</label>
                            <textarea class="form-control" type="text" name="comments" ></textarea>
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_comments"></li>
                                </ul>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <h1 class="card-subtitle blue-border-bottom text-capitalize blue-border-top">
                With Chai
            </h1>

            <div class="card-body">
                <div class="f-col-8 p-10">                                      
                    <div class="f-row mb-25">

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Still With Chai</label>
                            <select class="form-control my-select" name="still_with_chai">
                                <option value="">Please Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_still_with_chai"></li>
                                </ul>
                            </span>
                        </div>

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Disposal Date (If NO longer with CHAI)</label>
                            <input class="form-control" type="text"  name="disposal_date" id="disposal_date">
                            <span class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li class="err_disposal_date"></li>
                                </ul>
                            </span>
                        </div>

                    </div>
                </div>
            </div>

            <h1 class="card-subtitle blue-border-bottom text-capitalize blue-border-top">
                Asset Images
            </h1>

            <div class="card-body">
                <div class="f-col-8 p-10">   

                    <div class="f-row mb-25">

                        <div class="f-col-12 form-group">
                            <div class="dz-default dz-message dropzoneDragArea" 
                            id="dropzoneDragArea" required data-error='Asset images field is required'>
                                <span>Drop files here or click to upload</span>
                            </div>
                            <div class="dropzone-previews" style="background-color: whitesmoke;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="f-col-12 p-10">
                    <center><button class="btn-normal ml-auto blue-btn-inverse" type="submit" id="submitbtn" >Save Changes</button></center>
                </div>
            </div>



        </div>
    </form>
</div>
</div>


@endsection

@section('scripts')
    <script>
        const UPLOADFILE = "{{ route($moduleUploadFiles) }}";
        const REMOVEFILE = "{{ route($moduleRemoveFiles) }}";
        const MEDIAFILE  = "{{ route($moduleMediaFiles) }}";
    </script>
    <script type="text/javascript" src="{{ url('assets/plugins/dropzone/dist/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/web/js/asset/create-edit.js') }}"></script>

    <script type="text/javascript" src="{{ url('assets/plugins/gallary/dist/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dropzone-previews').magnificPopup({ delegate: 'a', type: 'image' });
        });
    </script>
@endsection