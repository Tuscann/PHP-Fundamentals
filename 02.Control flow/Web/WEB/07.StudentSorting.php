<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Student Info</title>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script>
            function AddField(){
                var field = '<tr class="field"><td><input type="text" name="fName[]" required="true"></td><td><input type="text" name="lName[]" required="true"></td><td><input type="text" name="email[]" required="true"></td><td><input type="number" name="score[]" required="true"></td><td><button type="button">-</button></td></tr>';
                
                var lastField = $('.field').last();
                
                $(field).insertAfter(lastField);
            }
        </script>
    </head>
    <body>
        <form action="07.StudentSorting.php" method="post">
            <table>
                <tr>
                    <th>First Name:</th>
                    <th>Last Name:</th>
                    <th>Email:</th>
                    <th>Exam Score:</th>
                </tr>
                <tr class="field">
                    <td><input type="text" name="fName[]" required="true"></td>
                    <td><input type="text" name="lName[]" required="true"></td>
                    <td><input type="text" name="email[]" required="true"></td>
                    <td><input type="number" name="score[]" required="true"></td>
                    <td><button type="button">-</button></td>
                </tr>
            </table>
            
            
            <button onClick="AddField()" type="button" name="button">+</button>
            Sort By:
            <select name="sort">
                <option value="firstName">First Name</option>
                <option value="lastName">Last Name</option>
                <option value="email">Email</option>
                <option value="exam">Exam</option>
            </select> 
              
            Order: 
            <select name="order">
                <option value="Ascending">Ascending</option>
                <option value="Descending">Descending</option>
            </select>
            <input type="submit" name="submit">
        </form>
        
        <table>
            <?php
            file_get_contents('php://input');
            if (isset($_POST['submit'])) {
                //Print headers of table
                echo "<tr>
                    <th>First Name:</th>
                    <th>Last Name:</th>
                    <th>Email:</th>
                    <th>Exam Score:</th>
                </tr>";
                
                //Get elements
                $sortBy = $_POST['sort'];
                echo "<h2>{$sortBy}</h2>";
                $order = $_POST['order'];
                echo "<h2>{$order}</h2>";
                
                $firstNames = $_POST['fName'];
                $lastNames = $_POST['lName'];
                $emails = $_POST['email'];
                $scores = $_POST['score'];
                
                $students = [];
                //Put all the students in one array
                for ($i=0; $i < count($firstNames); $i++) { 
                    array_push($students, [
                        "FirstName" => $firstNames[$i],
                        "LastName" => $lastNames[$i],
                        "Email" => $emails[$i],
                        "Score" => $scores[$i]
                    ]);
                }
                
                switch ($order) {
                    case 'Descending':
                        if ($sortBy == "firstName") {
                            usort($students, function($x, $y) {
                                return strcasecmp($x['FirstName'], $y['FirstName']);
                            });
                        } elseif ($sortBy == "lastName") {
                            usort($students, function($x, $y) {
                                return strcasecmp($x['LastName'], $y['LastName']);
                            });
                        } elseif ($sortBy == "email") {
                            usort($students, function($x, $y) {
                                return strcasecmp($x['Email'], $y['Email']);
                            });
                        } elseif ($sortBy == "score") {
                            usort($students, function($a, $b){ return $a['Score'] > $b['Score']; });
                        }
                        break;
                    //---------------------------------------------------
                    //---------------------------------------------------
                    //---------------------------------------------------
                    //---------------------------------------------------
                    
                    case 'Ascending':
                        if ($sortBy == "firstName") {
                            usort($students, function($x, $y) {
                                return strcasecmp($x['FirstName'], $y['FirstName']);
                            });
                        } elseif ($sortBy == "lastName") {
                            usort($students, function($x, $y) {
                                return strcasecmp($x['LastName'], $y['LastName']);
                            });
                        } elseif ($sortBy == "email") {
                            usort($students, function($x, $y) {
                                return strcasecmp($x['Email'], $y['Email']);
                            });
                        } elseif ($sortBy == "score") {
                            usort($students, function($a, $b){ return $a['Score'] > $b['Score']; });
                        }
                        break;
                }
                
                foreach ($students as $student) {
                    echo "<tr>
                            <td>{$student['FirstName']}</td>
                            <td>{$student['LastName']}</td>
                            <td>{$student['Email']}</td>
                            <td>{$student['Score']}</td>";
                }
                
            }
            ?>
        </table>
        
    </body>
</html>