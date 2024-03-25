@include('admin.includes.header')
<div class="content-body">
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Cities list!</h4>
                <p class="mb-0">City dashboard template</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Cities</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cities Datatable</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add new city</button>
                    <br><br>
                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add new city</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('city_add')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">City name az</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="az_title" class="form-control" placeholder="City az">
                                            </div>
                                            <label class="col-sm-2 col-form-label">City name en</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="en_title" class="form-control" placeholder="City en">
                                            </div>
                                            <label class="col-sm-2 col-form-label">City name ru</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="ru_title" class="form-control" placeholder="City ru">
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
                                <th>City name</th>
                                <th>Rayonun əlavə et</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr style="color: #593bdb;">
                                    <td>{{$city->title}}</td>
                                    <td><a class="btn btn-success" href="{{route('region' , $city->id)}}">Rayonun əlavə et</a></td>
                                    <td><span>
                                            <a href="{{route('city_edit' , $city->id) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i> </a>
                                            <a href="{{route('city_delete', $city->id)}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>City name</th>
                                <th>Rayonun əlavə et</th>
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
