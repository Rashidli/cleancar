@include('admin.includes.header')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Banlar</h4>
                    <p class="mb-0">Ban dashboard template</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Ban</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ban Datatable</h4>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add new ban</button>
                        <br><br>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add new ban</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('bans.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Ban title az</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="az_title" class="form-control">
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Ban title en</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="en_title" class="form-control">
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Ban title ru</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="ru_title" class="form-control">
                                                </div>
                                                <label class="col-sm-2 col-form-label">Ban icon</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="image" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="display" >
                                <thead>
                                <tr>
                                    <th>Ban name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bans as $ban)
                                    <tr style="color: #593bdb;">
                                        <td>{{$ban->title}}</td>
                                        <td>
                                                <a href="{{route('bans.edit' , $ban->id) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i> </a>
    {{--                                            <a href="{{route('bans.destroy', $ban->id)}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a>--}}
                                                <form action="{{route('bans.destroy', $ban->id)}}" method="post" style="display: inline-block">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')" type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Term name</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.includes.footer')
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
<script>

    ClassicEditor
        .create( document.querySelector( '#editor_az' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor_en' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor_ru' ) )
        .catch( error => {
            console.error( error );
        } );

</script>
