@foreach($blogs as $key=>$blog)
    <div id="article-parent">
        <div class="article-section">
            <div class="row">
                <div class='col-md-4'>
                    <img src="{{url('/images/'.$blog['imagesdetail']['path'])}}" class="img-responsive" />
                </div>
                <div class='col-md-8'>
                    <h1 class="title">{{ $blog['title'] }}</h1>
                    <b class="date">05 Maret 2019</b>
                </div>
            </div>
        </div>
    </div>
@endforeach