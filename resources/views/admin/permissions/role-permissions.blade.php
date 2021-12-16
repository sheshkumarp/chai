<div id="roleWisePermissions">
    
    {{-- Users --}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="list-group-item d-flex">
                <a href="#">Users</a>
                <label class="switch ml-auto">
                    <input type="checkbox" class="checkbox-permissions" id="permission-users"
                        name="users" value="users">
                    <span class="knob"></span>
                </label>
                <a data-toggle="collapse" href="#permission11"
                    class="theme-green ml-3 text-underline">details</a>
            </div>
        </div>
        <div id="permission11" class="panel-collapse collapse">
            <div class="panel-body border-0 py-0">
                <ul class="list-group toggle-wrapper">
                    <li class="list-group-item d-flex">
                        <a href="#">Manage Users </a>
                        <label class="switch ml-auto">
                            <input type="checkbox" class="checkbox-permissions" id="permission-manage-users-access" name="manage-users-access" value="manage-users-access" >
                            <span class="knob"></span>
                        </label>
                        <label class="sub-menu switch ml-1">
                            <input type="checkbox" class="checkbox-permissions"
                                id="permission-manage-users" name="manage-users"
                                value="manage-users">
                            <span class="knob text-white"><em>view</em></span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Categories --}}
   <!--  <div class="panel panel-default">
        <div class="panel-heading">
            <div class="list-group-item d-flex">
                <a href="#">Categories </a>
                <label class="switch ml-auto">
                    <input type="checkbox" class="checkbox-permissions"
                        id="permission-categories" name="categories"
                        value="categories">
                    <span class="knob"></span>
                </label>
                <a data-toggle="collapse" href="#permission5"
                    class="theme-green ml-3 text-underline">details</a>
            </div>
        </div>
        <div id="permission5" class="panel-collapse collapse">
            <div class="panel-body border-0 py-0">
                <ul class="list-group toggle-wrapper">
                    <li class="list-group-item d-flex">
                        <a href="#">Manage Categories </a>
                        <label class="switch ml-auto">
                            <input type="checkbox" class="checkbox-permissions" id="permission-manage-categories-access" name="manage-categories-access" value="manage-categories-access" >
                            <span class="knob"></span>
                        </label>
                        <label class="sub-menu switch ml-1">
                            <input type="checkbox" class="checkbox-permissions"
                                id="permission-manage-categories" name="manage-categories"
                                value="manage-categories">
                            <span class="knob text-white"><em>view</em></span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    </div> -->


    {{-- Teams --}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="list-group-item d-flex">
                <a href="#">Teams </a>
                <label class="switch ml-auto">
                    <input type="checkbox" class="checkbox-permissions"
                        id="permission-teams" name="teams"
                        value="teams">
                    <span class="knob"></span>
                </label>
                <a data-toggle="collapse" href="#permission4"
                    class="theme-green ml-3 text-underline">details</a>
            </div>
        </div>
        <div id="permission4" class="panel-collapse collapse">
            <div class="panel-body border-0 py-0">
                <ul class="list-group toggle-wrapper">
                    <li class="list-group-item d-flex">
                        <a href="#">Manage Teams </a>
                        <label class="switch ml-auto">
                            <input type="checkbox" class="checkbox-permissions" id="permission-manage-teams-access" name="manage-teams-access" value="manage-teams-access" >
                            <span class="knob"></span>
                        </label>
                        <label class="sub-menu switch ml-1">
                            <input type="checkbox" class="checkbox-permissions"
                                id="permission-manage-teams" name="manage-teams"
                                value="manage-teams">
                            <span class="knob text-white"><em>view</em></span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    </div>

     {{-- Admins --}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="list-group-item d-flex">
                <a href="#">Admins</a>
                <label class="switch ml-auto">
                    <input type="checkbox" class="checkbox-permissions" id="permission-admins"
                        name="admins" value="admins">
                    <span class="knob"></span>
                </label>
                <a data-toggle="collapse" href="#permission15"
                    class="theme-green ml-3 text-underline">details</a>
            </div>
        </div>
        <div id="permission15" class="panel-collapse collapse">
            <div class="panel-body border-0 py-0">
                <ul class="list-group toggle-wrapper">
                    <li class="list-group-item d-flex">
                        <a href="#">Manage Admins </a>
                        <label class="switch ml-auto">
                            <input type="checkbox" class="checkbox-permissions" id="permission-manage-admins-access" name="manage-admins-access" value="manage-admins-access" >
                            <span class="knob"></span>
                        </label>
                        <label class="sub-menu switch ml-1">
                            <input type="checkbox" class="checkbox-permissions"
                                id="permission-manage-admins" name="manage-admins"
                                value="manage-admins">
                            <span class="knob text-white"><em>view</em></span>
                        </label>
                    </li>
                    <li class="list-group-item d-flex">
                        <a href="#">Manage Roles </a>
                        <label class="switch ml-auto">
                            <input type="checkbox" class="checkbox-permissions" id="permission-manage-roles-access" name="manage-roles-access" value="manage-roles-access" >
                            <span class="knob"></span>
                        </label>
                        <label class="sub-menu switch ml-1">
                            <input type="checkbox" class="checkbox-permissions"
                                id="permission-manage-roles" name="manage-roles"
                                value="manage-roles">
                            <span class="knob text-white"><em>view</em></span>
                        </label>
                    </li>
                    <li class="list-group-item d-flex">
                        <a href="#">Manage Permissions </a>
                        <label class="switch ml-auto">
                            <input type="checkbox" class="checkbox-permissions" id="permission-manage-permissions-access" name="manage-permissions-access" value="manage-permissions-access" >
                            <span class="knob"></span>
                        </label>
                        <label class="sub-menu switch ml-1">
                            <input type="checkbox" class="checkbox-permissions"
                                id="permission-manage-permissions" name="manage-permissions"
                                value="manage-permissions">
                            <span class="knob text-white"><em>view</em></span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
</div>