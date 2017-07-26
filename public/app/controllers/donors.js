app
.controller('donorsController', function($scope, $http, $location, $filter, API_URL) { 

    $http
    .get(API_URL + 'donors')
    .then(function (response) {
        $scope.types  = response.data.donor_types;
        $scope.itemCodeTypes = response.data.code_types;
    });

    $scope.code = function(codes, type) {
		var codeType 	= $filter('filter')($scope.itemCodeTypes, { name: type });
		var match 		= $filter('filter')(codes, { item_code_type_id: codeType[0].id });
		return match.reverse()[0];
	}

	$scope.toggle = function(data, type) {
        switch(type) {
            case 'show_list_of_items':
                $scope.modal = {
                    type        : type, 
                    title       : 'Items donated by ' + data.name,
                    inventories : data.inventories,
                }
                break;
            case 'create_new_donor':
                if(data!='') {
                    $scope.new_customer = data;
                    $scope.new_customer.donor_type = data.donor_type.name;
                    $scope.modal = {
                        type        : type, 
                        title       : 'Modify Donor',
                    }
                }
                else {
                    $scope.new_customer = { 
                        id          : 0,
                        given_name  : '',
                        middle_name : '',
                        last_name   : '',
                        email       : '',
                        donor_type  : '',
                        profile     : {
                            title       : '',
                            address     : '',
                            phone       : '',
                            tel         : '',
                            company     : '',
                            job_title   : '',
                        }                
                    }

                    $scope.modal = {
                        type        : type, 
                        title       : 'New Donor',
                    }
                }
                break;    
        }
        
        $('#inventoryModal').modal('show');
    }

    $scope.new_customer_btn = function(donor, action) {
        console.log(donor);
        if(donor.donor_type != '')
        {
            $http({
                method  : 'POST',
                url     : API_URL + 'donors/create',
                data    : {  
                            donor  : donor,
                        }
            })
            .then(function (response) {
                
                var new_donor   = response.data;
                var type        = $filter('filter')($scope.types, { id: new_donor.donor_type_id }, true)[0];
                var old_type    = $filter('filter')($scope.types, { id: donor.donor_type_id }, true)[0];
                var index       = $scope.types.indexOf(type);
                var old_index   = $scope.types.indexOf(old_type);
                

                if(action=="New Donor") {
                    $scope.types[index].donors.push(new_donor);
                }
                else {
                    var match_donor     = $filter('filter')($scope.types[index].donors, { id: new_donor.id }, true)[0];
                    var old_match_donor = $filter('filter')($scope.types[old_index].donors, { id: donor.id }, true)[0];
                    var donor_index     = $scope.types[index].donors.indexOf(match_donor);
                    var old_donor_index = $scope.types[old_index].donors.indexOf(old_match_donor);

                    $scope.types[old_index].donors.splice(old_donor_index, 1);
                    $scope.types[index].donors.push(new_donor);
                }

                $scope.new_customer = { 
                    id          : 0,
                    given_name  : '',
                    middle_name : '',
                    last_name   : '',
                    email       : '',
                    profile     : {
                        title       : '',
                        address     : '',
                        phone       : '',
                        tel         : '',
                        company     : '',
                        job_title   : '',
                    }                
                }
            });

            $('#inventoryModal').modal('hide');
        }
        else {
            alert('Please select type of donor.');
        }
            
    }

    $scope.remove_donor = function(donor) {
        if(confirm('Data will be lost, please make sure this donor is new and no transaction created.'))
        {
            $http({
                method  : 'POST',
                url     : API_URL + 'donors/destroy',
                data    : {  
                            id  : donor.id,
                        }
            })
            .then(function (response) {
                var match = $filter('filter')($scope.types, { id: donor.donor_type_id }, true)[0];
                var type_index = $scope.types.indexOf(match);
                var find_donor = $filter('filter')($scope.types[type_index].donors, { id: donor.id }, true)[0];
                var donor_index = $scope.types[type_index].donors.indexOf(find_donor);

                $scope.types[type_index].donors.splice(donor_index, 1);
            });
        }
        
    }
});

