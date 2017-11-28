
<div style="overflow-x:scroll">
<table border="1px"  style="margin-top:30px;text-align:center;" class="table table-striped">
<th>Country</th>
<th>Service Name</th>
<th>Sub Service Name</th>
<th>Trademark Type</th>
<th>Trademark Sub Type</th>
<th>Recordal Type</th>
<th>Color Claim</th>
<th>Recordal Condition</th>
<th>Number Of Basic Classes</th>
<th>Additional Class</th>
<th>Professional Fees</th>
<th>Official Fees</th>
<th>Official Feees (Publication)</th>
<th>Professional Fees (Publication)</th>
<th>Taxes</th>
<th>Disbursements</th>
<th>Remarks</th>
<th>Single Stage Text</th>
<th>Multi Statge</th>
<th>Priority Claim</th>
<th>Transaction Cost</th>
<th>Official Feees (Extension)</th>
<th>Professional Fees (Extension)</th>
<th>Late Official Fees</th>
<th>Late Professional Fees</th>
<th>Official Feees (Affidavit)</th>
<th>Professional Fees (Affidavit)</th>
<th>Total Fees</th>




@if(count($costcenters)>0)
	@foreach($costcenters as $costcenter)
		<tr>
			@if($costcenter->country)
				<td>{{$costcenter->country}}</td>
			@else
				<td></td>
			
			@endif

			@if($costcenter->servicename)
				<td>{{$costcenter->servicename}}</td>
			@else
				<td></td>
			
			@endif
			
			@if($costcenter->subservice_name)
				<td>{{$costcenter->subservice_name}}</td>
			@else
				<td></td>
			@endif
			
			@if($costcenter->type_name)
				<td>{{$costcenter->type_name}}</td>
			@else
				<td></td>		
			@endif

			@if($costcenter->sub_type_name)
				<td>{{$costcenter->sub_type_name}}</td>
			@else
				<td></td>
			@endif
			
			@if($costcenter->nestedservicename)
				<td>{{$costcenter->nestedservicename}}</td>
			@else
				<td></td>
			@endif

			@if($costcenter->color_claim)
				<td>{{$costcenter->color_claim}}</td>
			@else
				<td></td>
			@endif

			@if($costcenter->recordal_condition)
				<td>{{$costcenter->recordal_condition}}</td>
			@else
				<td></td>
			@endif
			
			@if($costcenter->numberofbasicclass)
				<td>{{$costcenter->numberofbasicclass}}</td>
			@else
				<td></td>
			@endif

			@if($costcenter->additionalclass)
				<td>{{$costcenter->additionalclass}}</td>
			@else
				<td></td>
			@endif

			@if($costcenter->professionalfees!="")
			
				<td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
				
				{{$costcenter->professionalfees}}</td>
			
			@else
			<td></td>
			@endif

			@if($costcenter->officialfees!="")
			 <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
				{{$costcenter->officialfees}}</td>
			@else
				<td></td>
			@endif

			@if($costcenter->publication_officialfees!="")
			<td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
			{{$costcenter->publication_officialfees}}</td>
			
			@else
				<td></td>
			@endif

			@if($costcenter->publication_professionalfees!="")
			<td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
				{{$costcenter->publication_professionalfees}}</td>
			
			@else
				<td></td>
			@endif
				
				
			@if($costcenter->taxes!="")
			<td>@if($costcenter->currency=="EURO")&euro;@else $ @endif		
				{{$costcenter->taxes}}</td>
			@else
				<td></td>
			@endif
			
			@if($costcenter->disbursements)
				<td>{{$costcenter->disbursements}}</td>
			@else
				<td></td>
			@endif

			@if($costcenter->remarks)
				<td>{{$costcenter->remarks}}</td>
			@else
				<td></td>		
			@endif
			
			@if($costcenter->singlestagetext)
				<td>{{$costcenter->singlestagetext}}</td>
			@else
				<td></td>		
			
			@endif

			@if($costcenter->multistage)
				<td>{{$costcenter->multistage}}</td>
			@else
				<td></td>		
			
			@endif

			
			@if($costcenter->priorityclaim)
				<td>{{$costcenter->priorityclaim}}</td>
			@else
				<td></td>
			@endif


			@if($costcenter->transactioncost!="")
				<td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
				{{$costcenter->transactioncost}}</td>
			@else
				<td></td>
			@endif

			@if($costcenter->extension_officialfees!="")
				 <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
				 {{$costcenter->extension_officialfees}}</td>
			@else
				<td></td>
			@endif

			@if($costcenter->extension_professionalfees!="")
				 <td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
				 {{$costcenter->extension_professionalfees}}</td>
			@else
				<td></td>
			@endif


			@if($costcenter->lateofficialfees!="")
				<td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
				{{$costcenter->lateofficialfees}}</td>
			@else
				<td></td>

			@endif

			@if($costcenter->lateprofessionalfees!="")
				<td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
				{{$costcenter->lateprofessionalfees}}</td>
			@else
				<td></td>

			@endif


			
			@if($costcenter->affidavit_officialfees!="")
				<td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
				{{$costcenter->affidavit_officialfees}}</td>
			@else
				<td></td>

			@endif

				
			@if($costcenter->affidavit_professionalfees!="")
				<td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
				{{$costcenter->affidavit_professionalfees}}</td>
			@else
				<td></td>

			@endif

			@if($costcenter->totalfees!="")
				<td>@if($costcenter->currency=="EURO")&euro;@else $ @endif
				{{$costcenter->totalfees}}</td>
			@else
				<td></td>

			@endif



	</tr>	
	@endforeach
	
	
	

@endif
</table>
</div>


<a href="{{url('cost/add/'.$contact->id )}}" class="btn btn-success">Add Cost</a>



