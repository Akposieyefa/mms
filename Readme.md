# online-meeting-management-system
An online meeting management system built on PHP, JS and HTML with Admin Panel, with mail notification of meeting schedules.
Classes are loaded using autoloader. PHPMailer is used for the mail function.

# Setup:
 
1. Install composer https://getcomposer.org
2. Run ```$ composer install```  to install all composer dependecies and autoloader.
3. Create a new database in MySQL.
4. Run the SQL query in "meeting_db.sql".
5. Open the file "config/Connection.php" and change the Server name, Username, Password and Database name.
6. Mail credentails are to be configured in `.env` file. `SMTP_HOST` `SMTP_PORT` `SENT_EMAIL` and `EMAIL_PASSWORD` are required global $env variables that must be provided for your mail to function properly. others are optional.  
7. Visit the home page in browser. Use the "Admin Login" link to login to Admin Panel. Default user - 'hassan.abdulrahman3333@gmail.com' pass - '1234567890'.

Use the "Login" link to login as staff or student. 

Default student - 'boblewisu@gmail.com' pass - '1234567890'.
Default staff - 'annettedixon367@gmail.com' pass - '1234567890'
Default secretary - 'secretary@gmail.com' pass - '1234567890'

# How to Use

1. Use the Admin Panel to add meetings. Choose meeting type and attendees.
2. Attendee of the meeting will get a meeting mail notification.
3. Admin can upload MOM, and only the attendee of the meeting can download the MOM. 
4. Admin can add, edit, delete users.
5. Staff and Admin can assign task to users(student).
6. All users can view their task, and submit task once done. Submitte task cannot be reversed.

# Members Type
There are `4` users in system: 
1. An Admin user membertype is `1`
2. Staff user membertype is `2`
3. Secretary user membertype is `3`
4. Student user membertype is `4`