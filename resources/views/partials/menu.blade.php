<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>       
    </ul>
 
    <ul class="navbar-nav ml-auto">
         
      <li class="nav-item dropdown">
        <?php //print_r($notifications); ?>
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{count($notifications)}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{count($notifications)}} Notifications</span>
            @foreach($notifications as $notification)
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> {{$notification->message}} 
              </a>
            @endforeach
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
       
    </ul>
  </nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
 
    <div class="sidebar">
       

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           
          <li class="nav-item">
            <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>{{ trans('global.dashboard') }}</p>
                </a>
          </li>
           @can('manage_employee')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-fw fas fa-users nav-icon"></i>
              <p>
                {{ trans('cruds.userManagement.title') }}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-unlock-alt nav-icon">

                        </i>
                        <p>{{ trans('cruds.permission.title') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase nav-icon">

                        </i>
                        <p>{{ trans('cruds.role.title') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user nav-icon">

                        </i>
                        <p>{{ trans('cruds.user.title') }}</p>
                    </a>
                </li>
               
            </ul>
          </li>
          @endcan
           @can('task_manage')
          <li class="nav-item">
            <a href="{{ route("admin.tasks.index") }}" class="nav-link" >
                    <i class="fa-fw fas fa-list nav-icon"></i>
                    <p>{{ trans('cruds.taskManagement.title') }}</p>
                </a>
             
          </li>
          @endcan
            
            <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">

                    </i>
                    <p>Change password</p>
                </a>
            </li>
          <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    <p>{{ trans('global.logout') }}</p>
                </a>
             
          </li>
        </ul>
      </nav> 
    </div> 
  </aside>

<?php /*

<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('manage_employee')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">

                    </i>
                    Change password
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
*/ ?>