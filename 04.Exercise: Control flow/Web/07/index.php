<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Sorting</title>

    <!--CSS-->
    <link rel="stylesheet" href="main.css">

    <!--JS-->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
    <script src="main.js"></script>
</head>
<body>
<form action="" method="post">
    <table>
        <thead>
        <tr>
            <th>First name:</th>
            <th>Last name:</th>
            <th>Email:</th>
            <th colspan="2">Exam score:</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><input type="text" name="firstName-0" id="firstName-0" title="First name" placeholder="First name"
                       value="Asen" required></td>
            <td><input type="text" name="lastName-0" id="lastName-0" title="Last name" placeholder="Last name"
                       value="Zlatarov" required>
            </td>
            <td><input type="email" name="email-0" id="email-0" title="Email" placeholder="Email"
                       value="a_zlatarov@abv.bg" required></td>
            <td><input type="number" min="0" name="score-0" id="score-0" title="Exam score" placeholder="Exam score"
                       value="350"
                       required></td>
            <td>
                <button class="removeRow">-</button>
            </td>
        </tr>
        <tr>
            <td><input type="text" name="firstName-1" id="firstName-1" title="First name" placeholder="First name"
                       value="Rosen" required></td>
            <td><input type="text" name="lastName-1" id="lastName-1" title="Last name" placeholder="Last name"
                       value="Liliev" required>
            </td>
            <td><input type="email" name="email-1" id="email-1" title="Email" placeholder="Email"
                       value="r.lilio@gmail.com" required></td>
            <td><input type="number" min="0" name="score-1" id="score-1" title="Exam score" placeholder="Exam score"
                       value="217"
                       required></td>
            <td>
                <button class="removeRow">-</button>
            </td>
        </tr>
        <tr>
            <td><input type="text" name="firstName-2" id="firstName-2" title="First name" placeholder="First name"
                       value="Petya" required></td>
            <td><input type="text" name="lastName-2" id="lastName-2" title="Last name" placeholder="Last name"
                       value="Stoyanova" required>
            </td>
            <td><input type="email" name="email-2" id="email-2" title="Email" placeholder="Email"
                       value="pepi@yahoo.com" required></td>
            <td><input type="number" min="0" name="score-2" id="score-2" title="Exam score" placeholder="Exam score"
                       value="400"
                       required></td>
            <td>
                <button class="removeRow">-</button>
            </td>
        </tr>
        <tr>
            <td><input type="text" name="firstName-2" id="firstName-2" title="First name" placeholder="First name"
                       value="Zhivko" required></td>
            <td><input type="text" name="lastName-2" id="lastName-2" title="Last name" placeholder="Last name"
                       value="Nedyalkov" required>
            </td>
            <td><input type="email" name="email-2" id="email-2" title="Email" placeholder="Email"
                       value="thebos@yahoo.com" required></td>
            <td><input type="number" min="0" name="score-2" id="score-2" title="Exam score" placeholder="Exam score"
                       value="4300"
                       required></td>
            <td>
                <button class="removeRow">-</button>
            </td>
        </tr>
        </tbody>
    </table>
    <hr>
    <div>
        <button id="add">+</button>
        <label for="sortCriteria">Sort by:</label>
        <select id="sortCriteria" name="sortCriteria">
            <option value="firstName">First Name</option>
            <option value="lastName">Last Name</option>
            <option value="email">Email</option>
            <option value="score">Exam score</option>
        </select>
        <label for="sortOrder">Order:</label>
        <select id="sortOrder" name="sortOrder">
            <option value="desc">Descending</option>
            <option value="asc">Ascending</option>
        </select>
        <input type="hidden" name="ids">
        <input type="submit">
    </div>
</form>

</body>
</html>
<?php
if (isset($_POST['ids'])) {
    $students = [];

    $ids = explode(',', trim($_POST['ids']));
    $sortCriteria = $_POST['sortCriteria'];
    $sortOrder = $_POST['sortOrder'];

    foreach ($ids as $id) {
        if (empty(trim($_POST['firstName-' . $id])))
            continue;

        $student = (object)[];
        $student->firstName = trim($_POST['firstName-' . $id]);
        $student->lastName = trim($_POST['lastName-' . $id]);
        $student->email = trim($_POST['email-' . $id]);
        $student->score = intval(trim($_POST['score-' . $id]));

        array_push($students, $student);
    }

    $sortedStudents = sortStudents($students, $sortCriteria, $sortOrder);
    printStudents($sortedStudents);
}

function sortStudents($students, $option, $order)
{
    usort($students, function ($stA, $stB) use (&$option) {
        return $stA->$option <=> $stB->$option;
    });

    if ($order === 'desc')
        $students = array_reverse($students);

    return $students;
}

function printStudents($students)
{
    $output = <<<HTML
<hr>
<h1>Results:</h1>
<table>
    <thead>
    <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Exam score</th>
    </tr>
    </thead>
    <tbody>
HTML;

    $totalScore = 0;
    foreach ($students as $student) {
        $totalScore += $student->score;
        $output .= "<tr><td>{$student->firstName}</td><td>{$student->lastName}</td><td>{$student->email}</td><td>{$student->score}</td></tr>";
    }

    $averageScore = floor($totalScore / sizeof($students));

    $output .= "<tr><td colspan='3'>Total score:</td><td>{$averageScore}</td></tr>";
    $output .= <<<HTML
    </tbody>
</table>
HTML;

    echo $output;
}