@include('admin.includes.header')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{$blog->translate('az')->title}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('blogs.index')}}">Terms</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$blog->translate('az')->title}}</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('blogs.update', $blog->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="row">
                        <div class="col-6">

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq az</label>
                                <input class="form-control" type="text" name="az_title" value="{{$blog->translate('az')->title}}">
                                @if($errors->first('az_title')) <small class="form-text text-danger">{{$errors->first('az_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq en</label>
                                <input class="form-control" type="text" name="en_title" value="{{$blog->translate('en')->title}}">
                                @if($errors->first('en_title')) <small class="form-text text-danger">{{$errors->first('en_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Başlıq ru</label>
                                <input class="form-control" type="text" name="ru_title" value="{{$blog->translate('ru')->title}}">
                                @if($errors->first('ru_title')) <small class="form-text text-danger">{{$errors->first('ru_title')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Mətn az</label>
                                <textarea id="editor_az" class="form-control" type="text" name="az_content" >{{$blog->translate('az')->content}}</textarea>
                                @if($errors->first('az_content')) <small class="form-text text-danger">{{$errors->first('az_content')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Mətn en</label>
                                <textarea id="editor_en" class="form-control" type="text" name="en_content" >{{$blog->translate('en')->content}}</textarea>
                                @if($errors->first('en_content')) <small class="form-text text-danger">{{$errors->first('en_content')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Mətn ru</label>
                                <textarea id="editor_ru" class="form-control" type="text" name="ru_content">{{$blog->translate('ru')->content}}</textarea>
                                @if($errors->first('ru_content')) <small class="form-text text-danger">{{$errors->first('ru_content')}}</small> @endif
                            </div>

                            <div class="mb-3">
                                <img style="background-color: #4283F0 !important;width: 100px; height: 100px;" src="{{ asset($blog->image) }}" class="uploaded_image" alt="{{$blog->image}}">
                                <div class="form-group">
                                    <label >Blog image</label>
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
