<li class=" nav-item"><a class="d-flex align-items-center" href="app-todo.html"><i data-feather="check-square"></i><span class="menu-title text-truncate" data-i18n="Todo">Home</span></a>
</li>
<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">Course Registration</span></a>
    <ul class="menu-content">
        <li class="{{$route == 'register.courses' ?'active':''}}"><a class="d-flex align-items-center" href="{{ route('register.courses') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Register Courses</span></a>
        </li>
       
        
    </ul>
</li>
<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">Result</span></a>
    <ul class="menu-content">
        <li class="{{$route == 'student.result.index' ?'active':''}}"><a class="d-flex align-items-center" href="{{ route('student.result.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Result</span></a>
        </li>
    
        
    </ul>
</li>