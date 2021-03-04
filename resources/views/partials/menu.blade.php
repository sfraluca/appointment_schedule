<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        @can('admin_access')
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @endcan
        @can('profil_access')
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.profile") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.profile') }}
            </a>
        </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('client_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.clients.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/clients") || request()->is("admin/clients/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.client.title') }}
                </a>
            </li>
        @endcan
        @can('employee_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.employees.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/employees") || request()->is("admin/employees/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-suitcase c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.employee.title') }}
                </a>
            </li>
        @endcan
        @can('employement_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.employments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/employments") || request()->is("admin/employments/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-suitcase c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.employments.title') }}
                </a>
            </li>
        @endcan
        @can('payment_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.payment") }}" class="c-sidebar-nav-link {{ request()->is("admin/employments") || request()->is("admin/payment/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-suitcase c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.payments.title') }}
                </a>
            </li>
        @endcan
        @can('working_hour_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.working-hours.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/working-hours") || request()->is("admin/working-hours/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-hourglass c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.workingHour.title') }}
                </a>
            </li>
        @endcan
        @can('working_days')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.working_days.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/working_days") || request()->is("admin/working_days/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-hourglass c-sidebar-nav-icon">

                    </i>
                    Zile de lucru
                </a>
            </li>
        @endcan
        @can('appointment_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.appointments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/appointments") || request()->is("admin/appointments/*") ? "active" : "" }}">
                    <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.appointment.title') }}
                </a>
            </li>
        @endcan
        @can('project_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.projects.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/projects") || request()->is("admin/projects/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-tasks c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.project.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>