@include('admin.includes.header')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{$ll->text}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('ll_list')}}">Words</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$ll->key}}</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('ll_update', $ll->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Word</label>
                        <div class="col-sm-10">
                            <input type="hidden" required="required" name="key" value="{{old('key',$ll->key)}}" class="form-control col-md-7 col-xs-12">
                            <input type="text" value="{{$ll->text}}" name="text" class="form-control" placeholder="word">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.includes.footer')
