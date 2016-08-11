app
    .controller('GroupCtrl',function($scope, $http, $uibModal){
        //alert("hola");
        $scope.emails = [];


        $scope.modalEmail = function(email){

            if(!email){
                email = {
                    id: null,
                    send_group_id: group_id,
                    email: null,
                }
            }

            var modalInstance = $uibModal.open({

                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceGroupCtrl',
                size: 'lg',
                resolve: {

                    email: function(){
                        return email;
                    }
                }
            });

            modalInstance.result.then(function (result) {
                var email = result.email
                    ;

                //console.log('q');
                //console.log(question);
                //console.log('f');
                //console.log(files);

                $http.post(url + 'angular/email', email).then(function(response){
                    bootbox.alert(response.data.message);
                    $scope.getEmails();

                },function(err,status){
                    bootbox.alert(err.data.message);
                });

            }, function () {
                //$log.info('Modal dismissed at: ' + new Date());
            });

        }




        $scope.getEmails = function(){
            $http.get(url + 'angular/group/' + group_id + '/emails').then(function(response){
                //console.log(response.data);
                $scope.emails = response.data;
            });
        }




        $scope.deleteEmail = function (email){
            $http.delete(url + 'angular/email/' + email.id ).then(function(response){
                $scope.getEmails();
            });
        }

        $scope.getEmails();
    })

    .controller('ModalInstanceGroupCtrl', function ($scope, $uibModalInstance, email) {


        $scope.email = email;


        $scope.ok = function () {

            var files = false;

            if(!$scope.email.email){
                bootbox.alert("Especifica el email");
                return false;
            }


            $uibModalInstance.close({ email: $scope.email});
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };


    })







;