<head> 
</head>
<header>
    <h1> Welcome Admin: <?php echo " ".$_SESSION['firstName'];?> </h1>
</header>
<script type="text/javascript" src="controller.js"> </script>
<body>
    <hr>
    <form action="controller.php" method="post">
        <input type="hidden" name="action" value="home_page"/>
        <input type="submit" value="logout"/>
    </form>
    <hr>
    <div id="contact_us_container">
        <h3> Enter Users: </h3>
        <form action="controller.php" method="post">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required><br>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required><br>
            <label for="email_address">Email Address</label>
            <input type="email" id="email_address" name="email_address" required><br>
            <label for="phone_number">Phone Number</label>
            <input type="tel" id="phone_number" name="phone_number" required><br>
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required><br>
            <label for="zip_code">Zip Code</label>
            <input type="number" id="zip_code" name="zip_code" required><br>
            <label for="problem">Problem</label><br>
            <textarea id="problem" name="problem" rows="4" cols="50" required></textarea><br>
            <input type="hidden" name="action" value="create_user">
            <input type="submit" value="submit"/>
        </form>
    </div>
    <hr>
    <div id="create_employee_container">
        <h3> Enter new Employee: </h3>
        <form action="controller.php" method="post">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required><br>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required><br>
            <label for="email_address">Email Address</label>
            <input type="email" id="email_address" name="email_address" required><br>
            <label for="phone_number">Phone Number</label>
            <input type="tel" id="phone_number" name="phone_number" required><br>
            <label for="password">Password</label>
            <input type="text" id="password" name="password" required><br>
            <input type="hidden" name="action" value="create_employee">
            <input type="submit" value="submit"/>
        </form>
    </div>
    <hr>
    <div id="user_look_up_container">
        <h3>User look up:</h3>
        <form action="controller.php" method="post">
        <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name"><br>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name"><br>
            <label for="email_address">Email Address</label>
            <input type="email" id="email_address" name="email_address"><br>
            <input type="hidden" name="action" value="user_look_up">
            <input type="submit" value="submit"/>
        </form>
    </div>

    <div id="users_container">
        <?php if(isset($_SESSION['user_look_up'])): ?>
            <? foreach ($_SESSION['user_look_up'] as $key):?>
            <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th> 
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Account Balance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <?php echo $key['employeeId'];?> </td>
                    <td> <?php echo $key['userId'];?> </td>
                    <td> <?php echo $key['firstName'];?> </td>
                    <td> <?php echo $key['lastName'];?></td>
                    <td> <?php echo $key['emailAddress'];?></td>
                    <td> <?php echo $key['phoneNumber'];?></td>
                    <td> <?php echo $key['address'];?></td> 
                    <td> <?php if ($key['date'] == null) {echo null;} else {echo $key['date'];};?> </td>
                    <td> <?php if ($key['time'] == null) {echo null;} else {echo $key['time'];};?></td>

                    <td> <?php if ($key['balance'] == null) {echo null;} else {echo $key['balance'];};?></td>
                </tr>
                <hr>
            </tbody>
            </table>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <hr>
    <div id="user_enter_appointments_container">
        <h3>Enter appointments for users:</h3>
        <form action="controller.php" method="post">
        <label for="user_id">User Id</label>
            <input type="text" id="user_id" name="user_id"><br>
            <label for="date">Date (YYYY-MM-DD)</label>
            <input type="text" id="date" name="date"><br>
            <label for="time">Time</label>
            <input type="text" id="time" name="time"><br>
            <input type="hidden" name="action" value="user_enter_appointments">
            <input type="submit" value="submit"/>
        </form>
    </div>
    <hr>

    <div id="view_employees_container">
    <h3>Employee look up:</h3>
        <form action="controller.php" method="post">
        <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name"><br>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name"><br>
            <label for="email_address">Email Address</label>
            <input type="email" id="email_address" name="email_address"><br>
            <input type="hidden" name="action" value="view_employees">
            <input type="submit" value="submit"/>
        </form>
    </div>
    <div id="employees_container">
        <?php if(isset($_SESSION['view_employees'])): ?>
            <? foreach ($_SESSION['view_employees'] as $key):?>
            <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <?php echo $key['employeeId'];?> </td>
                    <td> <?php echo $key['firstName'];?> </td>
                    <td> <?php echo $key['lastName'];?></td>
                    <td> <?php echo $key['emailAddress'];?></td>
                    <td> <?php echo $key['phoneNumber'];?></td>
                    <td> <?php if ($key['date'] == null) {echo null;} else {echo $key['date'];};?> </td>
                    <td> <?php if ($key['time'] == null) {echo null;} else {echo $key['time'];};?></td>
                </tr>
                <hr>
            </tbody>
            </table>
            <?php endforeach;?>
        <?php endif; ?>
    </div>

    <hr>
    <div id="empployee_enter_appointments_container">
        <h3>Assign employee to appointment:</h3>
        <form action="controller.php" method="post">
        <label for="employee_id">Employee Id</label>
            <input type="text" id="employee_id" name="employee_id" required><br>
            <label for="user_id">User Id</label>
            <input type="text" id="user_id" name="user_id" required><br>
            <input type="hidden" name="action" value="employee_enter_appointments">
            <input type="submit" value="submit"/>
        </form>
    </div>
    <hr>
    <div id="account_balance_container">
        <h3>Create quote for User</h3>
        <form action="controller.php" method="post">
        <label for="user_id">User Id</label>
            <input type="text" id="user_id" name="user_id" required><br>
            <label for="amount">Amount due</label>
            <input type="text" id="amount" name="amount" required><br>
            <input type="hidden" name="action" value="enter_account_balance">
            <input type="submit" value="submit"/>
        </form>
    </div>
    <hr>
    <div id="hvac_stock_container">
        <h3>Check hvacs in stock </h3>
        <form action="controller.php" method="post">
        <label for="model">Model</label>
            <input type="text" id="model" name="model"><br>
            <label for="type">Type</label>
            <input type="text" id="type" name="type"><br>
            <input type="hidden" name="action" value="hvac_stock">
            <input type="submit" value="submit"/>
        </form>
    </div>
    <?php if(isset($_SESSION['hvac_stock'])): ?>
            <? foreach ($_SESSION['hvac_stock'] as $key):?>
            <table>
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Amount in Stock</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <?php echo $key['serialNumber'];?> </td>
                    <td> <?php echo $key['Model'];?> </td>
                    <td> <?php echo $key['hvacType'];?></td>
                    <td> <?php echo $key['numberOf'];?></td>
                </tr>
                <hr>
            </tbody>
            </table>
            <?php endforeach;?>
        <?php endif; ?>

</body>