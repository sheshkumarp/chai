@extends('web.layout.master')

@section('title')
{{ $moduleAction ?? 'Dashboard' }}
@endsection

@section('styles')
    <style type="text/css"> .remove_image: { display: none;  }</style>
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-xs-12">

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

                    <input type="hidden" class="asset_id" name="asset_id" id="asset_id" value="{{ $object->id }}">

                    <div class="f-row mb-25">
                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Teams </label> :
                            <span style="font-weight: bold; font-size: 16px;"> 
                            @if(!empty($teams) && count($teams)> 0)
                                @foreach($teams as $t)
                                    @if(!empty($object->fk_team_id) && $object->fk_team_id == $t->id) {{ ucfirst($t->title) }} @endif
                                @endforeach
                            @endif
                            </span>
                        </div>
                    </div>

                    <div class="f-row mb-25">
                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Assets Type </label> :
                            <span style="font-weight: bold; font-size: 16px;"> 
                                 @if(!empty($assetTypes) && count($assetTypes)> 0)
                                    @foreach($assetTypes as $at)
                                        @if(!empty($object->fk_team_id) && $object->fk_category_id == $at->id) 
                                            {{ ucfirst($at->name) }} 
                                        @endif 
                                    @endforeach
                                @endif
                            </span>
                        </div>
                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Code Bar ID</label> : 
                            <span style="font-weight: bold; font-size: 16px;">  {{ !empty($object->code_bar_id) ? $object->code_bar_id : '---' }} </span>
                        </div>
                    </div>

                    <div class="f-row mb-25">
                        <div class="f-col-12 form-group">
                            <label class="theme-blue">Equipment Description </label> : 
                            <span style="font-weight: bold; font-size: 16px;">  {{ !empty($object->equipment_description) ? $object->equipment_description : '---' }} </span>
                        </div>
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
                            <label class="theme-blue">Acquisition Date </label> :
                            <span style="font-weight: bold; font-size: 16px;"> 
                                @if(!empty($object->acquisition_date))
                                    {{ date('d/m/Y', strtotime($object->acquisition_date)) }}
                                @else
                                    --- 
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="f-row mb-25">

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Acquisition Cost Local</label> : 
                            <span style="font-weight: bold; font-size: 16px;">  {{ !empty($object->acquisition_cost_local) ? $object->acquisition_cost_local : '---' }} </span>
                        </div>

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Acquisition Cost USD</label> : 
                            <span style="font-weight: bold; font-size: 16px;">  {{ !empty($object->acquisition_cost_usd) ? $object->acquisition_cost_usd : '---' }} </span>
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
                            <label class="theme-blue">Purchased With Donor Funds</label> :
                            <span style="font-weight: bold; font-size: 16px;"> 
                                @if(!empty($object->purchased_with_donor_funds) && $object->purchased_with_donor_funds == 'yes') 
                                    Yes 
                                @elseif(!empty($object->purchased_with_donor_funds) && $object->purchased_with_donor_funds == 'no') 
                                    No
                                @else
                                    ---
                                @endif
                            </span>
                        </div>
                    </div>
                                        
                    <div class="f-row mb-25">

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Project ID</label> : 
                            <span style="font-weight: bold; font-size: 16px;">  {{ !empty($object->project_id) ? $object->project_id : '---' }} </span>
                        </div>

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">In Country Location</label>: 
                            <span style="font-weight: bold; font-size: 16px;">  {{ !empty($object->in_country_location) ? $object->in_country_location : '---' }} </span>
                        </div>

                    </div>

                    <div class="f-row mb-25">

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Invoice Number</label>:
                            <span style="font-weight: bold; font-size: 16px;">  {{ !empty($object->invoice) ? $object->invoice : '---' }} </span>
                        </div>

                        <div class="f-col-4 form-group">
                            <label class="theme-blue">Invoice Document </label> : 
                            <span style="font-weight: bold; font-size: 16px;"> 
                                @if(!empty($object->invoice_document))
                                    <a href="{{ \Storage::disk('public')->url($object->invoice_document) }}" target="_blank" class="btn btn-primary" download ><i class="fa fa-download" aria-hidden="true">File</i></a>
                                @else
                                    ---
                                @endif
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
                            <label class="theme-blue">Manufacturer</label>: 
                            <span style="font-weight: bold; font-size: 16px;">  {{ !empty($object->manufacturer) ? $object->manufacturer : '---' }} </span>
                        </div>
                    </div>
                                        
                    <div class="f-row mb-25">
                        
                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Inventory Confirmation Date </label>
                            <span style="font-weight: bold; font-size: 16px;"> 
                                @if(!empty($object->inventory_confirmation_date))
                                    {{ date('d/m/Y', strtotime($object->inventory_confirmation_date)) }}
                                @else
                                    ---
                                @endif
                            </span>
                        </div>

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Confirmed By</label>: 
                            <span style="font-weight: bold; font-size: 16px;">  {{ !empty($object->confirmed_by) ? $object->confirmed_by : '---' }} </span>
                        </div>
                    </div>

                    <div class="f-row mb-25">

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Asset Location</label>: 
                            <span style="font-weight: bold; font-size: 16px;">  {{ !empty($object->model) ?  $object->model : '---' }} </span>
                        </div>

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Shift to </label>:  
                            <span style="font-weight: bold; font-size: 16px;">  {{ !empty($object->serial_vehicle_identification_logbook) ?  $object->serial_vehicle_identification_logbook : '---'  }} </span>
                        </div>
                    </div>

                    <div class="f-row mb-25">

                        <div class="f-col-12 form-group">
                            <label class="theme-blue">Comments</label>: 
                            <span style="font-weight: bold; font-size: 16px;">  {{ $object->comments ?  $object->comments : '---' }} </span>
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
                            <label class="theme-blue">Still With Chai</label>:
                            <span style="font-weight: bold; font-size: 16px;"> 
                                @if(!empty($object->still_with_chai) && $object->still_with_chai == 'yes') 
                                    Yes 
                                @elseif(!empty($object->still_with_chai) && $object->still_with_chai == 'no') 
                                    No
                                @else
                                    ---
                                @endif 
                            </span>
                        </div>

                        <div class="f-col-6 form-group">
                            <label class="theme-blue">Disposal Date (If NO longer with CHAI)</label> : 
                            <span style="font-weight: bold; font-size: 16px;"> 
                                @if(!empty($object->disposal_date))
                                value="{{ date('d/m/Y', strtotime($object->disposal_date)) }}" 
                                @else
                                    ---
                                @endif
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
                          
                            <div class="dropzone-previews" id="dropzone-previews" style="background-color: whitesmoke;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>


@endsection

@section('scripts')
    <script>
        const MEDIAFILE  = "{{ route($moduleMediaFiles) }}";
    </script>
    <script type="text/javascript" src="{{ url('assets/plugins/dropzone/dist/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/web/js/asset/view.js') }}"></script>
@endsection