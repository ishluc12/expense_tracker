
<?php
session_start();
include("connect.php");
if(strlen($_SESSION['sid']) == 0){
    header("index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
        <aside class="siddebar" id="sidebar">
            <div class="d-flex">
                <button type="button" id="toggle-btn">
                <i class="fas fa-th"></i>
                </button>
                <div class="sidebar-logo">
                   <a href="#">Dashbord</a>
                </div>
            </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                <i class="fas fa-user"></i>
                <span>Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                <i class="fas fa-tasks"></i>
                <span>Task</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" 
                  data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                     <i class="fas fa-shield-alt"></i>
                      <span>Auth</span>
                  </a>
                <ul class="sidebardropdown list-unstyled collapse" data-bs-parent="#sidebar" id="auth">
                    <li class="sidebar-items">
                    <a href="#" class="sidebar-link">Login</a>
                    </li>
                    <li class="sidebar-items">
                     <a href="#" class="sidebar-link">Register</a>
                     </li>
                </ul>
            </li>
            
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" 
                  data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                     <i class="fas fa-shield-alt"></i>
                      <span>settings</span>
                  </a>
                <ul class="sidebardropdown list-unstyled collapse" data-bs-parent="#sidebar" id="auth">
                    <li class="sidebar-items">
                    <a href="backup.php" class="sidebar-link">Login</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="adminlogin.php" class="sidebar-link">
            <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                    ...
        <form action="#" method="GET" class="d-none d-sm-inline-block">
            <div class="input-group input-group-navbar">
                <input type="text" name="search" class="form-control border-0 rounded-0" placeholder="Search...">
                <button class="btn border-0 round-0" type="submit">Search</button>
            </div>
            </form>
            ...

            <?php
                
                if(isset($_GET['search'])) {
                    
                    $search = $_GET['search'];

                    $sql = "SELECT * FROM students WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR salary LIKE '%$search%'";
                    $result = $conn->query($sql);

                    
                    if ($result->num_rows > 0) {
                      
                        while($row = $result->fetch_assoc()) {
                           
                        }
                    } else {
                        
                        echo 'No records found';
                    }
                }
            ?>


               <div class="navbar-collapse collapse">
                <?php
                $id=$_SESSION['sid'];
                $sel=mysqli_query($conn,"SELECT * FROM admin WHERE id='$id'");
                while($row=mysqli_fetch_array($sel)){   
                ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                    <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">
                            <img src="images.png" class="avatar img-fluid" alt="user">
                        </a>
                       
                            <br>
                            <h1> <?php echo $row['username'] ?> </h1>

                 <?php
                }
                ?>
               
                        <div class="dropdown-menu dropdown-menu-end rounded">
                            <a href="#" class="dropdown-item">
                            <i class="fas fa-clock"></i>
                                <span>Analytics</span>
                            </a>
                            <a href="#" class="dropdown-item">
                            <i class="fas fa-cog"></i>
                                <span>Setting</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                            <i class="fas fa-question-circle"></i>
                                <span>Analytics</span>
                            </a>
                        </div>
                    </li>
                </ul>
               </div>

            </nav>

            <main class="content px-3 py-4">
    <div class="container-fluid">
        <div class="mb-3">
            <h3 class="fw-bold fs-4 mb-3">Admin dashboard</h3>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card border-0">
                        <div class="card-body py-4">
                            <h5 class="mb-2 fw-bold">
                                Members 
                            </h5>
                            <p class="mb-2 fw-bold">
                            <?php
                $students = "students";
                $sql = "SELECT COUNT(*) as total FROM $students";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $totalRecord = $row['total'];
                    echo '<h3>Total Participants: ' . $totalRecord . '</h3>';
                } 
            ?>
                            </p>
                        </div>
                        <div class="mb-0">
                            <span class="badge text-success me-2">
                                +9.05%
                            </span>
                            <span class="fw-bold">
                                since last month
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card border-0">
                        <div class="card-body py-4">
                            <h5 class="mb-2 fw-bold">
                                Total salary
                             </h5>
                            <p class="mb-2 fw-bold">
                                $72,50
                            </p>
                        </div>
                        <div class="mb-0">
                            <span class="badge text-success me-2">
                                +9.05%
                            </span>
                            <span class="fw-bold">
                                since last month
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card border-0">
                        <div class="card-body py-4">
                            <h5 class="mb-2 fw-bold">
                                Members progress
                            </h5>
                            <p class="mb-2 fw-bold">
                                $72,50
                            </p>
                        </div>
                        <div class="mb-0">
                            <span class="badge text-success me-2">
                                +9.05%
                            </span>
                            <span class="fw-bold">
                                since last month
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="fw-bold fs-4 my-3">Avg. Agent Earnings</h3>
            <div class="row">
                <div class="col-12">
                <?php
                       
                        ?>
                        <table class="table table striped" cellpadding="10px" cellspacing="0">
                        <tr>
                            <th>ID</th>
                        <th>Names</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>salary</th>
                        <th>Action</th>


                        </tr>
                        <?php
                        $sql='SELECT * FROM students';
                        $data=mysqli_query($conn, $sql);
                        $result=mysqli_num_rows($data);
                        if($result>0){
                            while($row=mysqli_fetch_array($data)){
                                ?>
                                <tr>
                                <td><?php echo $row ['stud_id'];?></td>
                                    <td><?php echo $row ['name'];?></td>
                                    <td><?php echo $row ['email'];?></td>
                                    <td><?php echo $row ['phone'];?></td>
                                    <td><?php echo $row ['salary'];?></td>
                                    <td><a class="btn bg-success px-3 text-decoration-none text-white" href="edit.php?id=<?php echo $row['stud_id'];?>">Update</a></td>
                                    <td><a class="btn bg-danger px-3 text-decoration-none text-white" onclick="return confirm('Are you sure u want to delete?')" href="delete.php?id=<?php echo $row['stud_id'];?>">Delete</a></td>
                                    
                                </tr>
                                <?php
                            } 
                                }
                                else {
                                    ?>
                                echo 'no record found';
                                <?php
                            }


                        ?>
                        </table>
                </div>
            </div>
        </div>
    </div>
</main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-body-secondary">
                        <div class="col-6 text-start">
                            <a href="#" class="text-body-secondary">
                                <strong>Expense Tracker</strong>
                            </a>
                            <div class="col-6 text-end text-body-secondary d-none d-md-block">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="#" class="text-body-secondary">
                                        <i class="fas fa-phone"></i>    
                                        Contact</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="text-body-secondary">
                                        <i class="fas fa-info-circle about-icon"></i>    
                                        About us</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="text-body-secondary">Termst & condition</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <script src="script.js">
        function searchUsers() {
  var searchTerm = document.getElementById("searchInput").value.toLowerCase();
  var tableBody = document.querySelector(".table tbody");
  var rows = tableBody.querySelectorAll("tr");

  for (var i = 0; i < rows.length; i++) {
    var row = rows[i];
    var nameCell = row.querySelector("td:nth-child(2)"); // Adjust selector based on your name column
    var emailCell = row.querySelector("td:nth-child(3)"); // Adjust selector based on your email column
    var textContent = nameCell.textContent.toLowerCase() + emailCell.textContent.toLowerCase();
    if (textContent.indexOf(searchTerm) !== -1) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  }
}
    </script>
</body>
</html>

<?php
        
?>