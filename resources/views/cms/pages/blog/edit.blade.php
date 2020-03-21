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
                <script src="{{ asset('node_modules/tinymce/tinymce.min.js') }}"></script>
                <script>
                    tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'body');
                        
                    tinymce.init({
                        selector: "textarea#body",
                        // init_instance_callback: "insert_contents",
                        theme: "modern",
                        height: 400,
                        plugins: [
                             "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                             "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                             "save table contextmenu directionality emoticons template paste textcolor gambar insertlinks highlight"
                       ],
                       toolbar: "insertfile undo redo pagebreak | styleselect blockquote highlight  | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media gambar gambaranalisis embed_grafik embed_chart  addvideotemp | addbigfoto addimageright addimageleft addimagedouble highlightanalisis quotesanalisis | addsummary addimagemulti1 addimagemulti2 print preview fullpage forecolor backcolor emoticons fullscreen",
                        setup: function(editor) {
                            editor.on('blur', function(e) {
                              var body = tinyMCE.activeEditor.getContent();
                              console.log(body);
                               Cookies.set('body',body);
                            });
                        },
                       style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Heading h5', block: 'h5'},
                            {title: 'Heading h4', block: 'h4'},
                            {title: 'Heading h3', block: 'h3'},
                            {title: 'Heading h2', block: 'h2'},
                            {title: 'Heading h1 Normal', block: 'h1'},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}}
                        ],
                        paste_postprocess: function(plugin, args) {
                            args.node.innerHTML = cleanHTML(args.node.innerHTML);
                        },
                        formats: {
                            alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'align-left', styles : {float : 'left'}},
                            alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'align-right', styles : {float : 'right'}}
                        },
                        contextmenu: "link image media inserttable | cell row column deletetable | copy paste cut",

                        content_css : "{{url('assets/css/app.css')}}",
                        rel_list: [
                            {title: 'None', value: ''},
                            {title: 'No Follow', value: 'nofollow'},
                        ],
                        relative_urls : false,
                        remove_script_host: false,
                        
                        file_browser_callback   : function(field_name, url, type, win) {
                            if (type == 'image') {
                                var cmsURL       = "{{url('imagepopup')}}";

                                tinymce.activeEditor.windowManager.open({

                                    file            : cmsURL,
                                    title           : 'Select an Image',
                                    width           : 800,  // Your dimensions may differ - toy around with them!
                                    height          : 400,
                                    resizable       : "yes",
                                    inline          : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
                                    close_previous  : "yes"
                                
                                }, {
                                    window  : win,
                                    input   : field_name
                                });
                            };
                            
                        }
                    });
                </script>
                <div class="row my-3">
                    <div class="col-md-8 offset-md-2">
                        <form method="post" action="{{ route('blog.update', $blog->id) }}">
                            {{ method_field('PATCH') }}
                            <div class="card no-b">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="card-title">Edit Blog</h5>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="btn btn-primary btn-sm " href="{{url('blog')}}">List blog</a>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="title" class="col-form-label s-12">TITLE</label>
                                                <input id="title" placeholder="Enter Blog Title" name="title" value="{{ $blog->title }}" class="form-control r-0 light s-12 " type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="summary" class="col-form-label s-12">SUMMARY</label>
                                                <input id="summary" placeholder="Enter Blog summary" name="summary" value="{{ $blog->summary }}" class="form-control r-0 light s-12 " type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="summary" class="col-form-label s-12">CONTENT</label>
                                                <textarea id="body" placeholder="Enter Blog Content" name="body" value="{{ $blog->body }}" class="form-control r-0 light s-12 " type="text">{{ $blog->body }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group m-0">
                                                <label for="name" class="col-form-label s-12">KEYWORD</label>
                                                <input id="keyword" placeholder="Enter Blog Keyword" name="keyword" value="{{ $blog->keyword }}" class="form-control r-0 light s-12 " type="text">
                                            </div>
                                        </div>
                                    </div>
                                    
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