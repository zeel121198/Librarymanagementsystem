

<?php include_once(dirname(__DIR__) . '/_config.php') ?>

<?php
    include_once(ROOT . "/includes/_connect.php");
  $conn = connect();
  if (session_status() === PHP_SESSION_NONE) session_start();
  $sql = "select (select BookName From books) AS 'Book Name', books.ISBNNumber, IssuesDate, ReturnDate
  from books inner join issuedbookdetails";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
  $stmt->execute();
  $post = $stmt->fetch();
?>




<?php include_once(ROOT . '/partials/_header.php') ?>

<div class="container">
  <header class="mt-5">

<div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Issued Books</h4>
    </div>
    

            <div class="row">
                <div class="col-md-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        
                                            <th>Book Name</th>
                                            <th>Student ID</th>
                                            <th>ISBN </th>
                                            <th>Issued Date</th>
                                            <th>Return Date</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 


$sql="Select books.BookName, users.number, books.ISBNNumber, IssuesDate, ReturnDate FROM books INNER JOIN issuedbookdetails ON books.ISBNNumber = issuedbookdetails.ISBNNumber JOIN users ON issuedbookdetails.number = users.number";
$query = $conn -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
 <tr class="odd gradeX">
 <td class="center"><?php echo htmlentities($result->BookName);?></td>
 <td class="center"><?php echo htmlentities($result->number);?></td>
   <td class="center"><?php echo htmlentities($result->ISBNNumber);?></td>
                                            <td class="center"><?php echo htmlentities($result->IssuesDate);?></td>
                                            <td class="center"><?php if($result->ReturnDate=="")
                                            {?>
                                            <span style="color:red">
                                             <?php   echo htmlentities("Not Return Yet"); ?>
                                                </span>
                                            <?php } else {
                                            echo htmlentities($result->ReturnDate);
                                        }
                                            ?></td>
                                             
                                         
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>        
 <?php include(ROOT . '/partials/_footer.php') ?>
                               
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                   
                </div>
            </div>


            
    </div>
    </div>
    </div>

