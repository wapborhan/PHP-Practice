<?php 
use \Milon\Barcode\DNS1D;
use App\Shipment;
$d = new DNS1D();

?>
<style type="text/css">
	<!--
	
	.txt-align-left {
		text-align: left;
	}
	.txt-align-right {
		text-align: right;
	}
	.vertical-align-middle{
		vertical-align: middle;
	}
	
	-->
</style>

	
	@php
		$n = 0;
	@endphp
	@foreach ($shipments_ids as $orderId)
		@php
			$n++;
			$model = Shipment::where('id','=',$orderId)->first();
		@endphp

		<div class="page" style="padding-top:0px;">
			<div class="subpage">
				<table border="0" cellpadding="0" cellspacing="0" style="font-size:10px;font-family:Arial, Helvetica, sans-serif; ">
					<tr>
						<td>
							<table width="450px" border="0" cellpadding="0" cellspacing="0" style="font-size:16px;font-family:Arial, Helvetica, sans-serif;">
								<tr>
									<td height="21px" colspan="3" style="padding-left:5px; padding-bottom:5px;">
										<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td valign="middle" style="padding-left:5px; height: 90px;">

													@if(get_setting('system_logo_white') != null)
														<img src="{{ uploaded_asset(get_setting('system_logo_white')) }}">
													@else
														<img src="{{ static_asset('assets/img/logo.svg') }}">
													@endif
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="21px" colspan="3" style="border-top:#000000  1px solid;border-bottom:#000000 1px solid;">
										<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td width="81%" height="21px" valign="top">
													<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr>
															<td>
																<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
																	<tr>
																		<td style="padding-left:10px; font-size:14px; font-weight:bold; width:420px">
																			@if(get_setting('site_name')){{ get_setting('site_name').get_setting('site_motto') ?' | '.get_setting('site_motto'):'' }}{{ translate('Spotlayer Framework') }}@else{{ translate('Spotlayer Framework') }}@endif
																		</td>
																		<td nowrap="nowrap">
																			<span style="font-size:20px; font-weight:bold; padding-right:10px;">{{$model->code}}</span>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
														<tr>
															<td style="padding-left:10px;font-size: 14px;white-space: pre-line;word-wrap: break-word;max-width: 360px;">{{$model->reciver_address}}</td>
														</tr>
													</table>
													<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr>
															<td style="border-top: 1px solid #000000; border-bottom: 0px solid #000000;">
																<div style="margin-top:1px;">
																	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
																		<tr>
																			<td style="text-align: center; padding-top: 10px;" colspan="1">
																				@if ($model->amount_to_be_collected && $model->amount_to_be_collected  > 0)
																					<span style="font-size:16px; font-weight:bold; padding:10px;">{{translate('COD')}}: {{format_price($model->amount_to_be_collected)}}</span>
																					<br />
																				@endif
																				<span style="font-size:16px; font-weight:bold; margin-bottom:10px;padding: 2px;">
																					{{translate('Total Weight')}}: {{$model->total_weight}} {{translate('Kg')}}
																				</span>
																			</td>

																		</tr>
																		<tr>
																			<td style="padding-left: 2px; text-align: center">
																				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
																					<tr>
																						<td  style="text-align: center">
																							<br />
																								@if($model->barcode != null)
																									@php
																										echo '<img src="data:image/png;base64,' . $d->getBarcodePNG($model->barcode, "EAN13") . '" alt="barcode"   />';
																									@endphp
																								@endif
																							<br />
																						</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																		<tr>
																			<td colspan="2">
																				<span style="font-size:16px; font-weight:bold;">
																				<br />
																				{{translate('ID')}}: {{$model->id}} / {{$model->code}} / {{$model->total_weight}} {{translate('Kg')}} / {{$model->shipping_date}}
																				</span>
																			</td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
													<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr>
															<td style="padding:5px; font-size:12px;">
																<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
																	<tr>
																		<td style="font-size:12px;word-wrap: break-word;max-width: 360px;">
																			<span style="font-weight:bold;">{{translate('From')}}: </span>
																			{{$model->client->name}}<br />
																			{{$model->client_address}}
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:5px;border-top:#000000 1px solid;">
														<tr>
															<td style="padding:5px; font-size:12px; text-align:center">
																<span style="font-weight:bold; font-size: 14px;">{{translate('Contains')}}: </span>
																@php $i=0; @endphp
																@foreach(\App\PackageShipment::where('shipment_id',$model->id)->get() as $package)
																	@if ($i != 0 ), @endif{{$package->description}}
																	@php $i++; @endphp
																@endforeach
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
						<td valign="top" style="padding:0px;">
							<img src="{{ static_asset('assets/img/cut-line.gif') }}" alt="" />
						</td>

						<td style="padding-right:20px;">
							<table width="450px" border="0" cellpadding="0" cellspacing="0" style="font-size:16px;font-family:Arial, Helvetica, sans-serif;">
								<tr>
									<td height="21px" colspan="3" style="padding-left:5px; padding-bottom:5px;">
										<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td valign="middle" style="padding-left:5px; height: 90px;">

													@if(get_setting('system_logo_white') != null)
														<img src="{{ uploaded_asset(get_setting('system_logo_white')) }}">
													@else
														<img src="{{ static_asset('assets/img/logo.svg') }}">
													@endif
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td height="21px" colspan="3" style="border-top:#000000  1px solid;border-bottom:#000000 1px solid;">
										<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td width="81%" height="21px" valign="top">
													<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr>
															<td>
																<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
																	<tr>
																		<td style="padding-left:10px; font-size:14px; font-weight:bold; width:420px">
																			@if(get_setting('site_name')){{ get_setting('site_name').get_setting('site_motto') ?' | '.get_setting('site_motto'):'' }}{{ translate('Spotlayer Framework') }}@else{{ translate('Spotlayer Framework') }}@endif
																		</td>
																		<td nowrap="nowrap">
																			<span style="font-size:20px; font-weight:bold; padding-right:10px;">{{$model->code}}</span>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
														<tr>
															<td style="padding-left:10px;font-size: 14px;white-space: pre-line;word-wrap: break-word;max-width: 360px;">{{$model->reciver_address}}</td>
														</tr>
													</table>
													<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr>
															<td style="border-top: 1px solid #000000; border-bottom: 0px solid #000000;">
																<div style="margin-top:1px;">
																	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
																		<tr>
																			<td style="text-align: center; padding-top: 10px;" colspan="1">
																				@if ($model->amount_to_be_collected && $model->amount_to_be_collected  > 0)
																					<span style="font-size:16px; font-weight:bold; padding:10px;">{{translate('COD')}}: {{format_price($model->amount_to_be_collected)}}</span>
																					<br />
																				@endif
																				<span style="font-size:16px; font-weight:bold; margin-bottom:10px;padding: 2px;">
																					{{translate('Total Weight')}}: {{$model->total_weight}} {{translate('Kg')}}
																				</span>
																			</td>

																		</tr>
																		<tr>
																			<td style="padding-left: 2px; text-align: center">
																				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
																					<tr>
																						<td  style="text-align: center">
																							<br />
																								@if($model->barcode != null)
																									@php
																										echo '<img src="data:image/png;base64,' . $d->getBarcodePNG($model->barcode, "EAN13") . '" alt="barcode"   />';
																									@endphp
																								@endif
																							<br />
																						</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																		<tr>
																			<td colspan="2">
																				<span style="font-size:16px; font-weight:bold;">
																				<br />
																				{{translate('ID')}}: {{$model->id}} / {{$model->code}} / {{$model->total_weight}} {{translate('Kg')}} / {{$model->shipping_date}}
																				</span>
																			</td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
													<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
														<tr>
															<td style="padding:5px; font-size:12px;">
																<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
																	<tr>
																		<td style="font-size:12px;word-wrap: break-word;max-width: 360px;">
																			<span style="font-weight:bold;">{{translate('From')}}: </span>
																			{{$model->client->name}}<br />
																			{{$model->client_address}}
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:5px;border-top:#000000 1px solid;">
														<tr>
															<td style="padding:5px; font-size:12px; text-align:center">
																<span style="font-weight:bold; font-size: 14px;">{{translate('Contains')}}: </span>
																@php $i=0; @endphp
																@foreach(\App\PackageShipment::where('shipment_id',$model->id)->get() as $package)
																	@if ($i != 0 ), @endif{{$package->description}}
																	@php $i++; @endphp
																@endforeach
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</div>

		@if(count($shipments_ids) > $n)
			<div class="page" style="padding-top:0px;position:relative">
				<div class="subpage" style="position: absolute;top: -50px;">
					<table border="0" cellpadding="0" cellspacing="0" style="font-size:10px;font-family:Arial, Helvetica, sans-serif; ">
						<tr>
							<td valign="top" style="padding:0px;">
								<img src="{{ static_asset('assets/img/cut-hr-line.gif') }}" alt="" />
							</td>
							<td valign="top" style="min-width:40px;">
							</td>
							<td valign="top" style="padding:0px;">
								<img src="{{ static_asset('assets/img/cut-hr-line.gif') }}" alt="" />
							</td>
						</tr>
					</table>
				</div>
			</div>
		@endif
		
@endforeach

<script>
window.onload = function() {
	javascript:window.print();
};
</script>