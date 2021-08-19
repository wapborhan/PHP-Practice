<script>
	var menus = {
		"oneThemeLocationNoMenus" : "",
		"moveUp" : "{{translate('Move up')}}",
		"moveDown" : "{{translate('Mover down')}}",
		"moveToTop" : "{{translate('Move top')}}",
		"moveUnder" : "{{translate('Move under of')}} %s",
		"moveOutFrom" : "{{translate('Out from under')}}  %s",
		"under" : "{{translate('Under')}} %s",
		"outFrom" : "{{translate('Out from')}} %s",
		"menuFocus" : "%1$s. {{translate('Element menu')}} %2$d {{translate('of')}} %3$d.",
		"subMenuFocus" : "%1$s. {{translate('Menu of subelement')}} %2$d {{translate('of')}} %3$s."
	};
	var arraydata = [];     
	var addcustommenur= '{{ route("haddcustommenu") }}';
	var updateitemr= '{{ route("hupdateitem")}}';
	var generatemenucontrolr= '{{ route("hgeneratemenucontrol") }}';
	var deleteitemmenur= '{{ route("hdeleteitemmenu") }}';
	var deletemenugr= '{{ route("hdeletemenug") }}';
	var createnewmenur= '{{ route("hcreatenewmenu") }}';
	var csrftoken="{{ csrf_token() }}";
	var menuwr = "{{ url()->current() }}";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': csrftoken
		}
	});
</script>
<script type="text/javascript" src="{{asset('public/vendor/harimayco-menu/scripts.js')}}"></script>
<script type="text/javascript" src="{{asset('public/vendor/harimayco-menu/scripts2.js')}}"></script>
<script type="text/javascript" src="{{asset('public/vendor/harimayco-menu/menu.js')}}"></script>