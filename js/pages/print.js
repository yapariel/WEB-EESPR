function printToPrinter() {

    var divToPrint = document.getElementById('printTable');
    var newWin = window.open('', 'Print-Window', 'width=600,height=400');

    var content = '<!DOCTYPE html>\
		<html xmlns="http://www.w3.org/1999/xhtml">\
		<head>\
		    <meta charset="utf-8">\
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">\
		    <meta name="description" content="">\
		    <meta name="author" content="">\
			<title></title>\
    		<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">\
    		<link rel="stylesheet" href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css">\
            <link rel="stylesheet" href="../bower_components/datatables-responsive/css/dataTables.responsive.css">\
            <link rel="stylesheet" href="../dist/css/sb-admin-2.css">\
            <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">\
		    <style type="text/css" media="print">body {padding-top: 50px;} .dataTables_filter, .dataTables_info, .dataTables_length,.dataTables_paginate { display: none; } </style>\
		</head>\
    	<body onload="window.print()">\
    	<div class="container">\
        	<div class="row">\
                <div class="col-xs-12">'+ divToPrint.innerHTML + '</div>\
            </div>\
        </div>\
		</body>\
    	</html>';

    newWin.document.open();
    newWin.document.write(content);
    newWin.document.close();

    // setTimeout(function() {
    //     newWin.close();
    // }, 10);
}
