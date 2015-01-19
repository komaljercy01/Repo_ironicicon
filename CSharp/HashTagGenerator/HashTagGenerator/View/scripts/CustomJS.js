var suggestions = "";
var values = "";
$(document).ready(function () {
    //all the codes come here
    $('#Submit').click(function () {
        values = $('#HashTagDiv').text();
        if (values != "") {
            $('#HashTagDiv').empty();
            suggestions = "";
        }
        var _inputToSearchHashTag = $('#inputSearch').val();
        if (_inputToSearchHashTag.trim() == "") {
            alert("Cannot be empty");
        }
        else {
            callAjaxFunction(_inputToSearchHashTag);
        }
    });
});

//7th December - ajax call working fine
function callAjaxFunction(HashTag) {
    var _serviceUrl = "http://localhost:5867/HashTagGen.svc/GetHashTags";
    $.ajax({
        url: _serviceUrl,
        data: { input: HashTag },
        success: function (response, textStatus, jqXHR) {
            //as of now only nouns taken
            var responseAsJSON = $.parseJSON(response[0]).noun.syn;
            $(responseAsJSON).each(function (index, value) {
                suggestions += '#' + value+" ";
            });
            $('#HashTagDiv').text(suggestions);
        }
    });
}