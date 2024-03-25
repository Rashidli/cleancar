@include('admin.includes.header')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{$suggestion->translate('az')->title}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('suggestions.index')}}">Təkliflər</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$suggestion->translate('az')->title}}</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('suggestions.update', $suggestion->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="row">
                        <div class="col-6">

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq az</label>
                                <input class="form-control" type="text" name="az_title" value="{{$suggestion->translate('az')->title}}">
                                @if($errors->first('az_title')) <small class="form-text text-danger">{{$errors->first('az_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq en</label>
                                <input class="form-control" type="text" name="en_title" value="{{$suggestion->translate('en')->title}}">
                                @if($errors->first('en_title')) <small class="form-text text-danger">{{$errors->first('en_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq ru</label>
                                <input class="form-control" type="text" name="ru_title" value="{{$suggestion->translate('ru')->title}}">
                                @if($errors->first('ru_title')) <small class="form-text text-danger">{{$errors->first('ru_title')}}</small> @endif
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="col-form-label">Xidmət az</label>
                                <input class="form-control" type="text" name="az_service" value="{{$suggestion->translate('az')->service}}">
                                @if($errors->first('az_service')) <small class="form-text text-danger">{{$errors->first('az_service')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Xidmət en</label>
                                <input class="form-control" type="text" name="en_service" value="{{$suggestion->translate('en')->service}}">
                                @if($errors->first('en_service')) <small class="form-text text-danger">{{$errors->first('en_service')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Xidmət ru</label>
                                <input class="form-control" type="text" name="ru_service" value="{{$suggestion->translate('ru')->service}}">
                                @if($errors->first('ru_service')) <small class="form-text text-danger">{{$errors->first('ru_service')}}</small> @endif
                            </div>


                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="col-form-label">Ban az</label>
                                <input class="form-control" type="text" name="az_ban" value="{{$suggestion->translate('az')->ban}}">
                                @if($errors->first('az_ban')) <small class="form-text text-danger">{{$errors->first('az_ban')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Ban en</label>
                                <input class="form-control" type="text" name="en_ban" value="{{$suggestion->translate('en')->ban}}">
                                @if($errors->first('en_ban')) <small class="form-text text-danger">{{$errors->first('en_ban')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Ban ru</label>
                                <input class="form-control" type="text" name="ru_ban" value="{{$suggestion->translate('ru')->ban}}">
                                @if($errors->first('ru_ban')) <small class="form-text text-danger">{{$errors->first('ru_ban')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Qiymət</label>
                                <input class="form-control" type="number" name="en_price" value="{{$suggestion->price}}">
                                @if($errors->first('en_price')) <small class="form-text text-danger">{{$errors->first('en_price')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Filial</label>
                                <input class="form-control" type="text" name="ru_branch" value="{{$suggestion->branch}}">
                                @if($errors->first('ru_branch')) <small class="form-text text-danger">{{$errors->first('ru_branch')}}</small> @endif
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

