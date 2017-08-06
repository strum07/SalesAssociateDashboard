<?php include("RecordQuote.php"); ?>



<?php
$username = "";

function __construct(){
    $this->recordquote = new RecordQuote ();}


if (isset($_POST['submit'])) {
        // Attempt Login
        $username = $_POST["username"];
        $password = $_POST["password"];

        $found_admin = $this->verifyAssociate($username, $password);

        if ($found_admin) {
            // Success
            // Mark user as logged in
            $_SESSION["admin_id"] = $found_admin["associate_id"];
            $_SESSION["username"] = $found_admin["name"];
            $this->redirect_to("index.php");
        } else {
            // Failure
            $_SESSION["message"] = "Username/password not found.";
        }

}
?>

<?php $layout_context = "admin"; ?>
<?php include("php/header.php"); ?>
<div id="main">
    <div id="navigation">
        &nbsp;
    </div>
    <div id="page">

        <h2>Login</h2>
        <form action="login.php" method="post">
            <p>Username:
                <input type="text" name="username" value="<?php echo htmlentities($username); ?>" />
            </p>
            <p>Password:
                <input type="password" name="password" value="" />
            </p>
            <input type="submit" name="submit" value="Submit" />
        </form>
    </div>
</div>
