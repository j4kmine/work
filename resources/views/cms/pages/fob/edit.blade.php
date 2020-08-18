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
                        <form method="post" action="{{ route('fob.update', $fob->id) }}">
                            {{ method_field('PATCH') }}
                            <div class="card no-b">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="card-title">Edit FOB</h5>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="btn btn-primary btn-sm " href="{{url('fob')}}">List FOB</a>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="tipe_fob" class="col-form-label s-12">Tipe FOB</label>
                                                <select class="form-control" id="tipe_fob" name="tipe_fob">
                                                    <option value="">--Tipe--</option>
                                                    <option value="1" @if ($fob->tipe_fob == "1") {{ 'selected' }} @endif>FOB Udara </option>
                                                    <option value="2" @if ($fob->tipe_fob == "2") {{ 'selected' }} @endif>FOB LCL Laut</option>
                                                    <option value="3" @if ($fob->tipe_fob == "3") {{ 'selected' }} @endif>FOB FCL 20</option>
                                                    <option value="3" @if ($fob->tipe_fob == "4") {{ 'selected' }} @endif>FOB FCL 40</option>
                                                    <option value="4" @if ($fob->tipe_fob == "4") {{ 'selected' }} @endif>FOB Breakbulk</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="barang_umum" class="col-form-label s-12">Barang Umum</label>
                                            <input id="barang_umum" placeholder="Enter barang_umum" name="barang_umum" value="{{ $fob->barang_umum }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="agriculture" class="col-form-label s-12">Agriculture</label>
                                            <input id="agriculture" placeholder="Enter agriculture" name="agriculture" value="{{ $fob->agriculture }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="hewan_hidup" class="col-form-label s-12">Hewan Hidup</label>
                                            <input id="hewan_hidup" placeholder="Enter hewan_hidup" name="hewan_hidup" value="{{ $fob->hewan_hidup }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="barang_mudah_terbakar" class="col-form-label s-12">Barang Mudah Terbakar</label>
                                            <input id="barang_mudah_terbakar" placeholder="Enter barang_mudah_terbakar" name="barang_mudah_terbakar" value="{{ $fob->barang_mudah_terbakar }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="storage" class="col-form-label s-12">Storage</label>
                                            <input id="storage" placeholder="Enter storage" name="storage" value="{{ $fob->storage }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="storage_agriculture" class="col-form-label s-12">Storage Agriculture</label>
                                            <input id="storage_agriculture" placeholder="Enter Storage Agriculture" name="storage_agriculture" value="{{ $fob->storage_agriculture }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="storage_hewan_hidup" class="col-form-label s-12">Storage Hewan Hidup</label>
                                            <input id="storage_hewan_hidup" placeholder="Enter Storage Hewan Hidup" name="storage_hewan_hidup" value="{{ $fob->storage_hewan_hidup }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="storage_barang_mudah_terbakar" class="col-form-label s-12">Storage Barang Mudah Terbakar</label>
                                            <input id="storage_barang_mudah_terbakar" placeholder="Enter Barang Mudah Terbakar" name="storage_barang_mudah_terbakar" value="{{ $fob->storage_barang_mudah_terbakar }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="freaight" class="col-form-label s-12">Freaight</label>
                                            <input id="freaight" placeholder="Enter freaight" name="freaight" value="{{ $fob->freaight }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="freaight_agriculture" class="col-form-label s-12">Freaight Agriculture</label>
                                            <input id="freaight_agriculture" placeholder="Enter freaight Agriculture" name="freaight_agriculture" value="{{ $fob->freaight_agriculture }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="freaight_hewan_hidup" class="col-form-label s-12">Freaight Hewan Hidup</label>
                                            <input id="freaight_hewan_hidup" placeholder="Enter freaight Hewan Hidup" name="freaight_hewan_hidup" value="{{ $fob->freaight_hewan_hidup }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="freaight_barang_mudah_terbakar" class="col-form-label s-12">Freaight Barang Mudah Terbakar</label>
                                            <input id="freaight_barang_mudah_terbakar" placeholder="Enter freaight Barang Mudah Terbakar" name="freaight_barang_mudah_terbakar" value="{{ $fob->freaight_barang_mudah_terbakar }}" class="form-control r-0 light s-12 " type="text">
                                        </div>
                                    </div>
                                </div>
                                <br/>
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