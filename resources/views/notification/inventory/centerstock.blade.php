@extends('layouts.master')
@section('header')
<h1>Manage Inventory Notification</h1>
<ol class="breadcrumb">
	<li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#" class="active">Inventory Notification</a></li>
</ol>
@stop
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body">
				<h3>Central stock <button class="btn btn-afcs pull-right" id="manageCenterStock"><span class="fa fa-plus"></span> Add</button></h3>

				<table class="table" id="example1">
					<thead>
						<tr>
							<th>Invenory Type</th>
							<th>Denomination</th>
							<th>Min Stock</th>
							<th>Notify to</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($centerStockSettings as $setting)
						<tr>
							<td>{{$setting->item_id}}</td>
							<td>{{$setting->denom}}</td>
							<td>{{$setting->min_stock}}</td>
							<td>
								@foreach($setting->notify_to as $key=>$admin)
								@if($key == 0)
								{{$admin->name.' ('.$admin->email.')'}}
								@else
								{{', '.$admin->name.' ('.$admin->email.')'}}
								@endif
								@endforeach
							</td>
							<td><a href="" onclick="openEditModal(event, {{$setting->id}});"><span class="fa fa-edit"></span></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>  
	</div>
</div>  
<div class="row">
	<div class="col-xs-12">
		<!-- Add center stock settings modal -->
		<div class="modal fade" id="centerStockNotificationModal" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Center stock notification details</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="inventorytype" class="label-control">Inventory Type</label>
									<select id="inventorytype" class="form-control">
									</select>
								</div>

								<div class="form-group" id="denomsBox">
									<label for="denoms" class="label-control">Denominations</label>
									<select id="denoms" class="form-control">
									</select>
								</div>

								<div class="form-group">
									<label for="minlevel">Min Stock</label>
									<input type="text" id="minlevel" name="minlevel" onkeypress="return numvalidate(event)" class="form-control">
								</div>

								<div class="form-group">
									<label for="notifyto">Notify to</label>
									<select id="notifyto" multiple class="form-control">
									</select>
								</div>
								<div class="form-group">
									<span id="error" class="label label-danger"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-success" id="saveSetting" data-id="">Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('partials.bustypes_order_header')
@include('partials.table_script_order')
@stop

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){

	$(document).on('change', '#inventorytype', function(){
		var itemId = $(this).val();

		if(itemId)
		{
			var url = "{{route('notification.inventory.checkifitemhasseries', ':itemId')}}";
			url = url.replace(':itemId', itemId);
			$.ajax({
				url: url,
				type:"GET",
				dataType: "JSON",
				success: function(response, statusText, xhr)
				{
					var check = response.data;
					if(check)
						$('#denomsBox').show();
					else
						$('#denomsBox').hide();
				},
				error: function(xhr, statusText, errorThrown)
				{
					console.log(statusText);
					console.log(errorThrown);
				}
			});
		}else{
			return alert('Please select an item.');
		}
	});

	//center stock js
	$(document).on('click', '#manageCenterStock', function(){
		$.ajax({
			url: "{{route('notification.inventory.getitemsandadmins')}}",
			type:"GET",
			dataType: "JSON",
			success: function(response)
			{
				var items = response.items;
				var admins = response.admins;
				var denoms = response.denoms;
				if(items.length > 0)
				{
					var itemsString = "<option value=''>Please select an item</option>";
					$.each(items, function(index, item){
						itemsString += '<option value='+item.id+'>'+item.name+'</option>';
					});

					$('#inventorytype').html(itemsString);
				}

				if(admins.length > 0)
				{
					var adminsString = "";//"<option value=''>Please select who to notify</option>";
					$.each(admins, function(index, admin){
						adminsString += '<option value='+admin.id+'>'+admin.name+" ("+admin.email+")"+'</option>';
					});

					$('#notifyto').html(adminsString);
				}

				if(denoms.length > 0)
				{
					var denomsString = "<option value=''>Please select a denomination</option>";
					$.each(denoms, function(index, denom){
						denomsString += '<option value='+denom.id+'>'+denom.description+'</option>';
					});

					$('#denoms').html(denomsString);
				}

				$('#centerStockNotificationModal').modal('show');
			},
			error: function(error)
			{
				console.log(error);
			}
		});
	});

	$(document).on('click', '#saveSetting', function(){
		var item = $('#inventorytype').val();
		if(!item)
		{
			return alert('Please select an item');
		}

		var minlevel = $('#minlevel').val();
		if(!minlevel)
		{
			return alert('Please enter min stock');
		}

		var notifyto = $('#notifyto').val();
		console.log(notifyto);
		if(!notifyto)
		{
			return alert('Please select who to notify');
		}

		var denoms = $('#denoms').val();

		var dataId = $('#saveSetting').data('id');
		var url = "";
		if(!dataId)
		{
			var data = {
				item: item,
				minlevel: minlevel,
				notifyto: notifyto,
				denoms: denoms
			};
			url = "{{route('notification.inventory.centerstock.store')}}";
		}else {
			var data = {
				item: item,
				denoms: denoms,
				minlevel: minlevel,
				notifyto: notifyto,
				dataId: dataId,
				_method: 'PATCH'
			};

			url = "{{route('notification.inventory.centerstock.update', ':id')}}";
			url = url.replace(':id', dataId);
		}

		

		$.ajax({
			url: url,
			type:"POST",
			dataType: "JSON",
			data:data,
			success: function(response)
			{
				if(response.errorCode == 'ALREADY_ADDED')
				{
					$('#error').html('Item settings already added.').show();
				}
				if(response.status == 'Ok')
				{
					window.location.reload();
				}
			},
			error: function(error)
			{
				console.log(error);
			}
		});

	});
});

	function openEditModal(event, itemId)
	{
		event.preventDefault();
		var id = itemId;
		if(!id)
		{
			return alert('Invalid item ID.');
		}
		var data = {
			id: id
		};
		var url = "{{route('notification.inventory.centerstock.edit', ':id')}}";
		console.log(url);
		url = url.replace(':id', id);
		$.ajax({
			url: url,
			type:"GET",
			dataType: "JSON",
			data:data,
			success: function(response)
			{
				if(response.status == 'Ok')
				{
					var settings = response.settings;
					var items = response.items;
					var admins = response.admins;
					var denoms = response.denoms;
					if(items.length > 0)
					{
						var itemsString = "<option value=''>Please select an item</option>";
						$.each(items, function(index, item){
							itemsString += '<option value='+item.id+'>'+item.name+'</option>';
						});

						$('#inventorytype').html(itemsString);
					}

					if(admins.length > 0)
					{
						var adminsString = "";//"<option value=''>Please select who to notify</option>";
						$.each(admins, function(index, admin){
							if($.inArray(admin.id, selectedOptions) !== -1)
							{
								adminsString += '<option value='+admin.id+' selected>'+admin.name+" ("+admin.email+")"+'</option>';
							}else{
								adminsString += '<option value='+admin.id+'>'+admin.name+" ("+admin.email+")"+'</option>';
							}
							
						});

						$('#notifyto').html(adminsString);
					}

					if(denoms.length > 0)
					{
						var selectedDenom = settings.denom_id;
						var denomsString = "<option value=''>Please select a denomination</option>";
						$.each(denoms, function(index, denom){
							if(denom.id == selectedDenom)
							{
								denomsString += '<option value='+denom.id+' selected>'+denom.description+'</option>';
							}else{
								denomsString += '<option value='+denom.id+'>'+denom.description+'</option>';
							}
							
						});

						$('#denoms').html(denomsString).attr('disabled', true);
					}
					var selectedOptions = response.selectedOptions;
					$('#inventorytype').val(settings.item_id).attr('disabled', true);
					$('#minlevel').val(settings.min_stock);
					$('#notifyto').val(selectedOptions);
					$('#saveSetting').attr('data-id', settings.id);
					$('#centerStockNotificationModal').modal('show');
				}
			},
			error: function(error)
			{
				console.log(error);
			}
		});
	}
</script>
@endpush