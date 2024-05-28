function checkEmailExists() {
    const email= document.getElementById('email').value;
    // Assuming you have a database connection and a table named 'users'
    // with a column named 'email' that stores the email addresses

    // Your database query to check if the email exists
    const query = `SELECT COUNT(*) AS count FROM homie.user_data WHERE email = '${email}'`;

    // Execute the query and get the result
    const result = executeQuery(query);

    // Check if the email exists in the database
    if (result.count > 0) {
        var emailError = 'This email is already registered';
        document.getElementById('email_error').innerHTML = emailError;
    } 
}