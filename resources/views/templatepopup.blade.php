<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- CSRF Token -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{url('assets/img/basic/favicon.ico')}}" type="image/x-icon">
    <title>Paper</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{url('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/jquery.fancybox.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
</head>
<style>
    .thumb-list{
        width: 300px;
    }
</style>
<body>
<!-- Pre loader -->
@include('cms.layouts.loader')
<div id="">

    <div class="container-fluid  animatedParent animateOnce p-0">
        @yield('content')
    </div>
<!-- Right Sidebar -->

<!-- /.right-sidebar -->
<!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->

</div>
<!--/#app -->
<!-- Scripts -->
<script src="{{url('assets/js/app.js')}}"></script>
<script src="{{url('assets/js/jquery.fancybox.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
function selectimage(id,path,title){
    parent.selectimage(id,path,title);
    parent.jQuery.fancybox.close();
}   
function selectimagetinymce(id,path,title){
    parent.selectimagetinymce(id,path,title);
    parent.jQuery.fancybox.close();
}   
$(document).ready(function(){
    $('.pagination>li').addClass("page-item");
    $('.pagination>li>a').addClass("page-link");
    $('.pagination>li>span').addClass("page-link");
    

});
$(document).ready(function(){
    var oFReader = null;
    var image = null;
    var globalResizedWidth = '400px';
    var globalWidth, globalHeight;

    /* INIT */
    $('.image_block').remove();
    $("#uploadImage").val("");

    $("#uploadImage").change(function(){
        $(this).parent().find(".image_block").remove();
        $.when( previewElement(this) ).done( previewImage(this) );
    });

    function previewElement(obj) {
        var html = '<div class="image_block">';
        html += '<br><img class="image_preview" style="width:'+globalResizedWidth+'px" />';
        html += '</div>';
        $(obj).after(html);
    }

    function previewImage(obj) {
        if(oFReader !=null){
            oFReader = null;
        }

        var max_width = 9024;
        var objFile = obj.files[0];
        var max_foto_mb = 2;
        var max_foto_byte = parseInt(max_foto_mb)*1048576; //convert MB to Byte
        if(objFile.size > max_foto_byte ) {
            $(obj).parent().find(".image_block").remove();
            $(obj).val("");
        
            $('.image_block').remove();
            $("#uploadImage").val("");
        } else {
            // prepare HTML5 FileReader
            oFReader = new FileReader();
            image  = new Image();
            oFReader.readAsDataURL(objFile);
            
            oFReader.onload = function (_file) {
                image.src    = _file.target.result;
                image.onload = function() {
                        globalWidth = this.width;
                        globalHeight = this.height;
                        
                        $(obj).parent().find(".image_preview").attr("src", this.src);

                        if(globalWidth > max_width) {
                                $(obj).parent().find(".image_block").remove();
                                $(obj).val("");
                                alert("label_error_ukuran");
                        }
                };

                image.onerror= function() {
                    alert('Invalid file type: '+ objFile.type);
                };     
                
            }
        }
    }

    function getExtension(filename) {
        return filename.split('.').pop().toLowerCase();
    }
  
  
})
</script>
</body>
</html>