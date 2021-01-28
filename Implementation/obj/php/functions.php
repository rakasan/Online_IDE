<?php
function sec_session_start() {
        $session_name = 'sec_session_id'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id. 
 
        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Sets the session name to the one set above.
        session_start(); // Start the php session
        session_regenerate_id(true); // regenerated the session, delete the old one.     
}








function login($email, $password, $mysqli) {
   // Using prepared Statements means that SQL injection is not possible. 
   if ($stmt = $mysqli->prepare("SELECT ID, PASSWORD, SALT FROM members WHERE EMAIL = ? LIMIT 1")) { 
      $stmt->bind_param('s', $email); // Bind "$email" to parameter.
      $stmt->execute(); // Execute the prepared query.
      $stmt->store_result();
      $stmt->bind_result($user_id, $db_password, $salt); // get variables from result.
      $stmt->fetch();
      $password = hash('sha512', $password.$salt); // hash the password with the unique salt.
 
      if($stmt->num_rows == 1) { // If the user exists
         // We check if the account is locked from too many login attempts
         if(checkbrute($user_id, $mysqli) == true) { 
            // Account is locked
            // Send an email to user saying their account is locked
            return false;
         } else {
         if($db_password == $password) { // Check if the password in the database matches the password the user submitted. 
            // Password is correct!
 
 
               $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
 
               $user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
               $_SESSION['user_id'] = $user_id; 
               echo "ma loghez";
               echo $_SESSION['user_id'];
               $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
               // Login successful.
               return true;    
         } else {
            // Password is not correct
            // We record this attempt in the database
            $now = time();
            $mysqli->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
            return false;
         }
      }
      } else {
         // No user exists. 
         return false;
      }
   }
}









function checkbrute($user_id, $mysqli) {
   // Get timestamp of current time
   $now = time();
   // All login attempts are counted from the past 2 hours. 
   $valid_attempts = $now - (2 * 60 * 60); 
 
   if ($stmt = $mysqli->prepare("SELECT TIME FROM login_attempts WHERE USER_ID = ? AND TIME > '$valid_attempts'")) { 
      $stmt->bind_param('i', $user_id); 
      // Execute the prepared query.
      $stmt->execute();
      $stmt->store_result();
      // If there has been more than 5 failed logins
      if($stmt->num_rows > 5) {
         return true;
      } else {
         return false;
      }
   }
}

function redirect()
{
 
 // echo $_SESSION['user_id'];
  if(!isset($_SESSION['user_id']))
    header('Location:index.php');

}




function login_check($mysqli) {
   // Check if all session variables are set
   if(isset($_SESSION['user_id'], $_SESSION['login_string'])) {
     $user_id = $_SESSION['user_id'];
     $login_string = $_SESSION['login_string'];
     $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
 
     if ($stmt = $mysqli->prepare("SELECT PASSWORD FROM members WHERE ID = ? LIMIT 1")) { 
        $stmt->bind_param('i', $user_id); // Bind "$user_id" to parameter.
        $stmt->execute(); // Execute the prepared query.
        $stmt->store_result();
 
        if($stmt->num_rows == 1) { // If the user exists
           $stmt->bind_result($password); // get variables from result.
           $stmt->fetch();
           $login_check = hash('sha512', $password.$user_browser);
           if($login_check == $login_string) {
              // Logged In!!!!
              return true;
           } else {
              // Not logged in
              return false;
           }
        } else {
            // Not logged in
            return false;
        }
     } else {
        // Not logged in
        return false;
     }
   } else {
     // Not logged in
     return false;
   }
}










function parseaza_lista_fisiere_raw($lista_raw,$path){
$structure = array();
$arraypointer = &$structure;
foreach ($lista_raw as $rawfile) {
  
  //  echo $rawfile . "<br/>";
    if ($rawfile[0] == '/') {
       // echo "am";
        $paths = array_slice(explode('/', str_replace(':', '', $rawfile)), 1);
        $arraypointer = &$structure;
        foreach ($paths as $path) {
            foreach ($arraypointer as $i => $file) {
                if ($file['text'] == $path) {
                    $arraypointer = &$arraypointer[ $i ]['children'];
                    break;
                }
            }
        }
    } elseif(!empty($rawfile)) {
        $info = preg_split("/[\s]+/", $rawfile, 9);        
        $arraypointer[] = array(
            'text'   => $info[8],
            'isDir'  => $info[0]{0} == 'd',
            'size'   => byteconvert($info[4]),
            'chmod'  => chmodnum($info[0]),
            'date'   => strtotime($info[6] . ' ' . $info[5] . ' ' . $info[7]),
            'raw'    => $info,
            'path'   => $path.$info[8]."/"
            // the 'children' attribut is automatically added if the folder contains at least one file
        );
    }
}

return $arraypointer;
}








function adu_foldere($con,$path)
{
  //echo $path;
  $lista_raw = ftp_rawlist($con, $path);
//if($lista_raw! = FALSE)
  return parseaza_lista_fisiere_raw($lista_raw,$path);
//else
  //echo "e goala";

}







function byteconvert($bytes) {
  try{
    $symbol = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $exp = floor( log($bytes) / log(1024) );
 // echo pow(1024, floor($exp));
   // return sprintf( '%.2f ' . $symbol[ $exp ], ($bytes / pow(1024, floor($exp))) );
    return 0;
    }

    catch(Exception $e){

    }
}





function chmodnum($chmod) {
    $trans = array('-' => '0', 'r' => '4', 'w' => '2', 'x' => '1');
    $chmod = substr(strtr($chmod, $trans), 1);
    $array = str_split($chmod, 3);
    return array_sum(str_split($array[0])) . array_sum(str_split($array[1])) . array_sum(str_split($array[2]));
}




?>