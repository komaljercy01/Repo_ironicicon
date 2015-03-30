var CustomerParameters = new Object();
        $(document).ready(function () {
            $('#ddID').click(function () {
                $('#operatorsList').toggle();
                $('#Amount').toggle();
                $('#Submit').toggle();//hiding the Amount text box field since it is overlapping the operators Div
                $('ul.operatorsListCls > li').click(function (e) {
                    //e.currentTarget.id - holds the ID of the current actionlistner
                    if (e.currentTarget != null && e.currentTarget.id != null) {
                        populateOperatorDiv(e.currentTarget.id);
                    }
                });
            });
        });
        function populateOperatorDiv(mobileOperator) {
            $('#OperatorText').html('<img src="images/' + mobileOperator + '.jpg" style="margin-top:-5px;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p id="SelectedOperator" style="display:inline;font-size:16px;">' + mobileOperator + '</p>');
            $('#operatorsList').hide();
            $('#Amount').show(); //showing the textbox once the user has selected the value
            $('#Submit').show();
            //checking if the user has selected an operator and then populating the div
            if (document.getElementById('SelectedOperator') != null && document.getElementById('SelectedOperator').innerHTML != null) {
                $('#rechargeOffers').text(angular.element($('#SelectedOperator')).scope().$$childHead.OffersDiv(mobileOperator));
            }
        }
        //Main Angular App
        var angularApp = angular.module('RechargeApp', ['RechargeOffers']); //dependency injection
		//end of Main AngularJS App
		
        //Region Module RechargeOffers
        var RechargeOffers = angular.module('RechargeOffers', []);
		//RechargeOffers.service("MainService",
		 //Region controller RechargeOffersController
        RechargeOffers.controller('RechargeOffersController', function ($scope) {
            $scope.OffersDiv = function (offerDivValue) {
                //have topups alone as of now... value can be populated from freecharge site
                switch (offerDivValue) {
                    case "Vodafone":
                        return "Vodafone is selected";
                        break;
                    case "Airtel":
                        return "Airtel is selected";
                        break;
                    case "Aircel":
                        return "Aircel is selected";
                        break;
                    case "BSNL":
                        return "BSNL is selected";
                        break;
                    default:
                        return "Select an operator from Drop down to find the offers";
                        break;
                }
            },
            $scope.proceedToNextPage = function () {
				var error=false;
				if($('#Mob').val().trim()!="" && !isNaN($('#Mob').val()))
				{CustomerParameters.MobileNumber = $('#Mob').val();}
				else{error=true;alert("please enter only numbers");}
				if($('#Amount').val().trim()!="" && !isNaN($('#Amount').val()))
				{CustomerParameters.Amount = $('#Amount').val();}
				else{error=true;alert("please enter only numbers");}
				if(!error)
				{
					CustomerParameters.Operator = $('#SelectedOperator')[0].innerText;
					$scope.Parameters = JSON.stringify(CustomerParameters);
					//alert(angular.element($('#SelectedOperator')).scope().$$childHead.Parameters);
				}
            };
        });
		//end of RechargeOffersController Controller
		
		//passing this to next controller whose scope is to retreive the value from customer parameters(as JSON) from previous controller and pass it into the next controller
		
		//region PaymentMethodController controller
		RechargeOffers.controller('PaymentMethodController',function($scope){
		});
		//end of region PaymentMethodController controller
		
		//End of Module RechargeOffers
