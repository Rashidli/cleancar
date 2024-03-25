@include('admin/includes/header')


    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-0">Washing dashboard template</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
           <div class="row">
               <div class="col-lg-8">
                   <div class="card">
                       <div class="card-body">
                           <div class="profile-tab">
                               <div class="custom-tab-1">
                                   <ul class="nav nav-tabs">
                                       <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">About Me</a>
                                       </li>
                                       <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link">Edit</a>
                                       </li>
                                   </ul>
                                   <div class="tab-content">
                                       <div id="about-me" class="tab-pane fade active show">
                                           <div class="profile-personal-info">
                                               <br>
                                               <h4 class="text-primary mb-4">Personal Information</h4>
                                               @foreach($users as $user)
                                                   <div class="row mb-4">
                                                       <div class="col-3">
                                                           <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                                           </h5>
                                                       </div>
                                                       <div class="col-9"><span>{{$user->email}}</span>
                                                       </div>
                                                   </div>
                                                   <div class="row mb-4">
                                                       <div class="col-3">
                                                           <h5 class="f-w-500">Name <span class="pull-right">:</span>
                                                           </h5>
                                                       </div>
                                                       <div class="col-9"><span>{{$user->name}}</span>
                                                       </div>
                                                   </div>
                                                   <div class="row mb-4">
                                                       <div class="col-3">
                                                           <h5 class="f-w-500">Password <span class="pull-right">:</span>
                                                           </h5>
                                                       </div>
                                                       <div class="col-9"><span>*******</span>
                                                       </div>
                                                   </div>
                                               @endforeach
                                           </div>
                                       </div>
                                       <div id="profile-settings" class="tab-pane fade">
                                           <div class="pt-3">
                                               <div class="settings-form">
                                                   <h4 class="text-primary">Account Setting</h4>
                                                   @foreach($users as $user)
                                                       <form action="{{route('admin_update' , $user->id)}}" method="post">
                                                           @csrf
                                                           <div class="form-row">
                                                               <div class="form-group col-md-6">
                                                                   <label>Email</label>
                                                                   <input type="email" name="email" placeholder="Email" value="{{$user->email}}" class="form-control">
                                                               </div>
                                                               <div class="form-group col-md-6">
                                                                   <label>Name</label>
                                                                   <input type="text" name="name" placeholder="Name" value="{{$user->name}}" class="form-control">
                                                               </div>
                                                               <div class="form-group col-md-6">
                                                                   <label>Password</label>
                                                                   <input type="password" name="password" placeholder="Password" class="form-control">
                                                               </div>
                                                           </div>
                                                           <button class="btn btn-primary" type="submit">Change</button>
                                                       </form>
                                                   @endforeach
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>



@include('admin/includes/footer')
