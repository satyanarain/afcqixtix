@extends('layouts.master')
@section('heading')
	@lang('costcenter.trademark.title')
@stop

@section('content')
<script>
function test(id)
{

    var id=$(id).attr('id');


   $('#'+id).show(); 
        
}
function Close(id)
{
    $('#'+id).hide();    
}

</script>
<style>
.trademark_popup{
  position:absolute;
    z-index: 100;
    left:5%;
    top:5%;   
    height:700px;
    width:90%;
/*    border-radius: 7px;*/
   
    margin:30px auto 0;
    padding-left:500px; 
    padding-right: 300px;
    padding-top:10px;
   
    z-index: 1001;
  -moz-opacity: 0.8;
 
  border: 16px solid orange;
  background-color: white;

  overflow: auto;

  line-height: 30px;

    }
  .headingbold{
    font-weight: bold;
  }
</style>


@foreach($costcenters as $costcenter)

<div class="trademark_popup"  id="{{ $costcenter->id }}" style="display:none;">     
<table width="100%">
            <tr>
                <td class="headingbold"></td><div onclick="Close({{$costcenter->id}})" class="headingbold_close pull-right">X</div> </td>  
            </tr>
            <tr>    
                <td><caption style="padding-left:10%;"><h3>Cost Center Details (Trademark)</h3></caption> </td>
            </tr>
            <tr>
            @if($costcenter->servicename!="")        
                <th>Service</th>
                <td>{{ $costcenter->servicename}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->subservice_name!="")        
                <th>Sub Service</th>
                <td>{{ $costcenter->subservice_name}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->type_name)        
                <th>Trademark Type</th>
                <td>{{ $costcenter->type_name}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->sub_type_name!="")        
                <th>Trademark Sub Type</th>
                <td>{{$costcenter->sub_type_name}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->nestedservicename!="")        
                <th>Recordal Type</th>
                <td>{{$costcenter->nestedservicename}}</td>
            @endif    
            </tr>
            
            <tr>
            @if($costcenter->country_name!="")        
                <th>Country</th>
                <td>{{ $costcenter->country_name}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->color_claim!="")        
                <th>Color Claim</th>
                <td>{{ $costcenter->color_claim}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->recordal_condition!="")        
                <th>Recordal Condition</th>
                <td>{{ $costcenter->recordal_condition}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->numberofbasicclass!="")        
                <th>Number Of Basic Class</th>
                <td>{{ $costcenter->numberofbasicclass}}</td>
            @endif    
            </tr>
             <tr>
            @if($costcenter->additionalclass!="")        
                <th>Additional Class</th>
                <td>{{ $costcenter->additionalclass}}</td>
            @endif    
            </tr>
            
            <tr>
            @if($costcenter->disbursements!="")        
                <th>Disbursements</th>
                <td>{{ $costcenter->disbursements}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->remarks!="")        
                <th>Remarks</th>
                <td>{{ $costcenter->remarks}}</td>
            @endif    
            </tr>
            
            <tr>
            @if($costcenter->singlestagetext!="")        
                <th>Single Stage Text</th>
                <td>{{ $costcenter->singlestagetext}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->multistage!="")        
                <th>Multistage</th>
                <td>{{ $costcenter->multistage}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->priorityclaim!="")        
                <th>Priority Claim</th>
                <td>{{ $costcenter->priorityclaim}}</td>
            @endif    
            </tr>
                        <tr>
            @if($costcenter->taxes!="")        
                <th>Taxes</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{ $costcenter->taxes}}</td>
            @endif    
            </tr>
	
	   <tr>
            @if($costcenter->publication_officialfees!="")        
                <th>Official Fees (Publication)</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{$costcenter->publication_officialfees}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->publication_professionalfees!="")        
                <th>Professional Fees (Publication)</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{$costcenter->publication_professionalfees}}</td>
            @endif    
            </tr>	
		
            <tr>
            @if($costcenter->officialfees!="")        
                <th>Official Fees</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{ $costcenter->officialfees}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->professionalfees!="")        
                <th>Professional Fees</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{ $costcenter->professionalfees}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->transactioncost!="")        
                <th>Transaction Cost</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{ $costcenter->transactioncost}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->extension_officialfees!="")        
                <th>Official Fees (Extension)</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{ $costcenter->extension_officialfees}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->extension_professionalfees!="")        
                <th>Professional Fees (Extension)</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{ $costcenter->extension_professionalfees}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->lateofficialfees!="")        
                <th>Late Official Fees</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{ $costcenter->lateofficialfees}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->lateprofessionalfees!="")        
                <th>Late Professional Fees</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{ $costcenter->lateprofessionalfees}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->affidavit_officialfees!="")        
                <th>Official Fees (Affidavit)</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{ $costcenter->affidavit_officialfees}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->affidavit_professionalfees!="")        
                <th>Professional Fees (Affidavit)</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{ $costcenter->affidavit_professionalfees}}</td>
            @endif    
            </tr>
            <tr>
            @if($costcenter->totalfees!="")        
                <th>Total Fees</th>
                <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif{{ $costcenter->totalfees}}</td>
            @endif    
            </tr>
            
</table>        
    
</div>
@endforeach

   <table  width="100%" >
         <tr>	
            <th align="right"> <a href="{{ route('cost.add',Auth::id())}}"><button class="btn btn-primary pull-right-button">Add Cost</button></a></th>               
          </tr>  
         <tr>
            <th align="right" height="10">&nbsp; </th>               
        </tr>
    </table>
   <table class="table table-hover " id="users-table">
        <thead>
            <tr>
                <th>@lang('costcenter.trademark.subservice_name')</th>
                <th>@lang('costcenter.trademark.country')</th>
		<th></th>
            </tr>
        </thead>
    </table>
  
@stop

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('cost.data') !!}',
        columns: [
            { data: 'subservice_name', name: 'subservice_name' },
            { data: 'country_name', name: 'country_name' },
            { data: 'view', name: 'view' },
      
        ]
    });
});
</script>
@endpush
