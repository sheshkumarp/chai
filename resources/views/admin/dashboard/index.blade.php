@extends('admin.layout.master')
@section('title')
{{ $moduleAction ?? 'Manage Users' }}
@endsection

@section('content')

<style type="text/css">
    
    .box{
        padding:60px 0px;
    }

    .box-part{
        background:#FFF;
        border-radius:0;
        padding:60px 10px;
        margin:30px 0px;
    }
    .text{
        margin:20px 0px;
    }

    .fa{
         color:#4183D7;
    }
</style>

<div class="row mb-5">
    <div class="col-xs-12">
        <div class="card border-0 shadow">
            <h1 class="title blue-border-bottom">
            Welcome Dashboard
            </h1>
        </div>
        <div class="box">
            <div class="container">
                <div class="row">  

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   
                        <div class="box-part text-center">
                            
                            <i class="fa fa-instagram fa-3x" aria-hidden="true"></i>
                            
                            <div class="title">
                                <h3>Total Number of Asset</h3>
                            </div>
                            
                            <div class="text">
                                <h1 style="color:#1fab5b !important">{{ $totalAsset  }}</h1>
                            </div>

                            <!-- <a href="#">Go to Assets</a> -->
                                                        
                         </div>
                    </div>   

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   
                        <div class="box-part text-center">
                            
                            <i class="fa fa-instagram fa-3x" aria-hidden="true"></i>
                            
                            <div class="title">
                                <h3>Total Asset Cost (CDR)</h3>
                            </div>
                            
                            <div class="text">
                                <h1 style="color:#1fab5b !important">{{ number_format($totalCostLocal,2) }}</h1>
                            </div>
                                                        
                         </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                   
                        <div class="box-part text-center">
                            
                            <i class="fa fa-instagram fa-3x" aria-hidden="true"></i>
                            
                            <div class="title">
                                <h3>Total Asset Cost (USD)</h3>
                            </div>
                            
                            <div class="text">
                                <h1 style="color:#1fab5b !important">{{ number_format($totalCostUSD,2) }}</h1>
                            </div>
                                                        
                         </div>
                    </div>   

                </div>      
            </div>
        </div>
    </div>

    <div class="col-xs-12 bundle width-auto-1-column-140">
        <div class="card border-0 shadow">
            <h1 class="title blue-border-bottom">
                {{ 'Asset Movement History' }}
            </h1>
            <table id="listingTable" class="table mb-0 first-child-border-0 even-odd-row-1 break-word"
                style="width:100%">
                <thead>
                    <tr>
                        <th style="width:45%;text-align:center;">Asset Name</th>
                        <th style="text-align:center;">Moved From</th>
                        <th style="text-align:center;">Moved To</th>
                        <th style="width:15%;text-align:center;">Date</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('scripts')

    <script type="text/javascript" src="{{ url('assets/admin/js/dashboard/index.js') }}"></script>

@endsection
