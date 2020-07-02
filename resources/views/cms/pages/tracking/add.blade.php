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
            <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function(){
                    $('#mySelect2').select2({
                    ajax: {
                        url: "<?php echo url('webservice/getListNegara');?>",
                        dataType: 'json',
                        processResults: function (data) {
                          
                            
                        // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: data.data
                                
                               
                            };
                        },
                        placeholder: 'Search for a Order',
                        minimumInputLength: 2
                    }
                    });
                   
                })
              
            </script>
            <style>
                .select2-container .select2-selection--single{
                    height: 38px;
                }
            </style>
            <div class="row my-3">
                <div class="col-md-8 offset-md-2">
                    <form enctype='multipart/form-data' method="post" action="{{ route('tracking.store') }}">
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Add tracking</h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary btn-sm " href="{{url('tracking')}}">List tracking</a>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="Order" class="col-form-label s-12">Order</label>
                                        <div class="form-group m-0">
                                            <select id="mySelect2" class="form-control" ></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="status" class="col-form-label s-12">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Document Handling</option>
                                                <option value="2">Collected</option>
                                                <option value="3">Delivering</option>
                                                <option value="4">Delivered</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="flag" class="col-form-label s-12">Flag</label>
                                            <select class="form-control" id="flag" name="flag">
                                                <option value="1">Lancar</option>
                                                <option value="2">Peringatan</option>
                                                <option value="3">Gagal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <textarea class="form-control" placeholder="Keterangan"rows="5" id="comment"></textarea>
                                        </div>
                                    </div>
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