<?php

error_reporting(0);

$servername = "localhost";
$username = "root";
$password = "123456";
$database = "FamilySaccoDB";

$action = '';
$contributionsFile = "C:/Users/sam/Desktop/contributions.txt";
$loansFile = "C:/Users/sam/Desktop/loans.txt";
$ideasFIle = "C:/Users/sam/Desktop/ideas.txt";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// function to get total contributions
$contributionSqlSql = "SELECT SUM(amount) AS TotalContributions FROM contributions where status = 'confirmed'";
$test1 = mysqli_fetch_array($conn->query($contributionSqlSql));
$totalContributed = $test1[0];


// function to get all members
$sql = "SELECT *  FROM members";
$members = $conn->query($sql);
$totalMembers = mysqli_num_rows($members);


$maxSharesSql = "SELECT MAX(sharesNumber) as max_id FROM members";
$shares = mysqli_fetch_array($conn->query($maxSharesSql));

// get benefits for person with maximum shares
$mostShares = ((5 / 100) * $totalContributed);


$benefits = ((25 / 100) * $totalContributed);
$benefitsPerUser = (($totalContributed - $benefits) / $totalMembers);
$benefitsPercentages = (($benefitsPerUser / $totalContributed) * 100);


//function to get all loans pending approval
$pendingloanSql = "SELECT *  FROM loans where status ='pending'";
$pendingLoans = $conn->query($pendingloanSql);
$pendingLoansNumber = mysqli_num_rows($pendingLoans);

//function to get all loans pending approval
$deniedloanSql = "SELECT *  FROM loans where status ='denied'";
$deniedLoans = $conn->query($deniedloanSql);
$deniedLoansNumber = mysqli_num_rows($deniedLoans);

// function to get all members
$pendingContributionsSql = "SELECT *  FROM contributions where status ='pending'";
$pendingContributions = $conn->query($pendingContributionsSql);
$pendingContributionsNumber = mysqli_num_rows($pendingContributions);

// function to get all members
$deniedContributionsSql = "SELECT *  FROM contributions where status ='denied'";
$deniedContributions = $conn->query($deniedContributionsSql);
$deniedContributionsNumber = mysqli_num_rows($deniedContributions);

//function to get all loans pending approval
$confirmedloanSql = "SELECT *  FROM loans where status ='accepted'";
$confirmedLoans = $conn->query($confirmedloanSql);
$approvedLoansNumber = mysqli_num_rows($confirmedLoans);

// function to get all members
$confirmedContributionsSql = "SELECT *  FROM contributions where status ='confirmed'";
$confirmedContributions = $conn->query($confirmedContributionsSql);
$confirmedContributionsNumber = mysqli_num_rows($confirmedContributions);

// function to get all pending ideas
$pendingIdeaSql = "SELECT *  FROM ideas where status ='pending'";
$pendingIdeas = $conn->query($pendingIdeaSql);
$pendingIdeasNumber = mysqli_num_rows($pendingIdeas);

// function to get all pending ideas
$acceptedIdeaSql = "SELECT *  FROM ideas where status ='accepted'";
$acceptedIdeas = $conn->query($acceptedIdeaSql);
$acceptedIdeasNumber = mysqli_num_rows($acceptedIdeas);


// function to know the clicked page

if (isset($_GET['page'])) {


    switch ($_GET['page']) {
        // get all member contributions


        case'dashboard':

            if (filesize($contributionsFile) == 0) {
            } else {
                /// get members contributions from the text files
                $handle = @fopen($contributionsFile, "r"); //read line one by one
                $values = '';

                while (!feof($handle)) // Loop til end of file.
                {
                    $buffer = fgets($handle, 4096); // Read a line.

                    if (strlen($buffer) > 0) {
                        list($type, $amount, $receipt, $name, $date) = explode(" ", $buffer);//Separate string by the means of |

                        $sql = 'INSERT INTO contributions (contributor, Amount,date,receipt_number,status) VALUES ("' . str_replace("|", "", $name) . '","' . $amount
                            . '","' . $date . '","' . $receipt . '","pending")';

                        $contributions = $conn->query($sql);

                    } else {

                    }


                }
                fclose($handle);
                file_put_contents($contributionsFile, "");

            }


            // function to get amount loaned out in cash
            $loansSql = "SELECT SUM(amount) AS TotalItemsOrdered FROM loans where status = 'accepted'";
            $test1 = mysqli_fetch_array($conn->query($loansSql));
            $totalLoanedOut = $test1[0];

            // function to get total contributions
            $contributionSqlSql = "SELECT SUM(amount) AS TotalContributions FROM contributions where status = 'confirmed'";
            $test1 = mysqli_fetch_array($conn->query($contributionSqlSql));
            $totalContributed = $test1[0];


            break;

        case 'contributions':
            // function to get all members
            $contributionsSql = "SELECT *  FROM contributions";
            $contributions = $conn->query($contributionsSql);
            break;

        case 'members':
            // function to get all members
            $sql = "SELECT *  FROM members";
            $members = $conn->query($sql);
            break;

        case'investments':


            if (filesize($ideasFIle) == 0) {

            } else {
                /// get members contributions from the text files
                $handle = @fopen($ideasFIle, "r"); //read line one by one
                $values = '';

                while (!feof($handle)) // Loop til end of file.
                {
                    $buffer = fgets($handle, 4096); // Read a line.


                    if (strlen($buffer) > 0) {

                        list($type, $idea, $initial, $description, $name, $date) = explode(" ", $buffer);//Separate string by the means of |


                        $newDesc = str_replace("|", "", $description);
                        $newName = str_replace("|", " ", $name);




                        $sql = 'INSERT INTO ideas (idea, description, name, date, initial, status )VALUES (
                        "' . $idea . '",
                        "' . str_replace("-", " ", $newDesc) . '",
                        "' . str_replace("-", " ", $newName) . '",
                        "' . $date . '",
                        "' . $initial . '",
                        "pending")';

                        $ideas = $conn->query($sql);
                    } else {


                    }


                }
                fclose($handle);
                file_put_contents($ideasFIle, "");

            }



            // function to get all business ideas
            $ideasSql = "SELECT *  FROM ideas";
            $ideas = $conn->query($ideasSql);


            break;

        case 'loans':
            if (filesize($loansFile) == 0) {
            } else {
                /// get members contributions from the text files
                $handle = @fopen($loansFile, "r"); //read line one by one
                $values = '';

                while (!feof($handle)) // Loop til end of file.
                {
                    $buffer = fgets($handle, 4096); // Read a line.

                    if (strlen($buffer) > 0) {
                        list($type, $next, $amount, $name, $date) = explode(" ", $buffer);//Separate string by the means of |
                        $sql = 'INSERT INTO loans (name, amount, PaymentDate, status) VALUES ("' . str_replace("|", "", $name) . '","' . $amount . '",
                "' . $date . '","pending")';

                        $contributions = $conn->query($sql);

                    } else {

                    }


                }
                fclose($handle);
                file_put_contents($loansFile, "");

            }




            // function to get all business ideas
            $ideasSql = "SELECT *  FROM loans";
            $loans = $conn->query($ideasSql);


            break;

        case 'Reports':
            // function to get all members
            $sql = "SELECT *  FROM members";
            $members = $conn->query($sql);

            break;


    }
}


// function to submit forms
if (isset($_GET['action'])) {

    switch ($_GET['action']) {

        // function to add a user
        case 'add_user':
            $full_name = $_POST['fullname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $shares = $_POST['shares'];

            echo $shares;


            $sql = 'INSERT INTO members (fullname, username, password, sharesNumber)VALUES (
                        "' . $full_name . '",
                        "' . $username . '",
                        "' . $password . '",
                        "' . $shares . '")
                      ';
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo $conn->error;
            }

            break;


        // function to add a business idea
        case 'add_business';

            echo $_GET['action'];

            $limit = ($totalContributed / 2);
            $business = $_POST['business_idea'];
            $business_date = $_POST['dateOfInvestment'];
            $initial = $_POST['initialInvestment'];


            if ($_POST['initialInvestment'] > $limit) {

                $sql = 'INSERT INTO ideas (idea, date, initial,status)VALUES ("' . $business . '","' . $business_date . '","' . $initial . '","denied")';
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
//                    header('location:'index.php?action='add_business');
                } else {
                    echo $conn->error;
                }
                break;
            } else {
                $sql = 'INSERT INTO ideas (idea, date, initial,status)VALUES ("' . $business . '","' . $business_date . '","' . $initial . '","pending")';
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo $conn->error;
                }
                break;
            }


        case 'accept_contribution':


            $contribution_id = $_GET['id'];
            $contributionSql = "SELECT *  FROM contributions WHERE  ID =  $contribution_id ";
            $result = $conn->query($contributionSql);

            if (mysqli_num_rows($result) > 0) {


                $sql = "UPDATE contributions SET status = 'confirmed' WHERE ID =  $contribution_id  ";
                if ($conn->query($sql) === TRUE) {
                    echo "record updated";
                } else {
                    echo $conn->error;
                }
            }

            break;

        case 'deny_contribution':

            $contribution_id = $_GET['id'];
            $contributionSql = "SELECT *  FROM contributions WHERE  ID =  $contribution_id ";
            $result = $conn->query($contributionSql);

            if (mysqli_num_rows($result) > 0) {


                $sql = " UPDATE contributions SET status = 'denied' WHERE ID =  $contribution_id  ";
                if ($conn->query($sql) === TRUE) {
                    echo "record updated";
                } else {
                    echo $conn->error;
                }
            }

            break;

        case 'accept_business_idea':

            $contribution_id = $_GET['id'];
            $contributionSql = "SELECT *  FROM ideas WHERE  ID =  $contribution_id ";
            $result = $conn->query($contributionSql);

            if (mysqli_num_rows($result) > 0) {


                $sql = " UPDATE ideas SET status = 'accepted' WHERE ID =  $contribution_id  ";
                if ($conn->query($sql) === TRUE) {
                    echo "record updated";
                } else {
                    echo $conn->error;
                }
            }

            break;

        case 'deny_business_idea':

            $contribution_id = $_GET['id'];
            $contributionSql = "SELECT *  FROM ideas WHERE  ID =  $contribution_id";
            $result = $conn->query($contributionSql);

            if (mysqli_num_rows($result) > 0) {


                $sql = " UPDATE ideas  SET status = 'denied' WHERE ID =$contribution_id";
                if ($conn->query($sql) === TRUE) {
                    echo "record updated";
                } else {
                    echo $conn->error;
                }
            }

            break;
        case 'accept_loan_request':

            $contribution_id = $_GET['id'];
            $contributionSql = "SELECT *  FROM loans WHERE  ID =  $contribution_id";
            $result = $conn->query($contributionSql);

            if (mysqli_num_rows($result) > 0) {


                $sql = " UPDATE loans  SET status = 'accepted' WHERE ID =$contribution_id";
                if ($conn->query($sql) === TRUE) {
                    echo "record updated";
                } else {
                    echo $conn->error;
                }
            }

            break;

        case 'deny_loan_request':

            $contribution_id = $_GET['id'];
            $contributionSql = "SELECT *  FROM ideas WHERE  ID =  $contribution_id";
            $result = $conn->query($contributionSql);

            if (mysqli_num_rows($result) > 0) {


                $sql = " UPDATE loans  SET status = 'denied' WHERE ID =$contribution_id";
                if ($conn->query($sql) === TRUE) {
                    echo "record updated";
                } else {
                    echo $conn->error;
                }
            }

            break;


    }

}


?>


