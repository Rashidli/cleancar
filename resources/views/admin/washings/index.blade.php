@include('admin.includes.header')
<div class="content-body">
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Car Washings list!</h4>
                <p class="mb-0">Washing dashboard template</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Car Washings</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Car Washings Datatable</h4>
                </div>
                <div class="card-body">
{{--                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add new car washing</button>--}}
                    <br><br>
                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add new car washing</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('washing_add')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Washing name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="washing_name" class="form-control" placeholder="Washing name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Owner name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="owner_name" class="form-control" placeholder="Owner name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Owner phone</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="owner_tel" class="form-control" placeholder="Owner phone">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Washing address</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="address" class="form-control" placeholder="Washing address">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Start time</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="start_date" class="form-control" placeholder="Start time">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">End time</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="end_date" class="form-control" placeholder="End time">
                                            </div>
                                        </div>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <label class="col-form-label col-sm-2 pt-0">Status</label>
                                                <div class="col-sm-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" value="1" checked="">
                                                        <label class="form-check-label">
                                                           Active
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" value="0">
                                                        <label class="form-check-label">
                                                            Not active
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Washing image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="image" class="form-control" placeholder="Washing image">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Washing services</label>
                                            <div class="col-sm-10">
                                                <div class="card-body">
                                                    <div class="basic-form">
                                                            <div class="form-group">
                                                                @foreach($services as $service)
                                                                <div class="form-check form-check-inline">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" class="form-check-input" name="service_ids[]" value="{{$service->id}}">{{$service->name}}
                                                                    </label>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                    </div>
                                                </div>
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
                                <th>Washing name</th>
{{--                                <th>Owner name</th>--}}
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Əlavə məlumat</th>
                                <th>İnterval</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($washings as $washing)
                                <tr style="color: #593bdb;">
                                    <td>{{$washing->washing_name}}</td>
{{--                                    <td>--}}
{{--                                        @if ($washing->user)--}}
{{--                                            {{$washing->user->name}}--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
                                    <td>{{$washing->phone}}</td>
                                    <td>@if( $washing->status == 1)
                                            Active
                                        @else
                                            Not Active
                                        @endif
                                    </td>
                                    <td>{{$washing->description}}</td>
                                    <td>{{$washing->interval}}</td>
                                    <td><span>
                                            <a href="{{route('washing_edit' , ['id' => $washing->id]) }}" class="mr-4" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted"></i> </a>
                                            <a href="{{route('washing_delete', $washing->id)}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Washing name</th>
{{--                                <th>Owner name</th>--}}
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Əlavə məlumat</th>
                                <th>İnterval</th>
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
