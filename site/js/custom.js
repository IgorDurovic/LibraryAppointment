var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

function display_day_information( month, day, year ) {



}
//Reads for the equipment
function readTextFile( file )
{

    var reader = new FileReader();
	reader.onload = function(event) {
		var contents = event.target.result;
		console.log("File contents: " + contents);
	};

reader.onerror = function(event) {
	console.error("File could not be read! Code " + event.target.error.code);
};

	//reader.readAsText(file);
}
/**/
