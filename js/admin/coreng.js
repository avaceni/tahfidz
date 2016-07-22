$(document).ready(function() {
    var app = angular.module("backEndApp", ["ui.bootstrap.modal", 'platanus.keepValues']
//    , function($compileProvider) {
//        $compileProvider.directive('compile', function($compile) {
//            return function(scope, element, attrs) {                
//                scope.$watch(
//                        function(scope) {                            
//                            return scope.$eval(attrs.compile);
//                        },
//                        function(value) {
//                            element.html(value);
//                            $compile(element.contents())(scope);
//                        }
//                );
//            };
//        });
//    }
            );

    app.controller("MainController", function($scope, $http, $timeout) {
        $scope.dropdownShowClass = "";
        $scope.profile = 'true';
        $scope.hideSuccessPassword = 'true';
        $scope.init = function($var, $val) {
            $scope[$var] = $val;
        };
        $scope.showDropdown = function() {
            if ($scope.dropdownShowClass === "")
                $scope.dropdownShowClass = "open";
            else
                $scope.dropdownShowClass = "";
        };

        $scope.showProfile = function() {
            $('#my-profile-modal').modal('show');
            var url = baseUrl + '/js/lib/cropper/main.js';
            reloadScript(url);
        };

        $scope.saveMyProfile = function() {
            $scope.myProfileData.errors = {};
            $scope.myProfileData.hasError = {};
            $http.post($scope.myProfileUrl, $scope.myProfileData)
                    .success(function(data, status, headers, config) {
                        if (data.success == 1) {
                            $scope.profile = 'false';
                            $timeout(function() {
                                $scope.profile = 'true';
                            }, 5000);
                        }
                        else {
                            angular.forEach(data.messages, function(value, key) {
                                $scope.myProfileData.errors[key] = value;
                                $scope.myProfileData.hasError[key] = 'has-error';
                            });
                        }
                    })
                    .error(function(data, status, headers, config) {
                        alert('Error occured.please try again');
                    });
        };

        $scope.showPassword = function() {
            $http.get($scope.myPasswordUrl)
                    .success(function(response) {
                        $scope.changePasswordForm = response;
                        $('#change-password-modal').modal('show');
                    });
        };

        function resetForm(){
        }

        $scope.changePassword = function() {            
            $scope.myPasswordData.errors = {};
            $scope.myPasswordData.hasError = {};
            $http.post($scope.myPasswordUrl, $scope.myPasswordData)
                    .success(function(data, status, headers, config) {
                        if (data.success == 1) {
                                $scope.hideSuccessPassword = 'false';
                                $timeout(function(){
                                    $scope.hideSuccessPassword = 'true';
                                }, 5000);
                                $scope.myPasswordData.oldPassword = '';
                                $scope.myPasswordData.currentPassword = '';
                                $scope.myPasswordData.retypePassword = '';
                        }
                        else {
                                angular.forEach(data.messages, function(value, key) {
                                    $scope.myPasswordData.errors[key] = value;
                                    $scope.myPasswordData.hasError[key] = 'has-error';
                                });
                        }
                    })
                    .error(function(data, status, headers, config) {
                        alert('Error occured.please try again');
                    });
        };

        $scope.checkScope = function() {
            console.log('profile', $scope.myProfileData);
        };

        function reloadScript(url) {
            var old = document.querySelector('script[src*="' + url + '"]');
            var s = document.createElement('script');
            s.type = "text/javascript";
            s.src = url;
            document.head.appendChild(s);
            old.remove();
        }

        $scope.open = function() {
            $scope.showModal = true;
        };

        $scope.cancel = function() {
            $scope.showModal = false;
        };

    });

    app.directive('directProfileForm', ['$compile', '$timeout', function($compile, $timeout) {
            return {
                restrict: 'A',
                scope: {
                    myProfileData: '=profile',
                    myProfileForm: '=directProfileForm'
                },
                controller: ['$scope', function($scope) {
                        $scope.myProfileData = {};
                        $scope.myProfileData.errors = {};
                    }],
                templateUrl: function(elem, attrs) {
                    return attrs.templateUrl ? attrs.templateUrl : '';
                },
//                link: function(scope, element, attrs) {
//                    scope.$watch(function() {
//                        return scope.$eval(attrs.compile);
//                    },
//                            function(value) {
//                                element.html(value);
//                                $compile(element.contents())(scope);
//                                console.log('compiled scope', scope);
//                            }
//                    );
//                },        
            };
        }]);

    app.directive("noDirtyCheck", noDirtyCheck);
    function noDirtyCheck() {
        return {
            restrict: 'A',
            require: 'ngModel',
            controller: ['$scope', function($scope) {
                }],
            link: function(scope, element, attrs, ctrl) {
                element.change(function() {
                    ctrl.$setPristine();
                });
            },
        };
    }

    app.directive('directPassword', ['$compile', '$timeout', function($compile, $timeout) {
            return {
                restrict: 'A',
                scope: {
                    myPasswordData: '=password',
                    changePasswordForm: '=directPassword'
                },
                controller: ['$scope', function($scope) {
                        $scope.myPasswordData = {};
                        $scope.myPasswordData.errors = {};
//                        $scope.oriPassword = angular.copy($scope.myPasswordData);
                    }],
                link: function(scope, element, attrs) {
                    scope.$watch(function() {
                        return scope.$eval(attrs.directPassword);
                    },
                            function(value) {
                                element.html(value);
                                $compile(element.contents())(scope);
                            }
                    );
                },
            };
        }]);
    
});