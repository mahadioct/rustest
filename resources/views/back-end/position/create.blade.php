<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Create New Position</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="{{ route('position.store') }}" method="post">
    @csrf
    <div class="modal-body">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="departmentName">Select Department</label>
                    <select id="departmentName" type="text" name="department_id" class="form-control" required>
                        @if(!$departments->isEmpty())
                            @foreach($departments as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="positionName">Position Name</label>
                    <input id="positionName" type="text" name="name" class="form-control" required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-times"></i>
            Close
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i>
            Save
        </button>
    </div>
</form>
