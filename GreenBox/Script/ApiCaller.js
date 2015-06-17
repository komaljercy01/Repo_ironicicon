var pageDataHandler = {
    'opt': function (src, data, defaultValue, defaultText) {
        var otControl = $(src);
        var otVehicleTypes = $('#optionsTemplate').html();
        var optionData = {
            "options": []
        };
        var formattedMarkup = null;

        optionData.options.push({
            "key": defaultValue,
            "text": defaultText
        });
        $.each(data, function (key, item) {
            optionData.options.push({
                "key": item.Id,
                "text": item.Description
            });
        });
        formattedMarkup = Mustache.render(otVehicleTypes, optionData);
        otControl.html(formattedMarkup);
    },
    'vt': function () {
        $.getJSON("http://greendrive.azurewebsites.net/api/GreenBoxApi/GetAllVehicleTypes").
            done(function (data) {
                pageDataHandler.opt('#vt', data, 0, 'Select Vehicle Type');
            });
    },
    'svt': function (vtId) {
        $.getJSON("http://greendrive.azurewebsites.net/api/GreenBoxApi/GetVehicleSubTypeById/" + vtId).
            done(function (data) {
                pageDataHandler.opt('#svt', data, 0, 'Select Vehicle Sub Type');
            });
    },
    'gb': function (result, distance, subType, successCallBack) {
        distance = distance.replace(/~$/, "");
        $.getJSON("http://greendrive.azurewebsites.net/api/GreenBoxApi/GetEmissionFactors?data=" + subType + ',<root></root>,' + distance).
            done(function (data) {
                successCallBack(result, data);
            });
    }
};
$(document).ready(function () {
    pageDataHandler.vt();
    $('#vt').change(function () {
        pageDataHandler.svt($(this).val());
    });

});
