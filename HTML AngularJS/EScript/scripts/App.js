var MainApp = angular.module('MainApp', ['ngRoute','MainApp.controllers']);
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
        .when('/Login', {
            templateUrl: 'templates/Login.html',
            controller: 'LoginController'
        })
        /*.when('/ContactUs', {
            templateUrl: 'templates/ContactUs.html',
            controller: 'ContactUsController'
        })*/
        //.otherwise({
        //    redirectTo: '/Home'
        //});
});

