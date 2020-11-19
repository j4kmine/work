<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title>Paper</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{url('assets/css/app.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
    @media (min-width: 1031px){
    
        .parallel {
            overflow: scroll;
            position: relative;
        }
    }
    </style>

</head>
<body class="light sidebar-mini sidebar-collapse">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
<div class="page parallel">
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
                    <form method="post" action="{{ route('doregister') }}">
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Register User  </h5>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary btn-sm " href="{{url('login')}}">Login</a>
                                    </div>
                                </div>
                               
                               
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 m-0">
                                                <label for="name" class="col-form-label s-12">FISRT NAME</label>
                                                <input id="name" placeholder="Enter User Name" name="name" value="{{ old('name') }}" class="form-control r-0 light s-12 " type="text" required>
                                            </div>
                                            <div class="form-group col-md-6 m-0">
                                                <label for="lastname" class="col-form-label s-12">LAST NAME</label>
                                                <input id="lastname" placeholder="Enter User lastname" name="lastname" value="{{ old('lastname') }}" class="form-control r-0 light s-12 " type="text" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 m-0">
                                                <label for="cnic" class="col-form-label s-12"><i class="icon-lock3"></i>PASSWORD</label>
                                                <input id="cnic" name="password" placeholder="*****" class="form-control r-0 light s-12 " type="password" required>
                                            </div>
                                            <div class="form-group col-md-6 m-0">
                                                <label for="dob" class="col-form-label s-12"><i class="icon-lock3"></i>CONFIRM PASSWORD</label>
                                                <input id="dob" placeholder="*****" class="form-control r-0 light s-12" name="password_confirmation"
                                                     type="password" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mt-1">
                                    <div class="form-group col-md-6 m-0">
                                        <label for="email" class="col-form-label s-12"><i class="icon-envelope-o mr-2"></i>Email</label>
                                        <input id="email" placeholder="user@email.com" name="email" value="{{ old('email') }}" class="form-control r-0 light s-12 " type="text" required>
                                    </div>

                                    <div class="form-group col-md-6 m-0">
                                        <label for="phone" class="col-form-label s-12"><i class="icon-phone mr-2"></i>Phone</label>
                                        <input id="phone" placeholder="05112345678" name="phone" value="{{ old('phone') }}" class="form-control r-0 light s-12 " type="text" required>
                                    </div>
                                    
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 m-0">
                                        <label for="datebirth" class="col-form-label s-12">Datebirth</label>
                                        <input id="datebirth" placeholder="2011-01-01" name="datebirth" value="{{ old('datebirth') }}" class="form-control r-0 light s-12 " type="text" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6 m-0">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Gender</label>
                                        <select name ="gender" class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" id="inlineFormCustomSelectPref">
                                            <option value="1" {{ old('gender')=='1' ? 'selected' : ''  }}>Male</option>
                                            <option value="2" {{ old('gender')=='2' ? 'selected' : ''  }}>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12 m-0">
                                        <label for="address"  class="col-form-label s-12">Address</label>
                                        <textarea type="text" name="address"   rows="5" class="form-control r-0 light s-12" id="address"
                                               placeholder="Enter Address" required>{{ old('address') }}</textarea>
                                    </div>
                                </div>
                                
                            </div>
                            <hr>
                            <div class="card-body">
                                <h5 class="card-title">Detail Membership</h5>
                                <div class="form-row">
                                    <div class="form-group col-6 m-0">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Membership Type</label>
                                        <select class="js-example-basic-single" name="membershiptype">
                                            <option value="Silver" {{ old('membershiptype')=='Silver' ? 'selected' : ''  }}>Silver</option>
                                            <option value="Gold" {{ old('membershiptype')=='Gold' ? 'selected' : ''  }}>Gold</option>
                                            <option value="Platinum" {{ old('membershiptype')=='Platinum' ? 'selected' : ''  }}>Platinum</option>
                                            <option value="Black" {{ old('membershiptype')=='Black' ? 'selected' : ''  }}>Black</option>
                                            <option value="VIP" {{ old('membershiptype')=='VIP' ? 'selected' : ''  }}>VIP</option>
                                            <option value="VVIP" {{ old('membershiptype')=='VVIP' ? 'selected' : ''  }}>VVIP</option>
                                          </select>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="form-group col-md-6 m-0">
                                        <label for="membershifee" class="col-form-label s-12">Membership Fee</label>
                                        <input id="membershifee"  name="membershifee" value="{{ old('membershifee') }}" class="form-control r-0 light s-12 " type="text" required readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <h5 class="card-title">Payment</h5>
                                <div class="form-row">
                                    <div class="form-group col-6 m-0">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Card Type</label>
                                        <select name ="cctype" class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" id="inlineFormCustomSelectPref">
                                            <option value="1" {{ old('cctype')=='1' ? 'selected' : ''  }}>Master</option>
                                            <option value="2" {{ old('cctype')=='2' ? 'selected' : ''  }}>Visa</option>
                                        </select>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="form-group col-md-6 m-0">
                                        <label for="ccnumber" class="col-form-label s-12">Card Number</label>
                                        <input id="ccnumber"  name="ccnumber" placeholder="1291281928192.." value="{{ old('ccnumber') }}" class="form-control r-0 light s-12 " type="text" required >
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="form-group col-md-6 m-0">
                                        <label for="ccexpiremonth" class="col-form-label s-12">Expired Month</label>
                                        <input id="ccexpiremonth"  placeholder="September" name="ccexpiremonth" value="{{ old('ccexpiremonth') }}" class="form-control r-0 light s-12 " type="text" required >
                                    </div>
                                </div>
                                <br/>
                                <div class="form-row">
                                    <div class="form-group col-md-6 m-0">
                                        <label for="ccexpireyear" class="col-form-label s-12">Expired Year</label>
                                        <input id="ccexpireyear"  placeholder="2009" name="ccexpireyear" value="{{ old('ccexpireyear') }}" class="form-control r-0 light s-12 " type="text" required >
                                    </div>
                                </div>
                                <br/>
                                <br/>
                                <div class="form-rowe">
                                    
                                    <div class="form-group col-md-6 m-0">
                                        <input class="form-check-input" type="checkbox" id="tos" name="tos">
                                        <label class="form-check-label" for="inlineCheckbox1">Agree to term of service</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Save Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            
        </div>
        <div class="control-sidebar-bg shadow white fixed"></div>
</div>
<!--/#app -->
<script src="{{url('assets/js/app.js')}}"></script>
<script>
$(document).ready(function() {
        var old = 0
        var membership = "Silver";
        $( "#datebirth" ).datepicker({
        onSelect: function(dateText) {
            var old = getAge(dateText)
           
        }
    });
    $('.js-example-basic-single').select2();
    $('.js-example-basic-single').on('change', function() {
        membership = this.value 
        getmembershipfee(old,membership)
    });
    function getmembershipfee(age,membership){
        if(membership  == "Silver"){
            if(age > 17){
                $("#membershifee").val("100.000, IDR Free VAT")
            }else{
                $("#membershifee").val("100.000, IDR")
            }
        
        }else  if(membership  == "Gold"){
            if(age > 20){
                $("#membershifee").val("200.000, IDR Free VAT")
            }else{
                $("#membershifee").val("200.000, IDR")
            }
        
        }else  if(membership  == "Platinum"){
            if(age > 22){
                $("#membershifee").val("300.000, IDR Free VAT")
            }else{
                $("#membershifee").val("300.000, IDR")
            }
        }else  if(membership  == "Black"){
            $("#membershifee").val("500.000, IDR (VAT 10%)")
        }else  if(membership  == "VIP"){
            $("#membershifee").val(" 1.000.000, IDR (VAT 10%)")
        }else  if(membership  == "VVIP"){
            $("#membershifee").val("2.000.000, IDR (VAT 10%)")
        }
    }
      
    
});

function getAge(dateString) {
  var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());

  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();

  var dob = new Date(dateString.substring(6,10),
                     dateString.substring(0,2)-1,                   
                     dateString.substring(3,5)                  
                     );

  var yearDob = dob.getYear();
  var monthDob = dob.getMonth();
  var dateDob = dob.getDate();
  var age = {};
  var ageString = "";
  var yearString = "";
  var monthString = "";
  var dayString = "";


  yearAge = yearNow - yearDob;

  if (monthNow >= monthDob)
    var monthAge = monthNow - monthDob;
  else {
    yearAge--;
    var monthAge = 12 + monthNow -monthDob;
  }

  if (dateNow >= dateDob)
    var dateAge = dateNow - dateDob;
  else {
    monthAge--;
    var dateAge = 31 + dateNow - dateDob;

    if (monthAge < 0) {
      monthAge = 11;
      yearAge--;
    }
  }

  age = {
      years: yearAge,
      months: monthAge,
      days: dateAge
      };

  if ( age.years > 1 ) yearString = " years";
  else yearString = " year";
  if ( age.months> 1 ) monthString = " months";
  else monthString = " month";
  if ( age.days > 1 ) dayString = " days";
  else dayString = " day";


  if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.years ;
  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = 1;
  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years ;
  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years ;
  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months ;
  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years ;
  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = 1;
  else ageString = 1;

  return ageString;
}
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</body>
</html>