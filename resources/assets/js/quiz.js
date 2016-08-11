app
    .controller('QuizCtrl',function($scope, $http, $uibModal){
        //alert("hola");
        $scope.questions = [];
        $scope.types = [];
        $http.get(url + 'angular/question-types').then(function(response){
            //console.log(response.data);
            $scope.types = response.data;
        });

        $scope.modalQuestion = function(question){

            if(!question){
                question = {
                    id: null,
                    quiz_id: quiz_id,
                    type: null,
                    question: null,
                    answers: []
                }
            }

            var modalInstance = $uibModal.open({

                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
                size: 'lg',
                resolve: {
                    types: function () {
                        return $scope.types;
                    },
                    question: function(){
                        return question;
                    }
                }
            });

            modalInstance.result.then(function (result) {
                var question = result.question,
                    files = result.files
                    ;

                //console.log('q');
                //console.log(question);
                //console.log('f');
                //console.log(files);

                $http.post(url + 'angular/question', question).then(function(response){
                    bootbox.alert(response.data.message);


                    if(files){
                        var formData = new FormData();
                        angular.forEach(files, function (file) {
                            formData.append(file.name, file);
                        });

                        $http.post(url + 'angular/question/' + response.data.id + '/images', formData, {
                                transformRequest: angular.identity,
                                headers: { 'Content-Type': undefined }
                        })
                        .success(function (a, b, c) {
                            $scope.getQuestions();
                        })
                        .error(function (a, b, c) {
                            console.log('error');
                            console.log(a);
                        });
                    }else{
                        $scope.getQuestions();
                    }

                },function(err,status){
                    bootbox.alert(err.data.message);
                });

            }, function () {
                //$log.info('Modal dismissed at: ' + new Date());
            });

        }




        $scope.getQuestions = function(){
            $http.get(url + 'angular/quiz/' + quiz_id + '/questions').then(function(response){
                //console.log(response.data);
                $scope.questions = response.data;
            });
        }




        $scope.deleteQuestion = function (question){
            $http.delete(url + 'angular/question/' + question.id ).then(function(response){
                $scope.getQuestions();
            });
        }

        $scope.getQuestions();
    })

    .controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, types, question) {


        $scope.types = types;
        $scope.question = question;



        $scope.ok = function () {

            var files = false;

            if(!$scope.question.question){
                bootbox.alert("Especifica tu pregunta");
                return false;
            }

            if($scope.question.type === null){
                bootbox.alert("Especifica el tipo de pregunta");
                return false;
            }

            if(($scope.question.type==0 || $scope.question.type==1 || $scope.question.type=='Porcentaje' || $scope.question.type=='Cajones 2') && $scope.question.answers.length==0){
                bootbox.alert("Especifica al menos una respuesta");
                return false;
            }

            if($scope.question.type=='Porcentaje' && $scope.question.answers.length!=2){

                bootbox.alert("Debes especificar 2 y solo 2 respuestas para el tipo de pregunta Porcentaje ");
                return false;
            }

            if($scope.question.type=='Opcion Multiple Imagen' || $scope.question.type=='Opcion Unica Imagen' || $scope.question.type=='Cajones'){
                files = document.getElementById('files').files;

            }else if($scope.question.type=='Cajones 2'){
                files = document.getElementById('files3').files;

            }else if($scope.question.type=='Tache Paloma Imagen' || $scope.question.type=='Dibujar sobre Imagen'){
                files = document.getElementById('files2').files;

            }

            $uibModalInstance.close({ question: $scope.question, files: files});
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };

        $scope.addAnswer = function(){
            var obj = {id: null, answer:'', score: 0};
            $scope.question.answers.push(obj);
        }

        $scope.deleteAnswer = function(index){
            $scope.question.answers.splice(index,1);
        }



    })







;