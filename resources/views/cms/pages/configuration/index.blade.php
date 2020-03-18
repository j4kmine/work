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
            
            @if(isset($configuration)  && count($configuration)>0) 
                <div class="row my-3">
                    <div class="col-md-8 offset-md-2">
                        <form enctype='multipart/form-data' method="post" action="{{ route('configuration.update', $configuration->id) }}">
                            {{ method_field('PATCH') }}
                            <div class="card no-b">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="card-title">Configuration</h5>
                                        </div>
                                    
                                    </div>
                                
                                
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Site Title</label>
                                            <input id="title" placeholder="Enter Site Title" name="site_title" value="{{ $configuration->site_title }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Meta Title</label>
                                            <input id="meta_title" placeholder="Enter Meta Title " name="meta_title" value="{{ $configuration->meta_title  }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Meta Keyword</label>
                                            <textarea rows="5" class="form-control r-0 light s-12" id="meta_keyword" placeholder="Enter Meta keyword " name="meta_keyword" >
                                                {{ $configuration->meta_keyword  }} 
                                            </textarea>
                                        </div>
                                    </div>
                                </div>  
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Meta Description</label>
                                            <textarea rows="5" class="form-control r-0 light s-12" id="meta_description" placeholder="Enter Meta description " name="meta_description" >
                                                {{ $configuration->meta_description  }} 
                                            </textarea>
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Address</label>
                                            <textarea rows="5" class="form-control r-0 light s-12" id="address" placeholder="Enter Address " name="address" >
                                                {{ $configuration->alamat  }} 
                                            </textarea>
                                        </div>
                                    </div>
                                </div>  
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Phone</label>
                                            <input id="phone" placeholder="Enter Phone " name="phone" value="{{ $configuration->nophone  }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Hp</label>
                                            <input id="hp" placeholder="Enter Hp " name="hp" value="{{ $configuration->hp  }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Fax</label>
                                            <input id="fax" placeholder="Enter Fax " name="fax" value="{{ $configuration->fax  }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Email</label>
                                            <input id="email" placeholder="Enter Email " name="email" value="{{ $configuration->email  }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Facebook</label>
                                            <input id="facebook" placeholder="Enter Facebook " name="facebook" value="{{ $configuration->fb  }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Twitter</label>
                                            <input id="twitter" placeholder="Enter Twitter " name="twitter" value="{{ $configuration->twitter }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Instagram</label>
                                            <input id="instagram" placeholder="Enter Instagram " name="instagram" value="{{ $configuration->instagram  }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Save Data</button>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="row my-3">
                    <div class="col-md-8 offset-md-2">
                        <form enctype='multipart/form-data' method="post" action="{{ route('configuration.store') }}">
                            {{ method_field('POST') }}
                            <div class="card no-b">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="card-title">Configuration</h5>
                                        </div>
                                    
                                    </div>
                                
                                
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Site Title</label>
                                            <input id="title" placeholder="Enter Site Title" name="site_title" value="{{ old('site_title') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Meta Title</label>
                                            <input id="meta_title" placeholder="Enter Meta Title " name="meta_title" value="{{ old('meta_title') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Meta Keyword</label>
                                            <textarea rows="5" class="form-control r-0 light s-12" id="meta_keyword" placeholder="Enter Meta keyword " name="meta_keyword" >
                                                {{ old('meta_keyword') }} 
                                            </textarea>
                                        </div>
                                    </div>
                                </div>  
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Meta Description</label>
                                            <textarea rows="5" class="form-control r-0 light s-12" id="meta_description" placeholder="Enter Meta description " name="meta_description" >
                                                {{ old('meta_description') }} 
                                            </textarea>
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Address</label>
                                            <textarea rows="5" class="form-control r-0 light s-12" id="address" placeholder="Enter Address " name="address" >
                                                {{ old('address') }} 
                                            </textarea>
                                        </div>
                                    </div>
                                </div>  
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Phone</label>
                                            <input id="phone" placeholder="Enter Phone " name="phone" value="{{ old('phone') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Hp</label>
                                            <input id="hp" placeholder="Enter Hp " name="hp" value="{{ old('hp') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Fax</label>
                                            <input id="fax" placeholder="Enter Fax " name="fax" value="{{ old('fax') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Email</label>
                                            <input id="email" placeholder="Enter Email " name="email" value="{{ old('email') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Facebook</label>
                                            <input id="facebook" placeholder="Enter Facebook " name="facebook" value="{{ old('facebook') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Twitter</label>
                                            <input id="twitter" placeholder="Enter Twitter " name="twitter" value="{{ old('twitter') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Instagram</label>
                                            <input id="instagram" placeholder="Enter Instagram " name="instagram" value="{{ old('instagram') }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Save Data</button>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </form>
                    </div>
                </div>

            @endif 
            </div>
          
            
        
@endsection