@extends('admin.layout.master')
@section('title')
{{ $moduleAction ?? 'Manage Users' }}
@endsection
@section('styles')

@endsection
@section('content')


<div class="row" id="history-wrapper">
    <div class="col-xs-12">
        <div class="card border-0 shadow">
            <h1 class="title blue-border-bottom">
                Your to do list history
            </h1>
            <div class="card-footer d-flex theme-bg-blue-light blue-border-bottom align-items-center">
                @php
                        $backClass= '';
                     @endphp
                @if($role==1)
                <div class="f-col-6 d-flex flex-column mb-25 w-50 form-group">
                     <label class="theme-blue">Select User <span class="required">*</span></label>
                     <select id="selectUser" class="form-control my-select" name="state_type">
                        <option value="">Please Select</option>
                        @if(count($users)>0)
                            @foreach($users as $user)
                                <option value="{{ $user->basecamp_id }}"> {{ $user->username }}</option>
                            @endforeach
                        @endif
                     </select>
                 </div>
                 
                     @php
                        $backClass= 'pl-5';
                     @endphp
                 @endif
                <div class="{{ $backClass }}">                
                    <a href="{{ route($modulePath) }}" class="blue-btn" id="back-dashboard">Back to Home</a>
                </div>
            </div>
            <div id="historyData">
                <!-- <div class="card-subtitle blue-border-bottom">
                    <h3>November 18</h3>
                    <p>Today</p>
                </div>
                <div class="card-body blue-border-bottom">
                    <ul class="notice-lists list-group list-checkbox clear">
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                            <p> You completed: <b class="theme-black opacity-1"> Responsive mockup for FAQ </b></p>
                        </li>
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                            <p> You completed:<b class="theme-black opacity-1"> Responsive mockup for Contact Us</b></p>
                        </li>
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                            <p> You completed: <b class="theme-black opacity-1"> GA Report </b></p>
                        </li>
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                            <p> You completed: <b class="theme-black opacity-1"> Mockups for Teleconference (Front
                                    end) </b></p>
                        </li>
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <p>You added: <b class="theme-black opacity-1"> Responsive mockup for Contact Us</b></p>
                        </li>
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <p>You added: <b class="theme-black opacity-1">Responsive mockup for FAQ</b></p>
                        </li>
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                            <p>You completed: <b class="theme-black opacity-1"> Mockups for Online Course (Front
                                    end) </b></p>
                        </li>
                    </ul>
                </div>
                <div class="card-subtitle blue-border-bottom">
                    <h3>November 17</h3>
                    <p>Yesterday</p>
                </div>
                <div class="card-body blue-border-bottom">
                    <ul class="notice-lists list-group list-checkbox clear">
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                            <p>You completed: <b class="theme-black opacity-1"> PA - Last Day to Register for 9/20
                                    emails</b></p>
                        </li>
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                            <p>You completed: <b class="theme-black opacity-1"> VA - Countdown email with days
                                    clock, look at emails from 1-2 years ago</b></p>
                        </li>
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <p>You added: <b class="theme-black opacity-1"> PA - Last Day to Register for 9/20
                                    emails</b></p>
                        </li>
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <p>You added: <b class="theme-black opacity-1"> VA - Countdown email with days clock,
                                    look at emails from 1-2 years ago</b></p>
                        </li>
                        <li class="d-flex p-0 lh-30">
                            <label class="checkbox-container">
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                            <p>You completed: <b class="theme-black opacity-1"> Change Adwords/Facebook landing
                                    page prices back to normal</b></p>
                        </li>
                    </ul>
                </div>
                <div class="card-subtitle blue-border-bottom">
                    <h3>November 16</h3>
                    <p>Sunday</p>
                </div>
                <div class="card-subtitle blue-border-bottom">
                    <p class="theme-black medium">No task activity for this date</p>
                </div>
                <div class="card-subtitle blue-border-bottom">
                    <h3>November 15</h3>
                    <p>Saturday</p>
                </div>
                <div class="card-subtitle">
                    <p class="theme-black medium">No task activity for this date</p>
                </div> -->
            </div>
            
            <div class="card-subtitle hide">
                <p class="theme-black">
                    <a href="#" class="text-underline theme-green"><b>View more history</b></a>
                </p>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script type="text/javascript" src="{{ url('assets/admin/js/dashboard/history.js') }}"></script>
@endsection