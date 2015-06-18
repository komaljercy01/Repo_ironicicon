var controllers=angular.module('MainApp.controllers',[]);
    controllers.controller('HomeController', function ($scope) {
            //$sce.trustAsHtml -- Render HTML String
            $scope.Message = $sce.trustAsHtml("Welcome To <b>EScript</b>");
    });
    controllers.controller('AboutUsController', function ($scope) {
            $scope.Message = "About Me? .. Buhahahaha :P";
    });
    controllerscontroller('LoginController', function ($scope) {
            $scope.Message = "Login ah?.. ada poda";
    });
    controllers.controller('ContactUsController', function ($scope) {
            $scope.Message = "Call us or mail us.. but we wont give details";
    });
