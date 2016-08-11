app
    .controller('ReportCtrl',function($scope,  $uibModal){

        $scope.userDetail = function(id){

            var modalInstance = $uibModal.open({

                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl2',
                size: 'lg',
                resolve: {
                    id: function () {
                        return id;
                    }
                }
            });
        }


    })

    .controller('ModalInstanceCtrl2', function ($scope, $http, $uibModalInstance, id) {

        $scope.user = {};
        $http.get(url + 'angular/'+ id+'/user-detail').then(function(response){
            //console.log(response.data);
            $scope.user = response.data;
        });


        $scope.ok = function () {
            $uibModalInstance.close();
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };



    })
;