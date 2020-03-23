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
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Service Pricing</label>
                                            <input id="service_pricing" placeholder="Enter Service Pricing " name="service_pricing" value="{{ $configuration->service_pricing  }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <button type="button" class="btn btn-primary btn-lg openpopupberita"><i class="icon-image mr-2"></i>Pick Image</button>
                                    <br/>
                                    <div id="list-gambar-berita" class="row">
                                        @if( $configuration->image->id != '')
                                            <div class="card-body" id="{{ $configuration->image->id  }}">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <img class="img-responsive" src="{{url('/images/'.$configuration->image->path)}}">
                                                        <input name="id_image" type="hidden" value="{{ $configuration->image->id  }}">
                                                        <input name="title_image" type="hidden" value="{{ $configuration->image->title  }}">
                                                        <input name="path" type="hidden" value="{{url('/images/'.$configuration->image->path)}}">
                                                        <h3 class="my-3">{{ $configuration->image->title  }}</h3><button class="my-3 btn btn-danger btn-lg btn-block" onclick="removeimage({{ $configuration->image->id  }})" type="button">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">Service Pricing</label>
                                            <textarea rows="5" class="form-control r-0 light s-12" id="service_pricing" placeholder="Enter Service Pricing " name="service_pricing" >
                                                {{ old('service_pricing') }} 
                                            </textarea>
                                        </div>
                                    </div>
                                </div>  
                                <br/>
                                <div class="form-row">
                                    <button type="button" class="btn btn-primary btn-lg openpopupberita"><i class="icon-image mr-2"></i>Pick Image</button>
                                    <br/>
                                    <div id="list-gambar-berita" class="row">
                                        @if(old('path') != '')
                                            <div class="card-body" id="{{ old('id_image') }}">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <img class="img-responsive" src="{{ old('path') }}">
                                                        <input name="id_image" type="hidden" value="{{ old('id_image') }}">
                                                        <input name="title_image" type="hidden" value="{{ old('title_image') }}">
                                                        <input name="path" type="hidden" value="{{ old('path') }}">
                                                        <h3 class="my-3">{{ old('title_image') }}</h3><button class="my-3 btn btn-danger btn-lg btn-block" onclick="removeimage({{ old('id_image') }})" type="button">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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