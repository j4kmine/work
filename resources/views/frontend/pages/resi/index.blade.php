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

    

<h1 class="text-center title-page">Lacak Kiriman</h1>
<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class=" box-top-new ">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input id="dimensi" type="text" class="form-control" name="noresi" placeholder="Nomor Resi">
                            <span class="input-group-addon group-addon-resi">  <button  class="btn btn-cek"><b>Lacak</b></button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br/>
    <br/>
    <div class="widget-resi">
        <div class="header-resi">
            <h4>EXP12345678TD</h4>
        </div>
        <div class="body-resi">

            <ul>

                <li>
                    <hr/>
                    <img src="{{url('frontend/assets')}}/images/document.png" />
                    <h4>Document Handling</h4>
                </li>
                <li>
                    <hr/>
                    <img src="{{url('frontend/assets')}}/images/collected.png" />
                    <h4>Collected</h4>
                </li>
                <li>
                    <hr/>
                    <img src="{{url('frontend/assets')}}/images/delivering.png" />
                    <h4>Delivering</h4>
                </li>
                <li>
                    <hr/>
                    <img src="{{url('frontend/assets')}}/images/delivered.png" />
                    <h4>Delivered</h4>
                </li>
            </ul>
        </div>
        <div class="footer-resi">
            <h4><a class="btn-panel" href="#"><i class="fa fa-chevron-down"></i> <i class="fa fa-chevron-up" style="display: none;"></i> <span class="text">Lihat Rincian</span></a></h4>
        </div>
        <div class="panel-table">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Local Time</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>08/03/2020, 20:15</td>
                        <td>Jakarta, Indonesia</td>
                        <td>Shipment delivered in good condition</td>
                    </tr>
                    <tr>
                        <td>08/03/2020, 20:15</td>
                        <td>Jakarta, Indonesia</td>
                        <td>Shipment delivered in good condition</td>
                    </tr>
                    <tr>
                        <td>08/03/2020, 20:15</td>
                        <td>Jakarta, Indonesia</td>
                        <td>Shipment delivered in good condition</td>
                    </tr>
                    <tr>
                        <td>08/03/2020, 20:15</td>
                        <td>Jakarta, Indonesia</td>
                        <td>Shipment delivered in good condition</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<br/>
<br/>
@endsection