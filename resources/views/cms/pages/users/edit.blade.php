@extends('../../../templatecms')


@section('content')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
              </div>
            @endif
            <div class="container">
            <div class="row my-3">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{ route('users.update', $users->id) }}">
                        {{ method_field('PATCH') }}
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Edit User  </h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary btn-sm " href="{{url('users')}}">List Users</a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">NAME</label>
                                            <input id="name" placeholder="Enter User Name" name="name" value="{{ $users->name }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 m-0">
                                                <label for="cnic" class="col-form-label s-12"><i class="icon-lock3"></i>PASSWORD</label>
                                                <input id="cnic" name="password" placeholder="*****" class="form-control r-0 light s-12 " type="password">
                                            </div>
                                            <div class="form-group col-md-6 m-0">
                                                <label for="dob" class="col-form-label s-12"><i class="icon-lock3"></i>CONFIRM PASSWORD</label>
                                                <input id="dob" placeholder="*****" class="form-control r-0 light s-12" name="password_confirmation"
                                                     type="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mt-1">
                                    <div class="form-group col-md-6 m-0">
                                        <label for="email" class="col-form-label s-12"><i class="icon-envelope-o mr-2"></i>Email</label>
                                        <input id="email" placeholder="user@email.com" name="email" value="{{ $users->email }}" class="form-control r-0 light s-12 " type="text">
                                    </div>

                                    <div class="form-group col-md-6 m-0">
                                        <label for="phone" class="col-form-label s-12"><i class="icon-phone mr-2"></i>Phone</label>
                                        <input id="phone" placeholder="05112345678" name="phone" value="{{ $users->phone }}" class="form-control r-0 light s-12 " type="text">
                                    </div>
                                    
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-9 m-0">
                                        <label for="address"  class="col-form-label s-12">Address</label>
                                        <input type="text" name="address" value="{{ $users->address }}" class="form-control r-0 light s-12" id="address"
                                               placeholder="Enter Address">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <h5 class="card-title">Role</h5>
                                <div class="form-row">
                                    <div class="form-group col-5 m-0">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Role</label>
                                        <select name ="role" class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" id="inlineFormCustomSelectPref">
                                            <option value="1" {{ $users->role =='1' ? 'selected' : ''  }}>Admin</option>
                                            <option value="2" {{ $users->role =='2' ? 'selected' : ''  }}>User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Save Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            
        
@endsection