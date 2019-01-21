app.controller('dashboardController', function ($scope, $http, $location, $filter, API_URL) {

    var current         = $filter('date')(Date.now(), 'yyyy-MM-dd');
    var date            = new Date();
    var current_date    = date.getDate();
    var current_month   = date.getMonth() + 1;
    var current_year    = date.getFullYear();

    $scope.report = {
        from : current_year + '-01-01',
        to   : current,
    };

    /*var date1       = new Date($scope.report.from);
    var date2       = new Date($scope.report.to);
    var timeDiff    = Math.abs(date2.getTime() - date1.getTime());
    var diffDays    = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
    console.log(diffDays);*/

    /*
    less than or equal 7 days, daily
    greater than 7 days, weekly
    greater than 31 days, monthly
    greater than 365 days, yearly
    */

	$http
    .get(API_URL + 'dashboard/' + $scope.report.from + '/' + $scope.report.to)
    .then(function (response) {
        $scope.users        = response.data.users;
        $scope.items        = response.data.items;
        $scope.inventories  = response.data.inventories;
        $scope.donors       = response.data.donors;
        $scope.itemStatus   = response.data.itemStatus;
    	$scope.transactions = response.data.transactions;

        $scope.filteredTrans = $filter('filter')($scope.transactions, { payment_type_id: response.data.add_item_to_inv.id }, true);

        $scope.good_items = $filter('filter')($scope.itemStatus, { name: 'Good'}, true)[0];
        $scope.sold_items = $filter('filter')($scope.itemStatus, { name: 'Sold'}, true)[0];

        // Prepare Excel data:
        $scope.transactionFileName = 'Transactions from ' + $scope.report.from + ' to ' + $scope.report.to;

        $scope.exportTransactionData = [];
        // Headers:
        $scope
            .exportTransactionData
            .push([
                    "Transaction No.", 
                    "Customer", 
                    "No. of Items",
                    "Items",
                    "Special Discount",
                    "Amount",
                    "Payment Type",
                    "Remarks",
                    "Date"
                ]);
        // Data:
        angular.forEach($scope.transactions, function(value, key) {
            if(value.payment_type.name != "Add Item to Inventory"){
                var customer = value.inventories[0].user.given_name + ' ' + value.inventories[0].user.last_name;
                var items = '';
                var amount = $scope.trans_total_each(value.inventories) - value.special_discount;

                angular.forEach(value.inventories, function(inv, invKey) {
                    items += ' # ' + inv.item.name;
                });

                $scope
                    .exportTransactionData
                    .push([
                        value.da_number, 
                        customer, 
                        value.inventories.length,
                        items,
                        value.special_discount,
                        amount,
                        value.payment_type.name,
                        value.remarks,
                        value.created_at
                    ]);
                
            }
                
        });
    });

    $scope.show_report = function() {
        var from = new Date($scope.report.from);
        var to   = new Date($scope.report.to);
        console.log(from);
        from = from.getFullYear() + '-' + (from.getMonth() + 1) + '-' + from.getDate();
        to   = to.getFullYear() + '-' + (to.getMonth() + 1) + '-' + to.getDate();

        console.log('-----------------------');
        console.log( 'From: ' + from);
        console.log( 'To: ' + to);

        if(from != '' && to != '' && from <= to) {
            console.log('Correct date.');
            $http
            .get(API_URL + 'dashboard/' + from + '/' + to)
            .then(function (response) {
                $scope.users        = response.data.users;
                $scope.items        = response.data.items;
                $scope.inventories  = response.data.inventories;
                $scope.donors       = response.data.donors;
                $scope.itemStatus   = response.data.itemStatus;
                $scope.transactions = response.data.transactions;
                $scope.add_item_to_inv = response.data.add_item_to_inv;

                $scope.filteredTrans = $filter('filter')($scope.transactions, { payment_type_id: response.data.add_item_to_inv.id }, true);

                console.log('Transactions ----------');
                console.log($scope.transactions);
                console.log('filteredTrans ----------');
                console.log($scope.filteredTrans);

                $scope.good_items = $filter('filter')($scope.itemStatus, { name: 'Good'}, true)[0];
                $scope.sold_items = $filter('filter')($scope.itemStatus, { name: 'Sold'}, true)[0];
            });  
        }
        else {
            console.log('Invalid date!');
        }  
        
    }

    $scope.trans_total_each = function(ins) {
        var total = 0;
        angular.forEach(ins, function(i){
            total+= (parseFloat(i.item_restore_prices[ i.item_restore_prices.length - 1].market_price) * parseFloat(i.quantity));
        });

        return parseFloat(total);
    }

    $scope.itemStatusColors = [
        "#f56954",
        "#00a65a",
        "#f39c12",
        "#00c0ef",
        "#3c8dbc",
        "#d2d6de",
        "#4661EE",
        "#EC5657",
        "#1BCDD1",
        "#8FAABB",
        "#B08BEB",
        "#F5A52A",
        "#3EA0DD",
        "#23BFAA",
        "#FAA586",
        "#EB8CC6",
    ];

    $scope.jsonToExport = [
    {
        "col1data": "1",
      "col2data": "Fight Club",
      "col3data": "Brad Pitt"
    },
    {
        "col1data": "2",
      "col2data": "Matrix (Series)",
      "col3data": "Keanu Reeves"
    },
    {
        "col1data": "3",
      "col2data": "V for Vendetta",
      "col3data": "Hugo Weaving"
    }
  ];

  console.log('report date');
  console.log($scope.report);
  console.log($scope.transactions);
  
    // Prepare Excel data:
    $scope.fileName = "report";
    $scope.exportData = [];
  // Headers:
    $scope.exportData.push(["#", "Movie", "Actor"]);
  // Data:
    angular.forEach($scope.jsonToExport, function(value, key) {
    $scope.exportData.push([value.col1data, value.col2data, value.col3data]);
    });
        
});


