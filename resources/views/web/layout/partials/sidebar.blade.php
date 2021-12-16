<div class="panel-group" id="accordion">

      <div class="panel panel-default">
            <img style="width: 250px;padding-top: 20px;margin-left: 37px;height: 156px;" src="{{ asset('assets/admin/images/CHAI-Logo.png') }}" >                 
      </div>
      <hr>

      <div class="panel panel-default">
            <div class="panel-heading {{ active(['/']) }}">
                  <a href="{{ route('web.dashboard') }}" class="d-flex align-items-center hover-img">
                        <h4 class="panel-title w-100">
                              <span class="sidebar-icon">
                                    <img
                                          src="{{ asset('assets/admin/images/icons/sidebar/svg/Dashboard-Active.svg') }}">
                              </span>Dashboard
                        </h4>
                  </a>
            </div>
      </div>

      <div class="panel panel-default">
            <div
                  class="panel-heading {{ active(['asset', 'asset/*']) }}">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse122"
                        class="d-flex align-items-center hover-img">
                        <h4 class="panel-title w-100">
                              <span class="sidebar-icon">
                                    <img src="{{ asset('assets/admin/images/icons/sidebar/svg/Users.svg') }}">
                              </span>Assets</h4>
                  </a>
            </div>
            <div id="collapse122"
                  class="panel-collapse collapse
                @if( active(['asset', 'asset/*']) == 'active') in @endif">
                  <div class="panel-body border-0 p-0">
                        <ul class="sub-menu clear">
                              <li>
                                    <a href="{{ route('web.asset.index') }}">Manage Assets</a>
                              </li>
                              <li>
                                    <a href="{{ route('web.asset.create') }}" >Add New Asset</a>
                              </li>
                        </ul>
                  </div>
            </div>
      </div>
    
</div>