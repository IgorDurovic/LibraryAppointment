var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

function display_day_information( month, day, year ) {



}

function readTextFile( file )
{
	alert('reading file');
	/*
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", file, false);
    rawFile.onreadystatechange = function ()
    {
        if(rawFile.readyState === 4)
        {
            if(rawFile.status === 200 || rawFile.status == 0)
            {
                var allText = rawFile.responseText;
                alert(allText);
            }
        }
    }
    rawFile.send(null);
}
*/

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
