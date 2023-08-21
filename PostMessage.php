<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Message</title>
</head>
<body style="">
    <?php
        // Check first to see if the form has even been submitted
        if(isset($_POST["submit"])) {
            $name = stripslashes($_POST["name"]);
            $subject = stripslashes($_POST["subject"]);
            $message = stripslashes($_POST["message"]);

            // replace any '~' with '-' characters
            $name = str_replace("~", "-", $name);
            $subject = str_replace("~", "-", $subject);
            $message = str_replace("~", "-", $message);

            // combine the three variables into one string
            $messageRecord = "$name~$subject~$message\n";

            // let's create a variable to store a new file's data
            $messageFile = fopen("messages.txt", "a");

            // check that there are no issues with the file before we add the new message to it
            if($messageFile === false) {
                echo "<h3 style='color: red;'>There was an error saving your message!</h3>";
            } else {
                fwrite($messageFile, $messageRecord);
                fclose($messageFile);
                echo "<h3>Your message has been saved!</h3>";
            } // end of if/else

        } // end of main if statement

    ?>

    <h1>Post New Message</h1>
    <hr/>
    <form action="PostMessage.php" method="post">
        <label style="font-weight: bold;" for="user">User's Name:</label>
        <input type="text" id="user" name="name" />
        <br/>
        <br/>
        <label style="font-weight: bold;" for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" />
        <br/>
        <br/>
        <textarea name="message" cols="80" rows="6"></textarea>
        <br/>
        <br/>
        <input type="submit" name="submit" value="Post Message" /> &nbsp; &nbsp;<input type="reset" value="Reset Form" />
    </form>
    <hr/>
    <p><a href="MessageBoard.php">View Messages</a></p>
</body>
</html>