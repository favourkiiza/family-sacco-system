<?php



require('functions.php')

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>mysacco</title>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">


    <script src="assets/jquery-3.2.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</head>


<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2 menu">

                    <ul class="nav nav-sidebar">
                        <li class=" nav-active active">
                            <a href="index.php?page=dashboard"><i class="icon-home"></i><span>Dashboard</span></a>
                        </li>

                        <li class="nav-parent">
                            <a href="index.php?page=members"><i class="icon-bar-chart"></i><span>Members</span></a>

                        </li>

                        <li class="nav-parent">
                            <a href="index.php?page=contributions"><i class="icon-bar-chart"></i><span>Members Contirbutions</span></a>

                        </li>

                        <li class="nav-parent">
                            <a href="index.php?page=loans"><i class="icon-docs"></i><span>Request for Loans </span></a>

                        </li>
                        <li class="nav-parent">
                            <a href="index.php?page=investments"><i
                                        class="icon-drop"></i><span>Investment Details</span></a>

                        </li>
                        <li class="nav-parent">
                            <a href="index.php?page=Reports"><i class="icon-user"></i><span>Reports</span></a>

                        </li>


                    </ul>


                </div>
                <div class="col-md-10 main">
                    <?php


                    switch ($_GET['page']) {

                        case'dashboard' :
                            ?>

                            <div>
                                <h2 style="text-align: center;padding: 40px;font-weight: 500"> MY SACCO ADMIN
                                    PANEL.</h2>
                                <div class="row">
                                    <div class="col-xlg-4 col-lg-4 col-visitors">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel these-icons">
                                                    <div class="header-number"><?php echo $totalMembers;?></div>
                                                    <div class="header">Active Members</div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xlg-4 col-lg-4 col-visitors">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel these-icons">
                                                    <div class="header-number"><?php  echo $totalLoanedOut ?></div>
                                                    <div class="header">Amount loaned out in cash</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xlg-4 col-lg-4 col-visitors">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel these-icons">
                                                    <div class="header-number"><?php echo $totalContributed ?></div>
                                                    <div class="header">Total Contributions</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xlg-4 col-lg-4 col-visitors">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel these-icons">
                                                    <div class="header-number"><?php echo $pendingLoansNumber ;?></div>
                                                    <div class="header">Number of Loans pending approval</div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xlg-4 col-lg-4 col-visitors">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel these-icons">
                                                    <div class="header-number"><?php  echo $pendingContributionsNumber; ?></div>
                                                    <div class="header">Number of Contributions pending approval</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xlg-4 col-lg-4 col-visitors">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel these-icons">
                                                    <div class="header-number"><?php echo $approvedLoansNumber ;?></div>
                                                    <div class="header">Number of Approved Loans</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xlg-4 col-lg-4 col-visitors">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel these-icons">
                                                    <div class="header-number"><?php echo $confirmedContributionsNumber ;?></div>
                                                    <div class="header">Number of approved contributions</div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xlg-4 col-lg-4 col-visitors">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel these-icons">
                                                    <div class="header-number"><?php  echo $acceptedIdeasNumber; ?></div>
                                                    <div class="header">Number of approved Business ideas</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xlg-4 col-lg-4 col-visitors">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel these-icons">
                                                    <div class="header-number"><?php echo $pendingIdeasNumber;?></div>
                                                    <div class="header">Number of  Business ideas pending approval</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xlg-4 col-lg-4 col-visitors">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel these-icons">
                                                    <div class="header-number"><?php echo $deniedContributionsNumber ;?></div>
                                                    <div class="header">Number of rejected member contributions</div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xlg-4 col-lg-4 col-visitors">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel these-icons">
                                                    <div class="header-number"><?php echo $deniedLoansNumber;?></div>
                                                    <div class="header">Number of  rejected loan request</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php

                            break;

                        case'members':
                            ?>
                            <div class="row">
                                <h2 style="text-align: center;padding: 40px;font-weight: 500">MEMBERS</h2>

                                <div class="col-md-6 portlets">
                                    <div class="panel members">
                                        <div class="panel-header">
                                            <h3><i class="fa fa-table"></i> <strong>Members</strong></h3>
                                            <div class="control-btn">
                                                <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                                                <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                                    <i class="icon-settings"></i>
                                                </a>

                                                <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i
                                                            class="icons-office-58"></i></a>
                                                <a href="#" class="panel-maximize hidden"><i
                                                            class="icon-size-fullscreen"></i></a>
                                                <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                                                <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="panel-content">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th>Number of Shares</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                while ($row = $members->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td>" . $row["fullname"] . "</td>
                                                        <td>" . $row["username"] . " </td>
                                                         <td>" . $row["password"] . "</td>
                                                          <td>" . $row["sharesNumber"] . "</td>
                                                         </tr>";
                                                }
                                                ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 portlets">
                                    <div class="panel members">
                                        <div class="panel-header panel-controls">
                                            <h3><i class="fa fa-table"></i> <strong>Add a member</strong> Table</h3>
                                        </div>
                                        <div class="panel-content">
                                            <form method="post" id="add_user" action="functions.php?action=add_user"
                                                  role="form">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                    <div class="append-icon">
                                                        <input type="text" name="fullname" class="form-control"
                                                               minlength="3" placeholder="e.g John " required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Username</label>
                                                    <div class="append-icon">
                                                        <input type="text" name="username" class="form-control"
                                                               minlength="3" placeholder="UserName" required>
                                                        <i class="icon-user"></i>
                                                    </div>
                                                </div> <div class="form-group">
                                                    <label class="control-label">Number of Shares</label>
                                                    <div class="append-icon">
                                                        <input type="number" name="shares" class="form-control"
                                                              placeholder="shares" required>
<!--                                                        <i class="icon-user"></i>-->
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <div class="append-icon">
                                                        <input type="password" name="password" class="form-control"
                                                               minlength="3" placeholder="password" required>
                                                        <i class="icon-user"></i>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-embossed btn-primary">SAVE</button>

                                                <br>
                                                <div class="loader"></div>

                                                <br><br>

                                                <div class="alert alert-success alert-dismissable">

                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-hidden="true">
                                                        ×
                                                    </button>
                                                    Member added.
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            break;

                        case 'contributions':
                            ?>
                            <div class="row">
                                <h2 style="text-align: center;padding: 40px;font-weight: 500">MEMBER CONTRIBUTIONS</h2>

                                <div class="col-md-12 portlets">
                                    <div class="panel  members">
                                        <div class="panel-header">
                                            <h3><i class="fa fa-table"></i> <strong>CONTRIBUTIONS</strong> TABLE
                                            </h3>
                                            <div class="control-btn">
                                                <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                                                <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                                    <i class="icon-settings"></i>
                                                </a>

                                                <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i
                                                            class="icons-office-58"></i></a>
                                                <a href="#" class="panel-maximize hidden"><i
                                                            class="icon-size-fullscreen"></i></a>
                                                <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                                                <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="panel-content">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Member</th>
                                                    <th>Contribution</th>
                                                    <th>status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                while ($row = $contributions->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td>" . $row["contributor"] . "</td>
                                                        <td>" . $row["Amount"] . " </td>
                                                         <td>" . $row["status"] . "</td>"
                                                         ?>
                                                          <td><?php if($row["status"] =='pending'){?>
                                                                  <a  target="_blank" data-id="<?php  echo $row["ID"] ?>" href="functions.php?action=accept_contribution&id=<?php  echo $row["ID"] ?>">accept</a>&nbsp;| &nbsp;
                                                              <a  target="_blank" href=functions.php?action=deny_contribution&id=<?php  echo $row["ID"] ?>>deny</a><?php } ?></td>
                                                         </tr>
                                                    <?php ;
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            break;

                        case 'loans':
                            ?>
                            <div class="row">
                                <h2 style="text-align: center;padding: 40px;font-weight: 500">REQUEST FOR LOANS</h2>

                                <div class="col-md-12 portlets">
                                    <div class="panel  members">
                                        <div class="panel-header">
                                            <h3><i class="fa fa-table"></i> <strong>REQUEST FOR LOANS</strong> TABLE
                                            </h3>
                                            <div class="control-btn">
                                                <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                                                <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                                    <i class="icon-settings"></i>
                                                </a>

                                                <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i
                                                            class="icons-office-58"></i></a>
                                                <a href="#" class="panel-maximize hidden"><i
                                                            class="icon-size-fullscreen"></i></a>
                                                <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                                                <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="panel-content">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>GIven to</th>
                                                    <th>Amount</th>
                                                    <th>status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                while ($row = $loans->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td>" . $row["name"] . "</td>
                                                        <td>" . $row["amount"] . " </td>
                                                         <td>" . $row["status"] . "</td>"
                                                    ?>
                                                    <td><?php if($row["status"] =='pending'){?>
                                                            <a  target="_blank" data-id="<?php  echo $row["ID"] ?>" href="functions.php?action=accept_loan_request&id=<?php  echo $row["ID"] ?>">accept</a>&nbsp;| &nbsp;
                                                        <a  target="_blank" href=functions.php?action=deny_loan_request&id=<?php  echo $row["ID"] ?>>deny</a><?php } ?></td>
                                                    </tr>
                                                    <?php ;
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            break;

                        case 'investments':
                            ?>
                            <div class="row">
                                <h2 style="text-align: center;padding: 40px;font-weight: 500">INVESTMENTS DETAILS</h2>

                                <div class="col-md-12 portlets">
                                    <div class="panel members">
                                        <div class="panel-header">
                                            <h3><strong>ADD INVESTMENTS DETAILS</strong></h3>
                                            <div class="control-btn">
                                                <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                                                <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                                    <i class="icon-settings"></i>
                                                </a>

                                                <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i
                                                            class="icons-office-58"></i></a>
                                                <a href="#" class="panel-maximize hidden"><i
                                                            class="icon-size-fullscreen"></i></a>
                                                <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                                                <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="panel-content">
                                            <form role="form" class="form-validation" method="post" id="add_business">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Business Idea</label>
                                                            <div class="append-icon">
                                                                <textarea name="business_idea" class="form-control"
                                                                          id="" cols="20" rows="5"></textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Date of Investment</label>
                                                            <div class="append-icon">
                                                                <input type="date" name="dateOfInvestment"
                                                                       class="form-control"
                                                                       minlength="4"
                                                                       placeholder="Minimum 4 characters..." required>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Initial investment
                                                                Price</label>
                                                            <div class="append-icon">
                                                                <input type="number" name="initialInvestment"
                                                                       class="form-control"
                                                                       placeholder="price " required>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Profits percentage</label>
                                                            <div class="append-icon">
                                                                <input type="number" name="mobile" class="form-control"
                                                                       placeholder="Profits percentage">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-center  m-t-20">
                                                    <button type="submit" class="btn btn-embossed btn-primary">SAVE
                                                    </button>

                                                </div>
                                                <div class="loader"></div>

                                                <br><br>

                                                <div class="alert alert-success alert-dismissable">

                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-hidden="true">
                                                        ×
                                                    </button>
                                                    Business idea added.
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 portlets">
                                    <div class="panel  members">
                                        <div class="panel-header">
                                            <h3><i class="fa fa-table"></i> <strong>BUSINESS IDEAS</strong> TABLE
                                            </h3>
                                            <div class="control-btn">
                                                <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                                                <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                                    <i class="icon-settings"></i>
                                                </a>

                                                <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i
                                                            class="icons-office-58"></i></a>
                                                <a href="#" class="panel-maximize hidden"><i
                                                            class="icon-size-fullscreen"></i></a>
                                                <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                                                <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="panel-content">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Idea</th>
                                                    <th>Description</th>
                                                    <th>Person</th>
                                                    <th>Date of investment</th>
                                                    <th>Amount</th>
                                                    <th>status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                while ($row = $ideas->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td>" . $row["idea"] . "</td>
                                                         <td>" . $row["description"] . "</td>
                                                          <td>" . $row["name"] . "</td>
                                                        <td>" . $row["date"] . " </td>
                                                         <td>" . $row["initial"] . "</td>
                                                          <td>" . $row["status"] . "</td>"?>


                                                         <td><?php if($row["status"] =='pending'){?>
                                                             <a  target="_blank " href="functions.php?action=accept_business_idea&id=<?php  echo $row["ID"] ?>">accept</a>&nbsp;| &nbsp;
                                                             <a target="_blank " href="functions.php?action=deny_business_idea&id=<?php  echo $row["ID"] ?>">deny</a>
                                                         <?php }?></td>
                                                         </tr>
                                                <?php ;
                                                }
                                                ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br><br><br>
                            <?php

                            break;

                        case 'Reports':
                            ?>

                            <div class="row" style="margin-top: 30px">
                                <div class="col-md-12">
                                    <h2 style="text-align: center;padding: 40px;font-weight: 500">REPORTS</h2>
                                    <div class="col-xlg-4 col-financial-stocks">
                                        <div class="panel members">
                                            <div class="panel-header panel-controls">
                                                <h3><i class="icon-graph"></i> <strong>BENEFITS PER USER </strong></h3>
                                            </div>

                                            <div class="panel-content">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Full Name</th>
                                                        <th>Benefits amount</th>
                                                        <th>Benefits %</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    while ($row = $members->fetch_assoc()) { ?>
                                                     <tr>
                                                        <td><?php echo $row["fullname"];?></td>
                                                        <td> <?php if($row["sharesNumber"]== $shares [0])
                                                        { echo ($benefitsPerUser+$mostShares); } else{ echo $benefitsPerUser ;} ?>
                                                        </td>
                                                         <td>  <?php if($row["sharesNumber"]== $shares [0]){
                                                             echo ($benefitsPercentages+ 5).'%';
                                                             }
                                                         else{ echo $benefitsPercentages.'%' ;} ?></td>
                                                     </tr>
                                                    <?php
                                                    }
                                                    ?>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2 style="text-align: center;padding: 40px;font-weight: 500">LOANS PENDING APPROVAL</h2>

                                    <div class="col-md-12 portlets">
                                        <div class="panel  members">
                                            <div class="panel-header">
                                                <h3><i class="fa fa-table"></i> <strong> LOANS</strong> TABLE
                                                </h3>
                                                <div class="control-btn">
                                                    <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                                                    <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                                        <i class="icon-settings"></i>
                                                    </a>

                                                    <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i
                                                                class="icons-office-58"></i></a>
                                                    <a href="#" class="panel-maximize hidden"><i
                                                                class="icon-size-fullscreen"></i></a>
                                                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                                                    <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                                                </div>
                                            </div>
                                            <div class="panel-content">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>GIven to</th>
                                                        <th>Amount</th>
                                                        <th>status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    while ($row = $pendingLoans->fetch_assoc()) {
                                                        echo "<tr>
                                                        <td>" . $row["name"] . "</td>
                                                        <td>" . $row["amount"] . " </td>
                                                         <td>" . $row["status"] . "</td>"
                                                        ?>

                                                        <?php ;
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2 style="text-align: center;padding: 40px;font-weight: 500">MEMBER CONTRIBUTIONS PENDING APPROVAL</h2>

                                    <div class="col-md-12 portlets">
                                        <div class="panel  members">
                                            <div class="panel-header">
                                                <h3><i class="fa fa-table"></i> <strong>CONTRIBUTIONS</strong> TABLE
                                                </h3>
                                                <div class="control-btn">
                                                    <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                                                    <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                                        <i class="icon-settings"></i>
                                                    </a>

                                                    <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i
                                                                class="icons-office-58"></i></a>
                                                    <a href="#" class="panel-maximize hidden"><i
                                                                class="icon-size-fullscreen"></i></a>
                                                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                                                    <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                                                </div>
                                            </div>
                                            <div class="panel-content">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Member</th>
                                                        <th>Contribution</th>
                                                        <th>status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    while ($row = $pendingContributions->fetch_assoc()) {
                                                        echo "<tr>
                                                        <td>" . $row["contributor"] . "</td>
                                                        <td>" . $row["Amount"] . " </td>
                                                         <td>" . $row["status"] . "</td>"
                                                        ?>
                                                        <td><?php if($row["status"] =='pending'){?>
                                                                <a  target="_blank" data-id="<?php  echo $row["ID"] ?>" href="functions.php?action=accept_contribution&id=<?php  echo $row["ID"] ?>">accept</a>&nbsp;| &nbsp;
                                                            <a  target="_blank" href=functions.php?action=deny_contribution&id=<?php  echo $row["ID"] ?>>deny</a><?php } ?></td>
                                                        </tr>
                                                        <?php ;
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2 style="text-align: center;padding: 40px;font-weight: 500"> APPROVED LOANS</h2>

                                    <div class="col-md-12 portlets">
                                        <div class="panel  members">
                                            <div class="panel-header">
                                                <h3><i class="fa fa-table"></i> <strong> LOANS</strong> TABLE
                                                </h3>
                                                <div class="control-btn">
                                                    <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                                                    <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                                        <i class="icon-settings"></i>
                                                    </a>

                                                    <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i
                                                                class="icons-office-58"></i></a>
                                                    <a href="#" class="panel-maximize hidden"><i
                                                                class="icon-size-fullscreen"></i></a>
                                                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                                                    <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                                                </div>
                                            </div>
                                            <div class="panel-content">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Given to</th>
                                                        <th>Amount</th>
                                                        <th>status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    while ($row = $confirmedLoans->fetch_assoc()) {
                                                        echo "<tr>
                                                        <td>" . $row["name"] . "</td>
                                                        <td>" . $row["amount"] . " </td>
                                                         <td>" . $row["status"] . "</td>"
                                                        ?>

                                                        <?php ;
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <h2 style="text-align: center;padding: 40px;font-weight: 500">  APPROVED MEMBER CONTRIBUTIONS </h2>

                                    <div class="col-md-12 portlets">
                                        <div class="panel  members">
                                            <div class="panel-header">
                                                <h3><i class="fa fa-table"></i> <strong>CONTRIBUTIONS</strong> TABLE
                                                </h3>
                                                <div class="control-btn">
                                                    <a href="#" class="panel-reload hidden"><i class="icon-reload"></i></a>
                                                    <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                                        <i class="icon-settings"></i>
                                                    </a>

                                                    <a href="#" class="panel-popout hidden tt" title="Pop Out/In"><i
                                                                class="icons-office-58"></i></a>
                                                    <a href="#" class="panel-maximize hidden"><i
                                                                class="icon-size-fullscreen"></i></a>
                                                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                                                    <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                                                </div>
                                            </div>
                                            <div class="panel-content">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Member</th>
                                                        <th>Contribution</th>
                                                        <th>status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    while ($row = $confirmedContributions->fetch_assoc()) {
                                                        echo "<tr>
                                                        <td>" . $row["contributor"] . "</td>
                                                        <td>" . $row["Amount"] . " </td>
                                                         <td>" . $row["status"] . "</td>"
                                                        ?>
                                                        <td><?php if($row["status"] =='pending'){?>
                                                                <a  target="_blank" data-id="<?php  echo $row["ID"] ?>" href="functions.php?action=accept_contribution&id=<?php  echo $row["ID"] ?>">accept</a>&nbsp;| &nbsp;
                                                            <a  target="_blank" href=functions.php?action=deny_contribution&id=<?php  echo $row["ID"] ?>>deny</a><?php } ?></td>
                                                        </tr>
                                                        <?php ;
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            break;

                    }
                    ?>


                </div>
            </div>
        </div>
    </div>


    <footer class="footer">Copyright @2017</footer>
</div>

<script>
    $(function () {


        $('#add_user').on('submit', function (e) {

            e.preventDefault();
            $('.loader').css('display', 'block');
            $.ajax({
                type: 'post',
                url: 'functions.php?action=add_user',
                data: $('#add_user').serialize(),
                success: function (response) {
                    $('.loader').css('display', 'none');
                    $('.alert').css('display', 'block');
                    $('#add_user').reset();
                    console.log(response)
                }
            });

        });

        $('#add_business').on('submit', function (e) {

            e.preventDefault();
            $('.loader').css('display', 'block');
            $.ajax({
                type: 'post',
                url: 'functions.php?action=add_business',
                data: $('#add_business').serialize(),
                success: function (response) {
                    $('.loader').css('display', 'none');
                    $('.alert').css('display', 'block');
                    $('#add_business').reset();
                    console.log(response)
                }
            });

        });

        $('#accept_contribution').on('click', function (e) {



            e.preventDefault();
            var id = $(this).attr('data-id');
            console.log('functions.php?action=accept_contribution$id='+id)

            $('.loader').css('display', 'block');
            $.ajax({
                type: 'get',
                url: 'functions.php?action=accept_contribution$id='+id,

                success: function (response) {
                    $('.loader').css('display', 'none');
                    $('.alert').css('display', 'block');
                    console.log(response)
                }
            });

        });


    });
</script>
</body>
</html>


