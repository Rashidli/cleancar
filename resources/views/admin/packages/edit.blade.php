@include('admin.includes.header')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{$package->translate('az')->title}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('packages.index')}}">Təkliflər</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$package->translate('az')->title}}</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('packages.update', $package->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="row">
                        <div class="col-6">

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq az</label>
                                <input class="form-control" type="text" name="az_title" value="{{$package->translate('az')->title}}">
                                @if($errors->first('az_title')) <small class="form-text text-danger">{{$errors->first('az_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq en</label>
                                <input class="form-control" type="text" name="en_title" value="{{$package->translate('en')->title}}">
                                @if($errors->first('en_title')) <small class="form-text text-danger">{{$errors->first('en_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq ru</label>
                                <input class="form-control" type="text" name="ru_title" value="{{$package->translate('ru')->title}}">
                                @if($errors->first('ru_title')) <small class="form-text text-danger">{{$errors->first('ru_title')}}</small> @endif
                            </div>

                        </div>
                        <div class="col-6">

                            <div class="mb-3">
                                <label class="col-form-label">Müddət az</label>
                                <input class="form-control" type="text" name="az_duration" value="{{$package->translate('az')->duration}}">
                                @if($errors->first('az_duration')) <small class="form-text text-danger">{{$errors->first('az_duration')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Müddət en</label>
                                <input class="form-control" type="text" name="en_duration" value="{{$package->translate('en')->duration}}">
                                @if($errors->first('en_duration')) <small class="form-text text-danger">{{$errors->first('en_duration')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Müddət ru</label>
                                <input class="form-control" type="text" name="ru_duration" value="{{$package->translate('ru')->duration}}">
                                @if($errors->first('ru_duration')) <small class="form-text text-danger">{{$errors->first('ru_duration')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Qiymət</label>
                                <input class="form-control" type="text" name="price" value="{{$package->price}}">
                                @if($errors->first('price')) <small class="form-text text-danger">{{$errors->first('price')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary">Yadda saxla</button>
                            </div>

                        </div>
                    </div>
{{--                    <button type="submit" class="btn btn-primary">Update</button>--}}
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.includes.footer')

