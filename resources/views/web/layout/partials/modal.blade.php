
<style type="text/css">

    #subscribeModal .modal-content{
        overflow:hidden;
    }
    a.h2{
        color:#007b5e;
        margin-bottom:0;
        text-decoration:none;
    }
    #subscribeModal .form-control {
        height: 56px;
        border-top-left-radius: 30px;
        border-bottom-left-radius: 30px;
        padding-left:30px;
    }
    #subscribeModal .btn {
        border-top-right-radius: 30px;
        border-bottom-right-radius: 30px;
        padding-right:20px;
        background:#007b5e;
        border-color:#007b5e;
    }
    #subscribeModal .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #007b5e;
        outline: 0;
        box-shadow: none;
    }
    #subscribeModal .top-strip{
        height: 155px;
        background: #007b5e;
        transform: rotate(141deg);
        margin-top: -94px;
        margin-right: 190px;
        margin-left: -130px;
        border-bottom: 65px solid #4CAF50;
        border-top: 10px solid #4caf50;
    }
    #subscribeModal .bottom-strip{
        height: 155px;
        background: #007b5e;
        transform: rotate(112deg);
        margin-top: -110px;
        margin-right: -215px;
        margin-left: 300px;
        border-bottom: 65px solid #4CAF50;
        border-top: 10px solid #4caf50;
    }

    #subscribeModal .modal-lg .top-strip {
        height: 155px;
        background: #007b5e;
        transform: rotate(141deg);
        margin-top: -106px;
        margin-right: 457px;
        margin-left: -130px;
        border-bottom: 65px solid #4CAF50;
        border-top: 10px solid #4caf50;
    }
    #subscribeModal .modal-lg .bottom-strip {
        height: 155px;
        background: #007b5e;
        transform: rotate(135deg);
        margin-top: -115px;
        margin-right: -339px;
        margin-left: 421px;
        border-bottom: 65px solid #4CAF50;
        border-top: 10px solid #4caf50;
    }

    #Reloadpage{
        cursor:pointer;
    }
</style>

@if(auth()->check() && !empty($soonExpire))
<div class="modal fade text-center py-5 subscribeModal-lg"  id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="top-strip"></div>
                <a class="h2" href="#" target="_blank">Dear {{ auth()->user()->first_name.' '.auth()->user()->last_name }},</a>
                <h4 class="pt-5 mb-0 text-secondary" style="color:red" >
                    The {{ ucfirst($soonExpire->category->name) }}, {{ ucfirst($soonExpire->equipment_description) }}
                </h3>
                <p class="pb-5  text-secondary" style="color:red" ><small>Will depricate soon, Please check it actual condition and make report before due date.</small></p>
                <p class="pb-5  text-secondary" style="color:red" ><small></small></p>
                <div class="bottom-strip"></div>
            </div>
        </div>
    </div>

</div>
@endif