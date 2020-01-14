<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Tell Me">
    <meta name="keyword" content="Tell Me, reating">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('img/faviconx.png')}}">
    <title>Tell Me -  Control Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />
    <link href="{{asset('css/tasks.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/gallery.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('assets/gritter/css/jquery.gritter.css')}}" />
    <link href="{{asset('assets/advanced-datatable/media/css/demo_page.css')}}" rel="stylesheet" />
    {{--<link href="{{asset('assets/advanced-datatable/media/css/demo_table.css')}}" rel="stylesheet" />--}}
    <link rel="stylesheet" href="{{asset('assets/data-tables/DT_bootstrap.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap-fileupload/bootstrap-fileupload.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/colorpicker/css/bootstrap-colorpicker.min.css')}}" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
   
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <section id="container" >
      <!--header start-->
      
      @include('layouts.header')
      <!--header end-->
      <!--sidebar start-->
       @include('layouts.sidebar')
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              @yield('content')
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      @include('layouts.footer')
      
      <!--footer end-->
  </section>

    
  <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script class="include" type="text/javascript" src="{{asset('js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.sparkline.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js')}}"></script>
    <script src="{{asset('js/owl.carousel.js')}}" ></script>
    <script src="{{asset('js/jquery.customSelect.min.js')}}" ></script>
    <script src="{{asset('js/respond.min.js')}}" ></script>

    <!--right slidebar-->
    <script src="{{asset('js/slidebars.min.js')}}"></script>

    <!--common script for all pages-->
    <script src="{{asset('js/common-scripts.js')}}"></script>

    <!--script for this page-->
    <script src="{{asset('js/sparkline-chart.js')}}"></script>
    <script src="{{asset('js/easy-pie-chart.js')}}"></script>
    <script src="{{asset('js/count.js')}}"></script>
     <script class="include" type="text/javascript" src="{{asset('js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
     <script type="text/javascript" language="javascript" src="{{asset('assets/advanced-datatable/media/js/jquery.dataTables.js')}}"></script>
 <script type="text/javascript" src="{{asset('assets/data-tables/DT_bootstrap.js')}}"></script>
  <script src="{{asset('js/dynamic_table_init.js')}}"></script>
  <script src="{{asset('js/respond.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
 <script src="{{asset('js/gritter.js')}}" type="text/javascript"></script>
     <script type="text/javascript" src="{{asset('assets/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
     <script type="text/javascript" src="{{asset('assets/colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
     <script src="{{asset('js/pickers/init-color-picker.js')}}"></script>
     <script src="{{asset('assets/fancybox/source/jquery.fancybox.js')}}"></script>
     <script src="{{asset('js/modernizr.custom.js')}}"></script>
    <script src="{{asset('js/toucheffects.js')}}"></script>
        <script src="{{asset('assets/jquery-knob/js/jquery.knob.js')}}"></script><!-- 
         <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
       
    <script type="text/javascript" charset="utf-8">
       $(document).ready(function() {
              $("#commentForm").validate();
          } );
    </script>
  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
              autoPlay:true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
        function onDeleteCat(){
            $.get("companiesservlet?did="+$('#catidh').val(),function(data,status){
                 location.reload();
            });
          }
          
          function onClickDeleteCat(catid){
            $('#catidh').val(catid);
          }
  </script>
  <script type="text/javascript" charset="utf-8">
       $(document).ready(function() {
              $("#commentForm").validate();
          } );
    </script>
    <script type="text/javascript">
     $(document).ready(function(){
    $('#question_type').change(function(){
            
      if($(this).val() !== '')
      {
        var value     = $(this).val();
          
           var url ="{{route('getView')}}";
             
        $.ajax({
          url:"{{route('getView')}}",
          method:"GET",
          data:{value:value},
          success:function(result){
            
            $('#1').html(result);
          }
        });
       
      }
    });
   
      if($('#question_type').val() !== '')
        {
          var value     = $("#question_type").val();
          var url ="{{route('getView')}}";     
          $.ajax({
            url:"{{route('getView')}}",
            method:"GET",
            data:{value:value},
            success:function(result){
              
              $('#1').html(result);
            }
          });
         
        }
      
 });

</script>
<script>

      //knob
      $(".knob").knob();

  </script>
<script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>
  <script>
//       $(document).ready(function() {
//               $('#dynamic-table').dataTable( {
//                   "aaSorting": [[ 5, "desc" ]]
//               } );

// }


  </script>

  @yield('js')
  </body>
</html>
