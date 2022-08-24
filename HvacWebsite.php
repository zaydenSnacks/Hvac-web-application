<head> 
</head>
<header>
    <h1>Zayden's HVAC services</h1>
</header>
<script type="text/javascript" src="controller.js"> </script>
<body>
    <hr>
    <h2> Login </h2>
    <form action="controller.php" method="post">
        <label for="email_address">Email Address</label>
        <input type="email" id="email_address" name="email_address" required><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required><br>
        <input type="hidden" name="action" value="login">
        <input type="submit" value="submit">
    </form>
    <hr>
    <div id="about_us_container">
        <h2>About Us</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi non nibh consectetur, pulvinar diam et, lobortis odio. Nullam in tellus nibh. Suspendisse tincidunt malesuada nibh, nec dictum dolor dictum tincidunt. Curabitur in velit id ante lobortis tincidunt. Integer quis feugiat urna, sit amet facilisis nunc. Nulla iaculis commodo ante, sit amet ultricies purus aliquam eu. Morbi at pellentesque orci. Suspendisse hendrerit euismod vulputate. Integer ultricies rutrum nisi eget condimentum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi non nibh consectetur, pulvinar diam et, lobortis odio. Nullam in tellus nibh. Suspendisse tincidunt malesuada nibh, nec dictum dolor dictum tincidunt. Curabitur in velit id ante lobortis tincidunt. Integer quis feugiat urna, sit amet facilisis nunc. Nulla iaculis commodo ante, sit amet ultricies purus aliquam eu. Morbi at pellentesque orci. Suspendisse hendrerit euismod vulputate. Integer ultricies rutrum nisi eget condimentum.</p>
    </div>
    <div id="services_container">
        <hr>
        <h2>Services</h2>
        <ul>
            <li>Lorem ipsum dolor sit amet,</li>
            <li>Lorem ipsum dolor sit amet,</li>
            <li>Lorem ipsum dolor sit amet,</li>
            <li>Lorem ipsum dolor sit amet,</li>
        </ul>
    </div>
    <hr>
    <div id="contact_us_container">
        <h2>Contact Us </h2>
        <h3>1-800-952-7236</h3>
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
            <label for="problem">How can we help?</label><br>
            <textarea id="problem" name="problem" rows="4" cols="50" required></textarea><br>
            <input type="hidden" name="action" value="create_user">
            <input type="submit" value="submit"/>
            <div id="thank_you_message" style="display: none">Thank you for contacing us.</div>
        </form>
    </div>
</body>