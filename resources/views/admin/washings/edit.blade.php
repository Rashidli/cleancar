@include('admin.includes.header')
<style>
    /* Style for the table */
    table {
       max-width: 600px;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    /* Style for table header */
    thead {
        background-color: #f2f2f2;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    /* Style for alternating rows */
    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Style for the delete button */
    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    /* Style for the create button */
    .btn-success {
        background-color: #28a745;
        color: #fff;
    }

    /* Style for form controls */
    .form-control {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    /* Remove default styling for select elements */
    select.form-control {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 25px; /* Add space for the arrow icon */
    }

    /* Add a custom arrow icon for select elements */
    select.form-control::after {
        content: '\25BC'; /* Unicode character for down arrow */
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    /* Responsive styling */
    @media (max-width: 768px) {
        table {
            display: block;
            overflow-x: auto;
        }
    }

</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{$washing->washing_name}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('washing')}}">Car washings</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$washing->washing_name}}</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('washing_update', $washing->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Washing name</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$washing->washing_name}}" name="washing_name" class="form-control" placeholder="Washing name">
                        </div>
                    </div>
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-sm-2 col-form-label">Owner name</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <input type="text" value="{{$washing->user->name}}" name="owner_name" class="form-control" placeholder="Owner name">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$washing->phone}}" name="phone" class="form-control" placeholder="phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Interval</label>
                        <div class="col-sm-10">
                            <input type="number" value="{{$washing->interval}}" name="interval" class="form-control" placeholder="interval">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Washing address</label>
                        <div class="col-sm-10">
                            <input type="text" name="address" value="{{$washing->address}}" class="form-control" placeholder="Washing address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Start time</label>
                        <div class="col-sm-10">
                            <input type="text" name="start_date" value="{{$washing->start_date}}" class="form-control" placeholder="Start date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">End time</label>
                        <div class="col-sm-10">
                            <input type="text" name="end_date" value="{{$washing->end_date}}" class="form-control" placeholder="End date">
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <label class="col-form-label col-sm-2 pt-0">Status</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control" >
                                    <option value="1" {{$washing->status == 1 ? 'selected': ''}}>Active</option>
                                    <option value="0" {{$washing->status == 0 ? 'selected': ''}}>Deactive</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <label class="col-form-label col-sm-2 pt-0">Şəhər seç</label>
                            <div class="col-sm-10">
                                <select name="city_id" class="form-control" >
                                    <option disabled selected>----</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{$washing->city_id == $city->id ? 'selected': ''}}>{{$city->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <label class="col-form-label col-sm-2 pt-0">Rayon seç</label>
                            <div class="col-sm-10">
                                <select name="region_id" class="form-control" >
                                    <option disabled selected>----</option>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}" {{$washing->region_id == $region->id ? 'selected': ''}}>{{$region->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <label class="col-form-label col-sm-2 pt-0">Qəsəbə seç</label>
                            <div class="col-sm-10">
                                <select name="village_id" class="form-control" >
                                    <option disabled selected>----</option>
                                    @foreach($villages as $village)
                                        <option value="{{$village->id}}" {{$washing->village_id == $village->id ? 'selected': ''}}>{{$village->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            @foreach($washing->images as $image)
                                <div class="image-container" style="display: inline-block; margin-right: 15px;">
                                    <img src="{{ asset($image->image) }}" alt="" width="50px" height="50px">
                                    <button class="delete-image-btn btn btn-danger" data-image-id="{{ $image->id }}">
                                        <i class="fa fa-trash color-danger"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Washing image</label>
                        <div class="col-sm-10">
                            <input type="file" name="image[]" multiple class="form-control" placeholder="Washing image">
                        </div>
                    </div>
                    <div class="form-group row repeater">
                        <label class="col-sm-2 col-form-label">Washing services</label>

                        <table >
                            <thead>
                                <tr>
                                    <th>Xidmet</th>
                                    <th>Ban</th>
                                    <th>Qiymet</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>
                            <tbody  data-repeater-list="washing_services">
                                @forelse($washing->services as $item)
                                    <tr data-repeater-item>
                                        <td>
                                            <select required name="service_id"  class="form-control">
                                                <option selected disabled>----</option>
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}" {{$item->pivot->service_id == $service->id ? 'selected' : ''}} >{{$service->title}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select required name="ban_id"  class="form-control">
                                                <option selected disabled>----</option>
                                                @foreach($bans as $ban)
                                                    <option value="{{$ban->id}}" {{$item->pivot->ban_id == $ban->id ? 'selected' : ''}}>{{$ban->title}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input required type="text" name="price" value="{{$item->pivot->price}}"  class="form-control">
                                        </td>
                                        <td>
                                            <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr data-repeater-item>
                                        <td>
                                            <select required name="service_id"  class="form-control">
                                                <option selected disabled>----</option>
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}">{{$service->title}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select required name="ban_id"  class="form-control">
                                                <option selected disabled>----</option>
                                                @foreach($bans as $ban)
                                                    <option value="{{$ban->id}}">{{$ban->title}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input required type="text" name="price"  class="form-control">
                                        </td>
                                        <td>
                                            <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><button data-repeater-create class="btn btn-success" type="button">+</button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Əlavə məlumat</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="description" class="form-control" placeholder="Əlavə məlumat" >{{$washing->description}}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.includes.footer')
{{--<script src="/admin_assets/js/repeater.js"></script>--}}
<script src="{{asset('admin_assets/js/repeater.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.delete-image-btn').on('click', function () {
                var imageId = $(this).data('image-id');

                $.ajax({
                    type: 'DELETE',
                    url: '{{ route("admin_images_delete", ["id" => "__imageId__"]) }}'.replace('__imageId__', imageId),
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        // Handle success, e.g., remove the image container from the DOM
                        $('.image-container[data-image-id="' + imageId + '"]').remove();
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            });
        });
    </script>

