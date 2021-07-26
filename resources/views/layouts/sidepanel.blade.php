<div class="sidebar-panel bg-white">
  <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center"><img class="pl-3" src="{{asset('app-assets/images/logo.png')}}" alt="alt" />
      <!--  <span class=" item-name text-20 text-primary font-weight-700">GULL</span> -->
      <div class="sidebar-compact-switch ml-auto"><span></span></div>
  </div>
  <!--  user -->
  <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">
      <div class="side-nav">
          <div class="main-menu">
              <ul class="metismenu" id="menu">
                  <li class="Ul_li--hover">
                    <a href="{{ route('home') }}">
                      <i class="i-Safe-Box1 text-20 mr-2 text-muted"></i>
                      <span class="item-name text-15 text-muted">Dashboards</span>
                    </a>
                  </li>
                  <li class="Ul_li--hover">
                    <a class="has-arrow" href="#">
                      <i class="i-Big-Data text-20 mr-2 text-muted"></i>
                      <span class="item-name text-15 text-muted">Master Data</span>
                    </a>
                    <ul class="mm-collapse">
                        @can('karyawan-menu')
                        <li class="item-name">
                          <a href="{{ route('karyawan.index') }}">
                            <i class="nav-icon i-Circular-Point"></i>
                            <span class="item-name">Karyawan</span>
                          </a>
                        </li>
                        @endcan
                    </ul>
                  </li>
                  <li class="Ul_li--hover">
                    <a class="has-arrow" href="#">
                      <i class="i-Gear-2 text-20 mr-2 text-muted"></i>
                      <span class="item-name text-15 text-muted">Settings</span>
                    </a>
                    <ul class="mm-collapse">
                        @can('user-list')
                        <li class="item-name">
                          <a href="{{ route('users.index') }}">
                            <i class="nav-icon i-Circular-Point"></i>
                            <span class="item-name">Users</span>
                          </a>
                        </li>
                        @endcan
                        @can('permission-list')
                        <li class="item-name">
                          <a href="{{ route('permissions.index') }}">
                            <i class="nav-icon i-Circular-Point"></i>
                            <span class="item-name">Permission</span>
                          </a>
                        </li>
                        @endcan
                        @can('role-list')
                        <li class="item-name">
                          <a href="{{ route('roles.index') }}">
                            <i class="nav-icon i-Circular-Point"></i>
                            <span class="item-name">Roles</span>
                          </a>
                        </li>
                        <li class="item-name">
                          <a href="https://iconsmind.com/view_icons/" target="_blank">
                            <i class="nav-icon i-Circular-Point"></i>
                            <span class="item-name">Iconmind</span>
                          </a>
                        </li>
                        @endcan
                    </ul>
                  </li>
                  <li class="Ul_li--hover">
                    <a class="has-arrow" href="#">
                      <i class="i-Data-Center text-20 mr-2 text-muted"></i>
                      <span class="item-name text-15 text-muted">Log</span>
                    </a>
                    <ul class="mm-collapse">
                        @can('user-list')
                        <li class="item-name">
                          <a href="{{ route('log.activity') }}">
                            <i class="nav-icon i-Circular-Point"></i>
                            <span class="item-name">Activity</span>
                          </a>
                        </li>
                        @endcan
                    </ul>
                  </li>
                  <li class="Ul_li--hover">
                    <a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                      <i class="i-Power-2 text-20 mr-2 text-muted"></i>
                      <span class="item-name text-15 text-muted">Logout</span>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                    </a>
                  </li>
              </ul>
          </div>
      </div>
      <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
          <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
      </div>
      <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
          <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
      </div>
      <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
          <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
      </div>
      <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
          <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
      </div>
  </div>
  <!--  side-nav-close -->
</div>

  