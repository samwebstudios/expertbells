<div class="br-sideleft overflow-y-auto">
  <label class="sidebar-label pd-x-15 mg-t-20">Navigation</label>  
  <div class="br-sideleft-menu">  
    <a href="{{route('admin.index')}}" class="br-menu-link {{Request::segment(2)=='dashboard'?'active':''}}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-android-desktop tx-22"></i>
        <span class="menu-item-label">Dashboard</span>
      </div>
    </a>
    <a href="{{route('admin.experts')}}" class="br-menu-link {{in_array(Request::segment(2),['experts'])?'active':''}}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-person tx-22"></i>
        <span class="menu-item-label">Experts</span>
      </div>
    </a>
    <a href="{{route('admin.users')}}" class="br-menu-link {{in_array(Request::segment(2),['users'])?'active':''}}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-person-stalker tx-22"></i>
        <span class="menu-item-label">Users</span>
      </div>
    </a> 
    <a href="javascript:void(0)" class="br-menu-link {{in_array(Request::segment(2),$others) ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-24"></i>
        <span class="menu-item-label">Schedules </span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>  
    <ul class="br-menu-sub nav flex-column" style="display:{{in_array(Request::segment(3),$schedules) ? 'block' : 'none' }}">
      <li class="nav-item"><a href="{{route('admin.schedules.booked',['booked'=>'booked'])}}" class="nav-link {{Request::segment(3)=='booked'?'active':''}}">Booked</a></li>
      <li class="nav-item"><a href="{{route('admin.schedules.booked',['booked'=>'rejected'])}}" class="nav-link {{Request::segment(3)=='rejected'?'active':''}}">Rejected</a></li>
      <li class="nav-item"><a href="{{route('admin.schedules.booked',['booked'=>'expired'])}}" class="nav-link {{Request::segment(3)=='expired'?'active':''}}">Expired</a></li>
    </ul> 
    <a href="javascript:void(0)" class="br-menu-link {{in_array(Request::segment(2),$others) ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-24"></i>
        <span class="menu-item-label">Other Management </span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>  
    <ul class="br-menu-sub nav flex-column" style="display:{{in_array(Request::segment(2),$others) ? 'block' : 'none' }}">
      <li class="nav-item"><a href="{{route('admin.qualifications')}}" class="nav-link {{Request::segment(2)=='qualifications'?'active':''}}">Qualifications</a></li>
      <li class="nav-item"><a href="{{route('admin.expertise')}}" class="nav-link {{Request::segment(2)=='expertise'?'active':''}}">Expertise</a></li>
      <li class="nav-item"><a href="{{route('admin.language')}}" class="nav-link {{Request::segment(2)=='language'?'active':''}}">Language</a></li>
      <li class="nav-item"><a href="{{route('admin.industry')}}" class="nav-link {{Request::segment(2)=='industry'?'active':''}}">Industry</a></li>
      <li class="nav-item"><a href="{{route('admin.role')}}" class="nav-link {{Request::segment(2)=='role'?'active':''}}">Role</a></li>
      <li class="nav-item"><a href="{{route('admin.getbetter')}}" class="nav-link {{Request::segment(2)=='getbetter'?'active':''}}">Get Better</a></li>
      <li class="nav-item"><a href="{{route('admin.hearabout')}}" class="nav-link {{Request::segment(2)=='hearabout'?'active':''}}">Hear About us</a></li>
      <li class="nav-item"><a href="{{route('admin.working')}}" class="nav-link {{Request::segment(2)=='working'?'active':''}}">Working As</a></li>
    </ul>  
  </div>  
</div>