app


    .directive('ngConfirmClick', [
        function(){
            return {
                priority: -1,
                restrict: 'A',
                link: function(scope, element, attrs){
                    element.bind('click', function(e){
                        var message = attrs.ngConfirmClick;
                        if(message /*&& !confirm(message)*/){
                            e.stopImmediatePropagation();
                            e.preventDefault();
                            bootbox.confirm(message, function(result){
                                if(result){
                                    scope.$apply(attrs.ngClick);
                                }
                            });

                        }
                    });
                }
            }
        }
    ])


;