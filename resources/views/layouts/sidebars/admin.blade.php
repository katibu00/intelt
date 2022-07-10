<li class=" nav-item"><a class="d-flex align-items-center" href="app-todo.html"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Todo">Home</span></a>
</li>
<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Invoice">Settings</span></a>
    <ul class="menu-content">
        <li class="{{$route == 'settings.institution' ?'active':''}}"><a class="d-flex align-items-center" href="{{ route('settings.institution') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Institution</span></a>
        </li>
        <li class="{{$route == 'faculties.index' ?'active':''}}"><a class="d-flex align-items-center" href="{{ route('faculties.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">@if($institution->type == 'university') Faculties @elseif($institution->type == 'nce') Schools @else Departments @endif</span></a>
        </li>
        <li class="{{$route == 'departments.index' ?'active':''}}"><a class="d-flex align-items-center" href="{{ route('departments.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">@if($institution->type == 'university') Departments @elseif($institution->type == 'nce') Departments @else Courses @endif</span></a>
        </li>
        <li class="{{$route == 'sessions.index' ?'active':''}}"><a class="d-flex align-items-center" href="{{ route('sessions.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Sessions</span></a>
        </li>
        <li class="{{$route == 'levels.index' ?'active':''}}"><a class="d-flex align-items-center" href="{{ route('levels.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Levels</span></a>
        </li>
        <li class="{{($route=='courses.index')?'active':''}} {{($route=='courses.create')?'active':''}} {{($route=='courses.details')?'active':''}} {{($route=='courses.edit')?'active':''}}"><a class="d-flex align-items-center" href="{{ route('courses.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Courses</span></a>
        </li>
        <li class="{{$route == 'grading.index' ?'active':''}} {{$route == 'grading.create' ?'active':''}}"><a class="d-flex align-items-center" href="{{ route('grading.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Grading System</span></a>
        </li>
        
    </ul>
</li>
<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Invoice">Marks</span></a>
    <ul class="menu-content">
        <li class="{{$route == 'marks.create' ?'active':''}}"><a class="d-flex align-items-center" href="{{ route('marks.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Marks</span></a>
        </li>
    </ul>
</li>
<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Invoice">Users</span></a>
    <ul class="menu-content">
        <li class="{{$route == 'students.index' ?'active':''}} {{$route == 'students.create' ?'active':''}}"><a class="d-flex align-items-center" href="{{ route('students.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Students</span></a>
        </li>
    </ul>
</li>
<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Invoice">Result</span></a>
    <ul class="menu-content">
        <li class="{{$route == 'admin.result.summary.index' ?'active':''}}"><a class="d-flex align-items-center" href="{{ route('admin.result.summary.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Summary</span></a>
        </li>
    </ul>
</li>