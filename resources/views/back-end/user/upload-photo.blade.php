<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Change profile photo</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="{{ route('user.update.profile.photo') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Upload Photo</label>
                    <input type="hidden" name="id" value="@if(isset($id)){{$id}}@endif" class="form-control"
                           required>
                    <input id="name"
                           type="file" name="photo" class="form-control"
                           required>
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
            <i class="fa fa-upload"></i>
            Upload
        </button>
    </div>
</form>
