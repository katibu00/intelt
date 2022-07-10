<table class="table">
    <thead>
        <tr>
            <th style="width: 2%;">#</th>
            <th>Course</th>
            {{-- <th>Course Title</th> --}}
            {{-- <th>Credits</th> --}}
            <th>Department</th>
            <th>Level</th>
            <th>Semester</th>
            <th>Coordinator</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($allData as $key=> $value )
  
        <tr>
            
            <td>{{ $allData->firstItem() + $key}}</td>
            <td>{{ $value->course_code}} - {{ $value->course_title}} ({{ $value->credit_unit}} CU)</td>
            {{-- <td></td> --}}
            {{-- <td></td> --}}
            <td>
                @php
                    $datas = $value->department_id; 
                    $data = explode(',', $datas);
                @endphp

                @foreach ($data as $dat)
                    @php
                        @$name = App\Models\Department::find($dat);
                    @endphp
                    <span class="badge rounded-pill badge-light-primary me-1 mb-">{{@$name->name}}</span>
                @endforeach
            </td>
            <td>
                @php
                  @$level = App\Models\Level::where('order',$value->level)->first();
                @endphp
                {{@$level->name}}
            </td>
            <td>{{ ucfirst($value->semester)}}</td>
            <td>{{ $value->semester}}</td>
         
            <td>
                <div class="dropdown">
                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                        <i data-feather="more-vertical"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('courses.edit',$value->id) }}">
                            <i data-feather="edit-2" class="me-50"></i>
                            <span>Edit</span>
                        </a>
                        <a class="dropdown-item deleteItem" data-id="{{ $value->id }}" data-name="{{ $value->course_code }}" href="#">
                            <i data-feather="trash" class="me-50"></i>
                            <span>Delete</span>
                        </a>
                    </div>
                </div>
            </td>
          
        </tr>
        @endforeach
    
    </tbody>
</table>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center mt-2">
      {{ $allData->links() }}
    </ul>
</nav>