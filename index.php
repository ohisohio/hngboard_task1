<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="css/style.css" />
        <script src="https://kit.fontawesome.com/853007f87a.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

        <script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

		<title>Leaders Board</title>
	</head>
	<body class="bg-blue-200">
		<div class="container cn m-auto">
			<header class="p-2 w-full border-b-2 border-blue-700">
				<h1
					class="w-full m-auto text-2xl font-bold font-sans text-blue-700 text-center"
				>
					LeadersBoard
                </h1><br>
                <h4 style="text-align: center;">  Designed and developed by @ohis | @Gfellah |@onyinyebeks | @been_ice </h4>
				<span class="block text-right text-blue-700 font-semibold"
					><a
						href="/admin.php"
						class="border-2 p-1 mx-2 m-8 rounded border-blue-700 shadow-2xl text-sm hover:scale-50"
						>DashBoard</a
					>
				</span>
			</header>
			<main class="p-6">
            
				<div class="search__fn text-center">
					<div
						class="search__fn--input border-2 mb-4 rounded-full border-blue-700 w-64 m-auto"
					>
						<i class="fas fa-search text-blue-700"></i>
						<input
							type="text"
							name="search-box"
							id="search-box"
                            placeholder="Enter UserName"
                            autocomplete="off"
							class= "bg-blue-200 text-blue-700 px-4 py-2 outline-none rounded-full"
						/>
					</div>
					<div class="w-64 m-auto">
						<input
							type="button"
							name="sort"
							id="sort"
							value="From Highest"
							class="py-2 px-4 bg-blue-700 shadow-2xl border-blue-700 rounded-full text-white font-hairline hover:bg-blue-200 hover:text-blue-700 border-2"
						/>
						<input
							type="button"
							name="sort"
							id="sort"
							value="From lowest"
							class="py-2 px-4 bg-blue-700 shadow-2xl border-blue-700 rounded-full text-white font-hairline hover:bg-blue-200 hover:text-blue-700 border-2"
						/>
					</div>
				</div>


<?php
require_once'config/conn.php';
$conn = OpenCon();
            $sqlSelect = "SELECT fullname,username,email,point FROM board ORDER BY point DESC";
            
            if($result = mysqli_query($conn,$sqlSelect)){
                if (mysqli_num_rows($result) > 0){?>
    

    <table class="main_content result">
    <thead>
        <tr>
            
            <th>NAME</th>
            <th>USERNAME</th>
            <th>EMAIL</th>
            <th>POINTS</th>
            <th colspan="2">SHARE</th>
        </tr>
    </thead>

<?php
while($row = mysqli_fetch_assoc($result)){?>
<tbody >
    <tr>
        
        <td><?php echo $row['fullname']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['point']; ?></td>
        <td> <a href="sendtofb.php?view=<?php echo $row['username']; ?>"><i class="fab fa-facebook-square"></i></a>
            </td>
        <td> <a href="sendtotwitter.php?view=<?php echo $row['username']; ?>"><i class="fab fa-twitter"></i></a>
            </td>
       
    </tr>
</tbody>
<?php } ?>

</table>

<?php
            }
        }
        ?>
        
        </div>
        
    </div>

  

</body>
</html>





