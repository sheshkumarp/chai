

<div class="panel-group" id="accordion">


      <div class="panel panel-default">
            <img style="width: 250px;padding-top: 20px;margin-left: 37px;height: 156px;" src="{{ asset('assets/admin/images/CHAI-Logo.png') }}" >                 
      </div>
      <hr>

      <div class="panel panel-default">
            <div class="panel-heading {{ active(['admin/dashboard']) }}">
                  <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center hover-img">
                        <h4 class="panel-title w-100">
                              <span class="sidebar-icon">
                                    <img
                                          src="{{ asset('assets/admin/images/icons/sidebar/svg/Dashboard-Active.svg') }}">
                              </span>Dashboard
                        </h4>
                  </a>
            </div>
      </div>

      @can('users')
      <div class="panel panel-default">
            <div
                  class="panel-heading {{ active(['admin/users', 'admin/users/*']) }}">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse12"
                        class="d-flex align-items-center hover-img">
                        <h4 class="panel-title w-100">
                              <span class="sidebar-icon">
                                    <img src="{{ asset('assets/admin/images/icons/sidebar/svg/Users.svg') }}">
                              </span>Users</h4>
                  </a>
            </div>
            <div id="collapse12"
                  class="panel-collapse collapse
                @if( active(['admin/users', 'admin/users/*']) == 'active') in @endif">
                  <div class="panel-body border-0 p-0">
                        <ul class="sub-menu clear">
                              @can('manage-users-access')
                              <li>
                                    <a href="{{ route('admin.users.index') }}">Manage Users</a>
                              </li>
                              @can('manage-users')
                              <li>
                                    <a href="#" data-toggle="modal" data-target="#addUser"
                                          onclick="document.getElementById('userForm').reset()">Add New User</a>
                              </li>
                              @endcan
                              @endcan
                        </ul>
                  </div>
            </div>
      </div>
      @endcan

      @can('teams')
      <div class="panel panel-default">
            <div
                  class="panel-heading {{ active(['admin/teams', 'admin/teams/*']) }}">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse112"
                        class="d-flex align-items-center hover-img">
                        <h4 class="panel-title w-100">
                              <span class="sidebar-icon">
                                    <img src="{{ asset('assets/admin/images/icons/sidebar/svg/Users.svg') }}">
                              </span>Zone Or Region</h4>
                  </a>
            </div>
            <div id="collapse112"
                  class="panel-collapse collapse
                @if( active(['admin/teams', 'admin/teams/*']) == 'active') in @endif">
                  <div class="panel-body border-0 p-0">
                        <ul class="sub-menu clear">
                              @can('manage-teams-access')
                                    <li>
                                          <a href="{{ route('admin.teams.index') }}">Manage Zone</a>
                                    </li>
                                    @can('manage-teams')
                                    <li>
                                          <a href="#" data-toggle="modal" data-target="#addTeam"
                                                onclick="document.getElementById('teamForm').reset()">Add New Zone</a>
                                    </li>
                                    @endcan
                              @endcan

                        </ul>
                  </div>
            </div>
      </div>
      @endcan


      <!-- @can('categories')
      <div class="panel panel-default">
            <div
                  class="panel-heading {{ active(['admin/categories', 'admin/categories/*']) }}">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse122"
                        class="d-flex align-items-center hover-img">
                        <h4 class="panel-title w-100">
                              <span class="sidebar-icon">
                                    <img src="{{ asset('assets/admin/images/icons/sidebar/svg/Users.svg') }}">
                              </span>Categories</h4>
                  </a>
            </div>
            <div id="collapse122"
                  class="panel-collapse collapse
                @if( active(['admin/categories', 'admin/categories/*']) == 'active') in @endif">
                  <div class="panel-body border-0 p-0">
                        <ul class="sub-menu clear">
                              @can('manage-teams-access')
                                    <li>
                                          <a href="{{ route('admin.categories.index') }}">Manage Categories</a>
                                    </li>
                                    @can('manage-teams')
                                    <li>
                                          <a href="#" data-toggle="modal" data-target="#addCategory"
                                                onclick="document.getElementById('categoriesForm').reset()">Add New Category</a>
                                    </li>
                                    @endcan
                              @endcan

                        </ul>
                  </div>
            </div>
      </div>
      @endcan -->

      @can('admins')
      <div class="panel panel-default">
            <div
                  class="panel-heading {{ active(['admin/records', 'admin/records/*', 'admin/permissions', 'admin/permissions/*','admin/roles', 'admin/roles/*']) }}">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse13"
                        class="d-flex align-items-center hover-img">
                        <h4 class="panel-title w-100">
                              <span class="sidebar-icon">
                                    <img src="{{ asset('assets/admin/images/icons/sidebar/svg/Users.svg') }}">
                              </span>Admins</h4>
                  </a>
            </div>
            <div id="collapse13"
                  class="panel-collapse collapse
                @if( active(['admin/records', 'admin/records/*', 'admin/permissions', 'admin/permissions/*','admin/roles', 'admin/roles/*']) == 'active') in @endif">
                  <div class="panel-body border-0 p-0">
                        <ul class="sub-menu clear">
                              @can('manage-admins-access')
                              <li>
                                    <a href="{{ route('admin.records.index') }}">Manage Admins</a>
                              </li>
                              @can('manage-admins')
                              <li>
                                    <a href="#" data-toggle="modal" data-target="#addAdmin"
                                          onclick="document.getElementById('adminForm').reset()">Add New Admin</a>
                              </li>
                              @endcan
                              @endcan
                              @can('manage-roles-access')
                              <li>
                                    <a href="{{ route('admin.roles.index') }}">Manage Roles</a>
                              </li>
                              @endcan
                              @can('manage-permissions-access')
                              <li>
                                    <a href="{{ route('admin.permissions.index') }}">Manage Permissions</a>
                              </li>
                              @endcan
                        </ul>
                  </div>
            </div>
      </div>
      @endcan
    
</div>