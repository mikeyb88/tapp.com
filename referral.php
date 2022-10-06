<?php
$db = new SQLite3("users.db");
$referralUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
require_once "config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    
  $visitorId = $_POST['visitorId'];
    
        $query = $db->querySingle("SELECT COUNT(*) FROM users WHERE visitorId = '$visitorId'");
        
        if($query > 0) {
            
        

          die("Looks like you've already been referred to this profile!");
        } else {
            
            $insert_stmt = $db->prepare("INSERT INTO users (visitorId, referralUrl) values ('$visitorId', '$referralUrl')");
            $insert_stmt->bindValue($visitorId, $_POST['visitorId'], SQLITE3_TEXT);
            $res = $insert_stmt->execute();

            if($res) {
                header('Location: index.php');
            } else {
                die("Error occurred");
            }
       }
       


    }


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script>
        function initFingerprintJS() {
            FingerprintJS.load({apiKey: 'ucaJ38wchCJUjUwsLXrM'})
            .then(fp => fp.get())
            .then(result => {
                document.getElementById('visitorId').value = result.visitorId
            });
                
        }
    </script>

    <script
    async
    src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs-pro@3/dist/fp.min.js"
    onload="initFingerprintJS()"
    ></script>

    <script>
    function greet(){
    document.getElementById('button').click();
    }
    setTimeout(greet, 5000);
    </script>
</head>
<body>
    <div class="flex h-screen bg-blue-700">
        <div class="max-w-lg m-auto bg-blue-100 rounded p-5">   
            <h2 class="text-xl">Please wait...</h2>
            <p class="text-sm">Redirecting you automatically to El Toro Ryan</p>
            <form class="p-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
               
              <input name="visitorId" id="visitorId" value="" hidden>
                <div class="form-group">
                    <input class="w-full bg-blue-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded" id="button" type="submit" value="Click me if nothing happens.">
            
                </div>
                
            </form>
            <footer>
                <a class="text-blue-700 hover:text-pink-700 text-sm float-left" href="login.php">Log In</a>
            </footer> 
        </div>
        
    </div>    
</body>
</html>