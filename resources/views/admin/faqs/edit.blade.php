@include('admin.includes.header')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{$faq->translate('az')->title}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('faqs.index')}}">Təkliflər</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$faq->translate('az')->title}}</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('faqs.update', $faq->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="row">
                        <div class="col-6">

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq az</label>
                                <input class="form-control" type="text" name="az_title" value="{{$faq->translate('az')->title}}">
                                @if($errors->first('az_title')) <small class="form-text text-danger">{{$errors->first('az_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq en</label>
                                <input class="form-control" type="text" name="en_title" value="{{$faq->translate('en')->title}}">
                                @if($errors->first('en_title')) <small class="form-text text-danger">{{$errors->first('en_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq ru</label>
                                <input class="form-control" type="text" name="ru_title" value="{{$faq->translate('ru')->title}}">
                                @if($errors->first('ru_title')) <small class="form-text text-danger">{{$errors->first('ru_title')}}</small> @endif
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="col-form-label">Mətn az</label>
                                <textarea id="editor_az" class="form-control" type="text" name="az_content" >{{$faq->translate('az')->content}}</textarea>
                                @if($errors->first('az_content')) <small class="form-text text-danger">{{$errors->first('az_content')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Mətn en</label>
                                <textarea id="editor_en" class="form-control" type="text" name="en_content" >{{$faq->translate('en')->content}}</textarea>
                                @if($errors->first('en_content')) <small class="form-text text-danger">{{$errors->first('en_content')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Mətn ru</label>
                                <textarea id="editor_ru" class="form-control" type="text" name="ru_content">{{$faq->translate('ru')->content}}</textarea>
                                @if($errors->first('ru_content')) <small class="form-text text-danger">{{$errors->first('ru_content')}}</small> @endif
                            </div>
                            

                            <div class="mb-3">
                                <label class="col-form-label">App sec</label>
                                <select name="type" id="" class="form-control">
                                    <option value="1" {{$faq->type == 1 ? 'selected' : ''}}>Customer</option>
                                    <option value="2" {{$faq->type == 2 ? 'selected' : ''}}>Employee</option>
                                </select>
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

