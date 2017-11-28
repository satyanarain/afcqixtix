<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
        <!--Styles-->
        <style>
        .kipg-container{
        	    width: 40%;
    			margin: 0 auto;
    			padding: 25% 0%;
        }
        .kipg-select{
        	    width: 100% !important;
    			margin-bottom: 15px;
    			display: block !important;
        }
        .kipg-button{
        	width: 100%;
        }
        </style>
        <!-- Scripts -->
        <script type="text/javascript" src="{{ URL::asset('js/jquery-2.2.3.min.js') }}"></script>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <div class="container">
            
            	<div class="row kipg-container">
					<div class="col col-lg-12">             
		                <div class="form-group form-inline">
							<h3>{{Lang::get('user.headers.choose_company')}}</h3>
							{!!
							    Form::select('group_company_id',
							    $group_companies, null,
							    ['class' => 'form-control kipg-select', 'id'=> 'select_group_company']) !!}
							<a href="{{route('showdashboard')}}" class="btn btn-primary kipg-button">Submit</a>
		                </div>
		            </div>
		        </div>
            
        </div>
    </body>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   })
</script>
<script>
    $('#select_group_company').change(function(){
        $.ajax({
            url:'setcompanyidinsession',
            method:'post',
            data:{companyId:$(this).val()}

        });
    });

    $(function(){
        var companySelectDropdown = document.getElementById('select_group_company');
        $.ajax({
            url:'setcompanyidinsession',
            method:'post',
            data:{companyId:companySelectDropdown.value}
        });
    });
</script>
</html>


