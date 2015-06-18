angular.module('MainApp.controllers',[])
    .controller('HomeController', function ($scope) {
            $scope.Message = "I nailed it :P";
    });
angular.module('MainApp.controllers',[])
    .controller('AboutUsController', function ($scope) {
            $scope.Message = "About Me? .. Buhahahaha :P";
    });
angular.module('MainApp.controllers',[]).controller('LoginController', function ($scope) {
            $scope.Message = "Login ah?.. ada poda";
    });
angular.module('MainApp.controllers',[]).controller('ContactUsController', function ($scope) {
            $scope.Message = "Call us or mail us.. but we wont give details";
    });
