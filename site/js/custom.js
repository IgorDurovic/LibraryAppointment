var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

function display_day_information( month, day ) {
    var elem = document.getElementById( "day-information" );
    console.log( month );
    elem.innerHTML = "<p>" + months[ month ] + ", " + day + "</p>";
}