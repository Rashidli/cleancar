@include('admin.includes.header')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{$price->price}}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('price')}}">Price</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$price->price}}</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('price_update', $price->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{$price->price}}" name="price" class="form-control" placeholder="Price">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.includes.footer')
