<?php
    
    $backgroundImage = "./img/sea.jpg";
    // api call goes here.
    // 3.2  In PHP, we can access these GET requests using the global variable $_GET.
    // If the isset($_GET[‘keyword’]) evaluates to true, we know the form has been submitted.
     /*
    if (isset($_GET['keyword'])) {
        echo "You searched for: ". $_GET['keyword'];
    }
    */
            
    // 3.3  Now that we have access to our keyword from the form in PHP, let’s use the getImageURLs() function located in pixabayAPI.php to get the results of our Pixabay image search.  
    // This returns an array which we will store in $imageURLs. 
    // Finally, we can check the contents of array with the print_r() function.
    /*
    if (isset($_GET['keyword'])) {
        include 'api/pixabayAPI/php';
        $imageURLs = getImageURLs($_GET['keyword']);
        print_r($imageURLs);
    }
    */
    // The print_r() function provides a human readable view of the contents of an array.
    
    // 3.4  With the URLs of our images available, let’s put them to use!  
    // Remove the print_r() function call.  
    // Instead, we will set the $backgroundImage with a random image from the images we collected.
    
    
    /*
     if (isset($_GET['keyword'])) {
        include 'api/pixabayAPI.php';
        $imageURLs = getImageURLs($_GET['keyword']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
    */
    
    function getSevenRandomImages($imgURLs) {
        $imagesToDisplay = array_slice($imgURLs, 0, 7); 
        return $imagesToDisplay; 
    }
    
    
    if (isset($_GET['keyword'])) {
        // show carousel
        
        // make request to pixabay
        include "./api/pixabayAPI.php"; 
        
        $imgURLs = getImageURLs($_GET['keyword']); // an array of image urls
       
        $imgsToDisplay = getSevenRandomImages($imgURLs); 
        // set random background image 
        // for ($i = 0; $i < count($imgsToDisplay);$ $i++) {
        //    echo $imgsToDisplay[$i]. "<br>";
        //}
        
        $backgroundImage = $imgsToDisplay[array_rand($imgsToDisplay)]; 
    } 
    
    


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
         <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
             @import url("./css/styles.css"); 
        </style>
        
        <style>
            body {
                background-image: url("<?=$backgroundImage?>");
                background-size: 100% 100%;
                background-attachment: fixed;
            }
        </style>
    </head>
    <body>
         <!-- 2.5  We need to provide instructions to the user, but only if they have not submitted a keyword. -->
        <!-- We can determine this in PHP by checking if the variable holding the array of images ($imageURLs) has been set.-->  
        <!-- If $imageURLs is not set, we will display the message. -->
        <!-- If it is, we should display the carrousel with those images. -->
        
         <?php 
            if (!isset($imgsToDisplay)) {
                // show prompt to user to enter query
                echo "<h2> Enter query to see imagees from Pixabay</h2>"; 
                    
            } else {
                // show carousel
                    echo '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">'; 
                    echo '<ol class="carousel-indicators"> '; 
                    for ($i = 0; $i < count($imgsToDisplay); $i++) {
                        echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"'; 
                        echo $i == 0 ? 'class="active"' : ''; 
                        echo '></li>'; 
                    } 
                    echo '</ol>'; 
                    
                    echo '<div class="carousel-inner" role="listbox">'; 
                    
                    for ($i = 0; $i < count($imgsToDisplay); $i++) {
                        echo '<div class="item '; 
                        echo $i == 0 ? 'active' : ''; 
                        echo '">'; 
                        echo '<img src="'.$imgsToDisplay[$i].'" alt="...">'; 
                        echo '</div>';     
                    } 
                
                    echo '</div>'; 
                ?>
                
                <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
              
        </div>    
        <?php
                
            } // finishes the else 
            
        ?>
  
     <form>
            <input type="text" name="keyword" placeholder="Keyword">
            <div id="layoutDiv">
                <input type= "radio" name="layout" value="horizontal" id="layout_h">
                <label for= "layout_h"> Horizontal</label>
                <br>
                <input type= "radio" name="layout" value="vertical" id="layout_v">
                <label for= "layout_v"> Vertical</label>
                <br>
            </div>
            <br>
            <select name="category" style="color:black; font-size:1.5em">
                <option value> - Select One - </option>
                <option value="ocean"> Sea </option>
                <option> Mountains </option>
                <option> Forest </option>
                <option> Sky </option>
            </select>
            <br>
            <br>
            <input type="submit" value="Submit">
            
            
            
        </form>
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>