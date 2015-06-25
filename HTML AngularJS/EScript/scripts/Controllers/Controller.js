var controllers=angular.module('MainApp.controllers',[]);
    controllers.controller('HomeController', function ($scope,$sce) {
            //$sce.trustAsHtml -- Render HTML String
            $scope.Message = $sce.trustAsHtml("Welcome To <b>EScript</b>");
    });
    controllers.controller('AboutUsController', function ($scope) {
            $scope.Message = "About Me? .. Buhahahaha :P";
    });
    controllers.controller('LoginController', function ($scope) {
            $scope.Message = "Enter your Username and password to access the Files";
            $scope.TestMethod=function(){
               $window.alert("poda") ;
            }
    });
    controllers.controller('ContactUsController', function ($scope) {
            $scope.Message = "Call us or mail us.. but we wont give details";
    });
