@include('admin.includes.header')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{$region->title}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
{{--                    <li class="breadcrumb-item"><a href="{{route('region')}}">City</a></li>--}}
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$region->title}}</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('region_update', $region->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Rayon title az</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$region->translate('az')->title}}" name="az_title" class="form-control" placeholder="Rayon name az">
                        </div>
                        <label class="col-sm-2 col-form-label">Rayon title en</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$region->translate('en')->title}}" name="en_title" class="form-control" placeholder="Rayon name en">
                        </div>
                        <label class="col-sm-2 col-form-label">Rayon title ru</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$region->translate('ru')->title}}" name="ru_title" class="form-control" placeholder="Rayon name ru">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.includes.footer')
