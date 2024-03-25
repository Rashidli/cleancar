@include('admin.includes.header')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{$language->translate('az')->title}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('languages.index')}}">Dil</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$language->translate('az')->title}}</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('languages.update', $language->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="col-form-label">Dil</label>
                                <input class="form-control" type="text" name="language" value="{{$language->language}}">
                                @if($errors->first('language')) <small class="form-text text-danger">{{$errors->first('language')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Dil başlıq az</label>
                                <input class="form-control" type="text" name="az_title" value="{{$language->translate('az')->title}}">
                                @if($errors->first('az_title')) <small class="form-text text-danger">{{$errors->first('az_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Dil başlıq en</label>
                                <input class="form-control" type="text" name="en_title" value="{{$language->translate('en')->title}}">
                                @if($errors->first('en_title')) <small class="form-text text-danger">{{$errors->first('en_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Dil başlıq ru</label>
                                <input class="form-control" type="text" name="ru_title" value="{{$language->translate('ru')->title}}">
                                @if($errors->first('ru_title')) <small class="form-text text-danger">{{$errors->first('ru_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <img style="width: 100px; height: 100px;" src="{{ asset($language->image) }}" class="uploaded_image" alt="{{$language->image}}">
                                <div class="form-group">
                                    <label >Service icon</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                @if($errors->first('image')) <small class="form-text text-danger">{{$errors->first('image')}}</small> @endif
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
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor_az' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor_en' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor_ru' ) )
        .catch( error => {
            console.error( error );
        } );

</script>
