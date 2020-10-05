@extends('../../../templatefrontend')


@section('content')

    <script>
        var clicked = false
        $(document).ready(function() {

            $(".btn-panel").click(function(event) {
                event.preventDefault();
                $(".panel-table").slideToggle("slow");
                if (clicked == false) {
                    $(".text").text(" Sembunyikan Rincian")
                    $("i.fa.fa-chevron-down").hide()
                    $("i.fa.fa-chevron-up").show()
                    clicked = true
                } else {
                    $(".text").text(" Lihat Rincian")
                    $("i.fa.fa-chevron-down").show()
                    $("i.fa.fa-chevron-up").hide()
                    clicked = false
                }
            });
        })
    </script>
    <style type="text/css">
        .big-hero {
            height: calc(100vh - 60px);
            background: url("{{url('frontend/assets')}}/images/404_bg.png") top center no-repeat fixed;
            background-size: cover;
            position: relative;
            margin-bottom: 0;
            border-bottom: none;
        }
    </style>

    <img src="{{url('frontend/assets')}}/images/404_bg.png " class="img-responsive">
    <!-- <div class="big-hero"></div> -->

    @endsection