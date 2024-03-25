@include('admin.includes.header')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{$city->title}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('city')}}">City</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$city->title}}</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('city_update', $city->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">City title az</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$city->translate('az')->title}}" name="az_title" class="form-control" placeholder="City name az">
                        </div>
                        <label class="col-sm-2 col-form-label">City title en</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$city->translate('en')->title}}" name="en_title" class="form-control" placeholder="City name en">
                        </div>
                        <label class="col-sm-2 col-form-label">City title ru</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$city->translate('ru')->title}}" name="ru_title" class="form-control" placeholder="City name ru">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.includes.footer')
