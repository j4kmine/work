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
                        <form method="post" action="{{ route('iklan.update', $iklan->id) }}">
                            {{ method_field('PATCH') }}
                            <div class="card no-b">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="card-title">Edit iklan</h5>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="btn btn-primary btn-sm " href="{{url('iklan')}}">List iklan</a>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="nama" class="col-form-label s-12">Nama</label>
                                                <input id="nama" placeholder="Enter Iklan Nama" name="nama" value="{{ $iklan->nama }}" class="form-control r-0 light s-12 " type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="lokasi" class="col-form-label s-12">Lokasi</label>
                                                <select class="form-control" id="lokasi" name="lokasi">
                                                    <option value="">--Tipe--</option>
                                                    <option value="1" @if ($iklan->lokasi == "1") {{ 'selected' }} @endif>Sidebar 1 </option>
                                                    <option value="2" @if ($iklan->lokasi == "2") {{ 'selected' }} @endif>Sidebar 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    
                                </div>
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary btn-lg openpopupberita"><i class="icon-image mr-2"></i>Pick Image</button>
                                    <br/>
                                    <div id="list-gambar-berita" class="row">
                                        @if($image->id != '')
                                            <div class="card-body" id="{{ $image->id  }}">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <img class="img-responsive" src="{{url('/images/'.$image->path)}}">
                                                        <input name="id_image" type="hidden" value="{{ $image->id  }}">
                                                        <input name="title_image" type="hidden" value="{{ $image->title  }}">
                                                        <input name="path" type="hidden" value="{{url('/images/'.$image->path)}}">
                                                        <h3 class="my-3">{{ $image->title  }}</h3><button class="my-3 btn btn-danger btn-lg btn-block" onclick="removeimage({{ $image->id  }})" type="button">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Save Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection