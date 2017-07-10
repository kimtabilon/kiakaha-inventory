app
.controller('itemImagesController', function ($scope, $http, $location, $filter, API_URL) {

	$http
    .get(API_URL + 'item-images/')
    .then(function (response) {
    	$scope.images = response.data;
    });

    $scope.errors = [];

    $scope.files = [];

        $scope.listFiles = function () {
        var request = {
            method: 'GET',
            url: API_URL + 'item-images/',
            headers: {
                'Content-Type': undefined
            }
        };

        $http(request)
            .then(function success(e) {
                $scope.files = e.data;

            }, function error(e) {

            });
    };

    $scope.listFiles();
    $scope.image = {
        name        : '',
        description : ''
    };

    var formData = new FormData();

    $scope.uploadFile = function () {

        formData.append('image_name', $scope.image.name);
        formData.append('image_description', $scope.image.description);

        var request = {
            method: 'POST',
            url: API_URL + 'item-images/create',
            data: formData,
            headers: {
                'Content-Type': undefined
            }
        };

        $http(request)
            .then(function success(e) {
                // console.log(e.data);
                $scope.files = e.data.files;
                $scope.errors = [];
                // clear uploaded file
                var fileElement = angular.element('#image_file');
                fileElement.value = '';
            }, function error(e) {
                $scope.errors = e.data.errors;
            });
    };

    $scope.setTheFiles = function ($files) {
        angular.forEach($files, function (value, key) {
            formData.append('image_file', value);
        });
    };

    $scope.deleteFile = function (id, index) {
        var conf = confirm("Do you really want to delete this file?");

        if (conf == true) {
            var request = {
                method: 'POST',
                url: API_URL + 'item-images/destroy',
                data: { id: id }
            };

            $http(request)
            .then(function success(e) {
                console.log(e.data);
                $scope.errors = [];

                $scope.files.splice(index, 1);

            }, function error(e) {
                $scope.errors = e.data.errors;
            });
        }
    };   

    $scope.display_image = function(image, name, description){
        $scope.modal = {
            image       : image,
            name        : name,
            description : description
        }

        $('#imageModal').modal('show');
    }; 

    
    
})
.directive('ngFiles', ['$parse', function ($parse) {
 
    function file_links(scope, element, attrs) {
        var onChange = $parse(attrs.ngFiles);
        element.on('change', function (event) {
            onChange(scope, {$files: event.target.files});
        });
    }
 
    return {
        link: file_links
    }
}]);

