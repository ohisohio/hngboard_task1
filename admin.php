<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Leadersboard | Dashboard</title>
		<link
			href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="css/style.css" />
		<script src="https://kit.fontawesome.com/853007f87a.js"></script>
	</head>
	<body class="bg-blue-200">
		<div class="container flex">
			<aside class="flex items-center w-1/2 h-screen lg:w-64 bg-blue-400">
				<ul class="flex justify-between w-1/2 flex-col">
					<li
						class="px-8 py-6 text-white font-bold rounded cursor cursor-pointer"
					>
						Dashboard
					</li>
					<li
						class="px-8 py-6 text-white font-bold rounded cursor cursor-pointer"
					>
						Leaders Board
					</li>
					<li
						class="px-8 py-6 text-white font-bold rounded cursor cursor-pointer"
					>
						Tables
					</li>
				</ul>
			</aside>
			<main class="p-12">
            <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
				<div class="grid w-2/3">
					<div class="w-full h-64 bg-gray-100 rounded">
						selected file
					</div>
					<div class="w-full p-6 bg-blue-700 text-center">
                    <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div>
                    <select id="filetype" name="filetype" required>
                    <option value="">Choose File Format</option>
                    <option value="csv">CSV</option>
                    <option value="json">JSON</option>
                    </select>
                </div>
                <br>
                <div class="input-row">
                    <input type="file" name="file"
                        id="file" accept=".csv"> <br><hr>
                    <button type="submit" id="submit" name="import"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Click to IMPORT INTO Database</button>
                    <br />

                </div>

            </form>
					</div>
				</div>
			</main>
		</div>


<?php

//function for CSV File to run
require_once 'extras/functions.php';

if(isset($_POST['import']) && $_POST["filetype"] == 'csv'){
csvimport();
} else {
jsonimport();
}

?>   
 
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</body>
</html>


