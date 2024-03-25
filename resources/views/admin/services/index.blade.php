@include('admin.includes.header')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Servicelar</h4>
                    <p class="mb-0">Service dashboard template</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Service</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Service Datatable</h4>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add new service</button>
                        <br><br>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add new service</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('services.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Service title az</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="az_title" class="form-control">
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Service title en</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="en_title" class="form-control">
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Service title ru</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="ru_title" class="form-control">
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Service mətn az</label>
                                                <div class="col-sm-10">
                                                    <textarea id="editor_az" class="form-control" type="text" name="az_content"></textarea>
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Service mətn en</label>
                                                <div class="col-sm-10">
                                                    <textarea id="editor_en" class="form-control" type="text" name="en_content"></textarea>                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Service mətn ru</label>
                                                <div class="col-sm-10">
                                                    <textarea id="editor_ru" class="form-control" type="text" name="ru_content"></textarea>
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Service icon (ag)</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="image" class="form-control" >
                                                </div>
                                                <label class="col-sm-2 col-form-label">Service icon (goy)</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="image_white" class="form-control" >
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
                                    <th>Service name</th>
                                    <th>Icon (ag)</th>
                                    <th>Icon (goy)</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($services as $service)
                                    <tr style="color: #593bdb;">
                                        <td>{{$service->title}}</td>
                                        <td style="background-color: #4283F0 !important;width: 100px; height: 100px"><img style="width: 100%; height: 100%; object-fit: contain !important;" src="{{$service->image}}" alt=""></td>
                                        <td style="width: 100px; height: 100px"><img style="width: 100%; height: 100%; object-fit: contain !important;" src="{{$service->image_white}}" alt=""></td>
                                        <td>
                                                <a href="{{route('services.edit' , $service->id) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i> </a>
    {{--                                            <a href="{{route('services.destroy', $service->id)}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a>--}}
                                                <form action="{{route('services.destroy', $service->id)}}" method="post" style="display: inline-block">
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
                                    <th>Service name</th>
                                    <th>Icon (ag)</th>
                                    <th>Icon (goy)</th>
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
