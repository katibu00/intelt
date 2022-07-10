<table class="table">
    <thead>
        <tr>
            <th style="width: 2%;">#</th>
            <th>Name</th>
            <th>Reg Number</th>
            <th>Department</th>
            <th>Level</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($allData as $key=> $value )
  
        <tr>
            
            <td>{{ $allData->firstItem() + $key}}</td>
            <td>{{ $value->first_name }} {{ $value->middle_name }} {{ $value->last_name }}</td>
            <td>{{ @$value->reg_number }}</td>
            <td>{{ @$value['department']['name'] }}</td>
            <td>{{ @$value['level']['name'] }}</td>
            <td>{{ $value->status}}</td>
         
            <td>
                <div class="dropdown">
                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                        <i data-feather="more-vertical"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('courses.edit',$value->id) }}">
                            <i data-feather="edit-2" class="me-50"></i>
                            <span>Bio Data</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('courses.edit',$value->id) }}">
                            <i data-feather="edit-2" class="me-50"></i>
                            <span>Transcript</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('courses.edit',$value->id) }}">
                            <i data-feather="edit-2" class="me-50"></i>
                            <span>Suspend</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('courses.edit',$value->id) }}">
                            <i data-feather="edit-2" class="me-50"></i>
                            <span>Paymnent History</span>
                        </a>
                        <a class="dropdown-item deleteItem" data-id="{{ $value->id }}" data-name="{{ $value->course_code }}" href="#">
                            <i data-feather="trash" class="me-50"></i>
                            <span>Graduate</span>
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