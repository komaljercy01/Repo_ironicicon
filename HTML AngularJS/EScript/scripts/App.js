var MainApp = angular.module('MainApp', ['ngRoute']);
//['MainApp.controllers']
MainApp.config(function ($routeProvider) {
    $routeProvider
        .when('/Home', {
            templateUrl: 'templates/Home.html',
            controller:'HomeController'
        })
        .when('/AboutUs', {
            templateUrl: 'templates/AboutUs.html',
            controller: 'AboutUsController'
        })
        //.otherwise({
        //    redirectTo: '/Home'
        //});
});

MainApp.controller('HomeController', function ($scope) {
        $scope.Message = "Welcome To EScript";
    });

MainApp.controller('AboutUsController', function ($scope) {
    $scope.Message = "Welcome To About Us Page";
});