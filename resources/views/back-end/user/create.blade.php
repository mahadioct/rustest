<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Create New User</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="{{ route('user.store') }}" method="post">
    @csrf
    <div class="modal-body">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">User Full Name</label>
                    <input id="name"
                           type="text" name="name" class="form-control"
                           required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="text" name="password" class="form-control"
                           required>
                </div>
                <div class="form-group">
                    <label for="positionName">Select Position</label>
                    <select id="positionName" type="text" name="position_id"
                            class="form-control" required>
                        @if(!$positions->isEmpty())
                            @foreach($positions as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">User E-Mail</label>
                    <input id="email" type="email" name="email" class="form-control"
                           required>
                </div>
                <div class="form-group">
                    <label for="departmentName">Select Department</label>
                    <select style="width: 100%;" id="departmentName" name="department_id[]"
                            multiple="multiple"
                            class="form-control" required>
                        @if(!$departments->isEmpty())
                            @foreach($departments as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
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
<script>
    $('#departmentName').select2();
</script>
