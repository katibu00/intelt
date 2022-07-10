<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($allData as $key=> $value )
  
        <tr>
            
            <td>{{ $allData->firstItem() + $key}}</td>
            <td>{{ $value->name}}</td>
         
            <td>
              <button class="btn btn-info btn-small updateItem" 
                  data-bs-toggle="modal" 
                  data-bs-target="#updateModal"
                  data-id="{{$value->id}}"
                  data-name="{{$value->name}}">
                  <i class="fa fa-edit"></i>
              </button>
              <button class="btn btn-danger btn-small deleteItem" 
                  data-bs-toggle="modal" 
                  data-bs-target="#deleteModal"
                  data-id="{{$value->id}}"
                  data-name="{{$value->name}}">
                  <i class="fa fa-trash"></i>
              </button>
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