@extends('../../../templatepopup')


@section('content')
        <div class="container-fluid">
            <div class="tab-content my-3" id="v-pills-tabContent">
                <div class="tab-pane animated fadeInUpShort show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="card r-0 shadow">
                                <form action="" method="GET">
                                    <div class="container-fluid">
                                        <div class="row ">
                                            <div class="col-md-3">
                                                <br/>
                                                <div class="form-group input-group-sm has-right-icon focused">
                                                    <input class="form-control form-control-sm light r-30" placeholder="Search" name="search" value="{{ app('request')->input('search') }}" type="text">
                                                    <i class="icon-search"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <br/>
                                                <a  href="{{ route('image.create') }}" class="btn btn-success btn-sm"><i class="icon-trash mr-2"></i> Add Data</a>
                                            </div>
                                        </div>
                                    </div>
                                
                                </form>
                            </div>
                            <div class="card r-0 shadow">
                                <div class="table-responsive">
                                    <form id="tabellistdata" action="{{url()->current()}}/postProcess">
                                    <table   class="table table-striped table-hover r-0">
                                            <thead>
                                            <tr class="no-b">
                                                
                                                <th>IMAGES</th>
                                            
                                                <th></th>
                                            </tr>
                                            </thead>   
                                            <tbody>
                                                @foreach($images as $p)
                                                    <tr>
                                                    
                                                        <td>
                                                        <div class="d-flex">
                                                            <div>
                                                                <div>
                                                                    <img class="thumb-list" src="{{url('/images/'.$p->path)}}" />
                                                                
                                                                </div>
                                                                
                                                                <small> {{ $p->title }}</small>
                                                            </div>
                                                        </div>
                                                        </td>
                                                    
                                                        <td>
                                                            <a href="{{ url('image/hapus',$p->id) }}"><i class="icon-trash-can"></i></a>
                                                            
                                                            
                                                            <a href="{{ route('image.edit', $p->id)}}"><i class="icon-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <nav class="my-3" aria-label="Page navigation">
                        {{ $images->links() }}
                    </nav>
                    
                </div>
        
            </div>
        </div>
    
 
@endsection