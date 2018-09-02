<?php
/* NB!! The idea of pagination begins with setting a page number .Setting and displaying the links.
   When a user clicks on a link the link gets the page number from the URL and the page number determines 
   what gets shown on the page by using  $start_dispaly which is then used in a SELECT sataement with the LIMIT command.
   The code below is the correct order of setting values.
*/


//Set the page number
if(!isset($_GET['page'])) {
                                $page=1;
} else {
                  $page = $_GET['page'];
}


//Pagination starts here
$items_per_page = 10;
//This will set where the LIMIT count starts from
$start_dispaly = ($page - 1) * $items_per_page;

$select = "SELECT * FROM tablename LIMIT $start_display,$items_per_page";
$verify = mysqli_query($connection,$select);
// This counts the amount of rows available or selected from the database
$rows = mysqli_num_rows($verify);
// You can echo the amount of rows to check if the query was successful
echo "amount of rows:" .$rows; 


//To display items loop through each row and select from the column
while( $row = mysqli_fetch_assoc($verify) ) {
    $title = $row['Title'];
    echo $title;
}


//Number of pages will be the total amount of rows divided by the amount of items you want to show per page
$number_of_pages = ceil($rows/$items_per_page) 


// Display the page links
for( $page_link_number=1; $page_link_number<=$number_of_pages;$page_link_number++) {
     if($page_link_number == $page ) {
                                  echo "<span id='currentpage'>$page_link_number</span>";
     } else {
                echo '<a refsearch-ng1.php?page='.$page_link_number.'&search='.$searchq.'&subcategory='.$getsubcategory.'&lat='.$latitudeFrom.'&long='.$longitudeFrom.' ">'.$page_link_number.'</a>';
     }
}

?>
