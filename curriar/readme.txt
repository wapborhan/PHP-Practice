/*
 * Admin Sidebar menu items
 * Ex:
 *  <li class="aiz-side-nav-item">
 *      <a href="#" class="aiz-side-nav-link">
 *          <i class="las la-file-alt aiz-side-nav-icon"></i>
 *          <span class="aiz-side-nav-text">{{ translate('Reports') }}</span>
 *          <span class="aiz-side-nav-arrow"></span>
 *      </a>
 *      <ul class="aiz-side-nav-list level-2">
 *          
 *      </ul>
 *  </li>
 */
@yield('admin_sidenav')
/*
 * Admin Permissions
 * Ex:
 *  @if(Auth::user()->user_type == 'admin' || in_array('10', json_decode(Auth::user()->staff->role->permissions)))
 *      <li class="aiz-side-nav-item">
 *          <a href="#" class="aiz-side-nav-link">
 *              <i class="las la-file-alt aiz-side-nav-icon"></i>
 *              <span class="aiz-side-nav-text">{{ translate('Reports') }}</span>
 *              <span class="aiz-side-nav-arrow"></span>
 *          </a>
 *          <ul class="aiz-side-nav-list level-2">
 *              
 *          </ul>
 *      </li>
 *  @endif
 */
@yield('admin_permissions')

