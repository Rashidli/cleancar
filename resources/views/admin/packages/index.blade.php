@include('admin.includes.header')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Qiymət paketləri!</h4>
                    <p class="mb-0">Qiymət paketləri dashboard template</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Qiymət paketləri</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Qiymət paketləri Datatable</h4>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add new package</button>
                        <br><br>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add new paket</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('packages.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Başlıq az</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="az_title" class="form-control">
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Başlıq en</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="en_title" class="form-control">
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Başlıq ru</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="ru_title" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Müddəti az</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="az_duration" class="form-control">
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Müddəti en</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="en_duration" class="form-control">
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Müddəti ru</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="ru_duration" class="form-control">
                                                </div>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 col-form-label">Qiymət</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="price" class="form-control">
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
                                    <th>Paket</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($packages as $package)
                                    <tr style="color: #593bdb;">
                                        <td>{{$package->title}}</td>
                                        <td>
                                                <a href="{{route('packages.edit' , $package->id) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i> </a>
                                                <form action="{{route('packages.destroy', $package->id)}}" method="post" style="display: inline-block">
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
                                    <th>Paket</th>
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

