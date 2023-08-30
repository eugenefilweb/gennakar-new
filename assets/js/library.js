const initTree = () => {
	const id = $('#library-form').data('id');
	
	$('#location-data').jstree({
		"plugins": ["wholerow", "checkbox", "types"],
		"core": {
			"themes": {"responsive": false},
			"data" : function (node, cb) {
				if(node.id === "#") {
					$.ajax({
						url : app.baseUrl + 'library/location-data',
						dataType: 'json',
						data: {
							id,
							type: 'init',
							node_id: node.id
						},
						success: (s) => {
							cb(s);
						},
						error: (e) => {
							console.log(e)
						}
					})
				}
				else {
					$.ajax({
						url : app.baseUrl + 'library/location-data',
						dataType: 'json',
						data: {
							id,
							type: node.data.type,
							node_id: node.id
						},
						success: (s) => {
							cb(s);
						},
						error: (e) => {
							console.log(e)
						}
					})
				}
			}
		},
		"types": {
			"default": {
				"icon": "fa fa-folder text-warning"
			},
			"file": {
				"icon": "fa fa-file  text-warning"
			}
		},
	});
}
initTree();
$('#library-form').on('beforeSubmit', function(e) {
	e.preventDefault();

	let island_group = [], region = [], province = [], citymun = [], brgy = [], location_data = [];
	const selectedElms = $('#location-data').jstree("get_selected", true);
 	
 	location_data = $('#location-data').data().jstree.get_json();

    $.each(selectedElms, function() {
    	switch (this.original.type) {
			case 'island_group':
				island_group.push(this.original);
				break;
			case 'region':
				region.push(this.original);
				break;
			case 'province':
				province.push(this.original);
				break;
			case 'citymun':
				citymun.push(this.original);
				break;
			case 'brgy':
				brgy.push(this.original);
				break;
			default:
				// code to be executed if expression does not match any of the case values
		}
    });

	$('#library-island_group').val(JSON.stringify(island_group));
	$('#library-region').val(JSON.stringify(region));
	$('#library-province').val(JSON.stringify(province));
	$('#library-municipality').val(JSON.stringify(citymun));
	$('#library-brgy').val(JSON.stringify(brgy));
	$('#library-location_data').val(JSON.stringify(location_data));

	return true;
})