angular.module('MainApp.controllers',[])
    .controller('HomeController', function ($scope) {
            $scope.Message = "I nailed it :P";
    });
    .controller('AboutUsController', function ($scope) {
            $scope.Message = "About Me? .. Buhahahaha :P";
    });
    .controller('LoginController', function ($scope) {
            $scope.Message = "Login ah?.. ada poda";
    });
    .controller('ContactUsController', function ($scope) {
            $scope.Message = "Call us or mail us.. but we wont give details";
    });
