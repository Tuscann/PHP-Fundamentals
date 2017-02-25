<form action="" method="get">
    <fieldset>
        <legend>Personal Information</legend>
        <input type="text" name="firstname" placeholder="First Name" required><br>
        <input type="text" name="lastname" placeholder="Last Name" required><br>
        <input type="text" name="email" placeholder="Email" required><br>
        <input type="number" name="phoneNumber" placeholder="Phone number" required><br>

        <div>
            <label for="female">Female </label>
            <input type="radio" name="gender" id="female" value="female">
            <label for="male">Male </label>
            <input type="radio" name="gender" id="male" value="male">
        </div>

        <div>
            <div><label>Birth Date</label></div>
            <input type="text" id="birthDate" name="birthDate" placeholder="dd/mm/yyyy" required>
        </div>

        <div>
            <div><label>Nationality</label></div>
            <select name="nationality" id="nationality" required>
                <option value="Bulgarian">Bulgarian</option>
                <option value="Indian">Indian</option>
                <option value="american">USA</option>
            </select>
        </div>

    </fieldset>

    <fieldset>
        <legend>Last Work Postion</legend>
        <div>
            <label>Company Name</label>
            <input type="text" name="companyname" required>
        </div>
        <div>
            <label>From</label>
            <input type="text" name="startdate" placeholder="dd/mm/yyyy" required>
        </div>
        <div>
            <label>To</label>
            <input type="text" name="enddate" placeholder="dd/mm/yyyy" required>
        </div>
    </fieldset>

    <fieldset>
        <legend>Computer Skills</legend>
        <div>
            <label>Programming Languages</label>
        </div>
        <div>
            <input type="text" name="inputname" required>
        </div>
        <div>
            <input type="text" name="language[]" id="language" required>
            <select name="languageLevel[]" id="languageLevel" required>
                <option value="Beginner">Beginner</option>
            </select>
        </div>
        <div>
            <input type="text" name="language[]" id="language">
            <select name="languageLevel[]" id="languageLevel">
                <option value="Beginner">Programmer</option>
            </select>
        </div>
        <div>
            <input type="text" name="language[]" id="language">
            <select name="languageLevel[]" id="languageLevel">
                <option value="Beginner">Ninja</option>
            </select>
        </div>
    </fieldset>

    <fieldset>
        <legend>Other Skills</legend>

        <div>
            <div><label for="otherLang">Languages</label></div>
            <input type="text" name="otherLang[]" id="otherLang" required>
            <select name="comprehension[]">
                <option selected>-Comprehension-</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <select name="reading[]">
                <option selected>-Reading-</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <select name="writing[]">
                <option selected>-Writing-</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
        </div>
        <div>
            <div><label for="otherLang">Languages</label></div>
            <input type="text" name="otherLang[]" id="otherLang">
            <select name="comprehension[]">
                <option selected>-Comprehension-</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <select name="reading[]">
                <option selected>-Reading-</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <select name="writing[]">
                <option selected>-Writing-</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
        </div>
        <div>
            <div><label for="otherLang">Languages</label></div>
            <input type="text" name="otherLang[]" id="otherLang">
            <select name="comprehension[]">
                <option selected>-Comprehension-</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <select name="reading[]">
                <option selected>-Reading-</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <select name="writing[]">
                <option selected>-Writing-</option>
                <option value="beginner" selected>Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
        </div>
        <div>
            <div><label for="driversLicense">Driver's License</label></div>
            B <input type="checkbox" name="drivingLicense[]" value="B">
            A <input type="checkbox" name="drivingLicense[]" value="A">
            C <input type="checkbox" name="drivingLicense[]" value="C">
        </div>

    </fieldset>

    <input type="submit" name="submit" value="Generate CV">
</form>


<?php
if ($_GET['submit']) {
    $firstName = $_GET['firstname'] . "<br>";
    $lastName = $_GET['lastname'] . "<br>";
    $email = $_GET['email'] . "<br>";
    $phoneNumber = intval($_GET['phoneNumber']) . "<br>";
    $gender = $_GET['gender'] . "<br>";
    $birthDate = intval($_GET['birthDate']) . "<br>";
    $nationality = $_GET['nationality'] . "<br>";


    $companyName = $_GET['companyname'] . "<br>";
    $startDate = $_GET['startdate'] . "<br>";
    $endDate = $_GET['enddate'] . "<br>";







} ?>
<?php if (isset($_GET['submit']) == true): ?>


    <table border="1px" cellspacing="2px" cellpadding="5px">
        <tr>
            <th colspan="2">Personal Information</th>
        </tr>
        <tr>
            <td>First Name</td>
            <td><?= $firstName ?></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><?= $lastName ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?= $email ?></td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td><?= $phoneNumber ?></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td><?= $gender ?></td>
        </tr>
        <tr>
            <td>Birth Date</td>
            <td><?= $birthDate ?></td>
        </tr>
        <tr>
            <td>Nationality</td>
            <td><?= $nationality ?></td>
        </tr>
    </table>
    <br>
    <table border="1px" cellspacing="2px" cellpadding="5px">
        <tr>
            <th colspan="2">Last Work Position</th>
        </tr>

    </table>
    <br>
    <table border="1px" cellspacing="2px" cellpadding="5px">
        <tr>
            <th colspan="3">Computer Skills</th>
        </tr>


    </table>
    <br>
    <table border="1px" cellspacing="2px" cellpadding="5px">
        <tr>
            <th colspan="5">Other Skills</th>
        </tr>
        <tr>
            <td>Languages</td>
            <td>

            </td>
        </tr>
        <tr>
            <td>Drivers License</td>
            <td colspan="4"><?=   implode(", ", $drivingLincenses)   ?>
            </td>
        </tr>

    </table>
<?php endif; ?>