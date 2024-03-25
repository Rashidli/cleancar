@include('admin.includes.header')
<div class="content-body">
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Bölgə list!</h4>
                <p class="mb-0">Bölgə dashboard template</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Bölgə</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Bölgə Datatable</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add new bölgə</button>
                    <br><br>
                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add new bölgə</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('village_add')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Bölgə name az</label>
                                            <input type="hidden" name="parent_id" value="{{$region->id}}">
                                            <div class="col-sm-10">
                                                <input type="text" name="az_title" class="form-control" placeholder="Bölgə adı az">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Bölgə name en</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="en_title" class="form-control" placeholder="Bölgə adı en">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Bölgə name ru</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="ru_title" class="form-control" placeholder="Bölgə adı ru">
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
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>Bölgə name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($villages as $village)
                                <tr style="color: #593bdb;">
                                    <td>{{$village->title}}</td>
                                    <td><span>
                                            <a href="{{route('village_edit' , $village->id) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i> </a>
                                            <a href="{{route('village_delete', $village->id)}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Bölgə name</th>
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
