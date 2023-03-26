function displayUserData(name, email, phone, webshopName, webshopAddress) {
    document.getElementById("user-name").innerHTML = name;
    document.getElementById("user-email").innerHTML = email;
    document.getElementById("user-phone").innerHTML = phone;
    document.getElementById("user-webshop-name").innerHTML = webshopName;
    document.getElementById("user-webshop-address").innerHTML = webshopAddress;
}


$(document).ready(function () {
    $('.clickable').click(function () {
        var name = $(this).find('td').eq(1).text();
        var email = $(this).find('td').eq(2).text();
        var phone = $(this).find('td').eq(3).text();
        var webshopName = $(this).data('webshop-name');
        var webshopAddress = $(this).data('webshop-address');
        var address = webshopAddress.split(',');
        var formattedAddress = address[0] + ' ' + address[1];
        displayUserData(name, email, phone, webshopName, formattedAddress);
        $('#user-modal').show();
    });

    $('.close-modal').click(function () {
        $('#user-modal').hide();
    });
});
