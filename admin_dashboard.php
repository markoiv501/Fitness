<?php
require_once 'config.php';

    
if(!isset($_SESSION['adminov_id'])){
  header('location: index.php');
} 
?>
<html>
  <head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="general.css" />
    <link rel="stylesheet" href="style-admindash.css" />
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  </head>
  <body>
    <header class="header" >
      <a href="#">
        <img class="logo" src="logo/logo-white.png" alt="Fitness logo" />
      </a>
      <nav>
        <ul>
          <li><a class="link" href="#member-list">Lista članova</a></li>
          <li><a class="link" href="#trainer-list">Lista trenera</a></li>
          <li><a class="link" href="#register-member">Registruj člana</a></li>
          <li><a class="link" href="#register-trainer">Registruj trenera</a></li>
          <li><a class="link" href="#assign-trainer">Dodijeli trenera članu teretane</a></li>
        </ul>
      </nav>
    </header>

      <?php
  if(isset($_SESSION['success-message'])){  ?>
    <div class='alert-success'> <?php echo $_SESSION['success-message'] ?>
    <ion-icon class='icon-close' name='close-outline'></ion-icon>
    </div><?php
  }
    unset($_SESSION['success-message']);
  ?>
    <div class="container">
      <div id="member-list" class="list">
        
        <h2>Lista članova</h2>
        <button class="btn btn-csv"><a class="link" href="export.php?what=members">Export</a></button>
    
        <table class="table-container">
          <thead>
            <tr>
              <th>Ime</th>
              <th>Prezime</th>
              <th>Email</th>
              <th>Telefon</th>
              <th>Trening plan</th>
              <th>Trener</th>
              <th>Nalog otvoren</th>
              <th>Akcija</th>
            </tr>
          </thead>
          <tbody>
           
            <?php 

            $sql = "SELECT members.*,
            training_plans.name AS training_plan_name,
            trainers.first_name AS trainer_fname,
            trainers.last_name AS trainer_lname
            FROM members
            LEFT JOIN training_plans ON members.training_plan_id = training_plans.training_plan_id
            LEFT JOIN trainers ON members.trainer_id = trainers.trainer_id;";

            $run=$conn->query($sql);
            $results= $run->fetch_all(MYSQLI_ASSOC);
            
            $selected_members = $results;
           

            foreach ($results as $result){?>

              <tr>
                <td><?php echo $result['first_name'] ?> </td>
                <td><?php echo $result['last_name'] ?> </td>
                <td><?php echo $result['email'] ?> </td>
                <td><?php echo $result['phone_number'] ?> </td>

                <td><?php 
                
                if($result['training_plan_name']){
                echo $result['training_plan_name'];
                } else {
                  echo 'No plan';
                }

                ?> </td>
                
                <td><?php 
                
                if($result['trainer_fname']){
                echo $result['trainer_fname'] . " " . $result['trainer_lname'] ;
                } else {
                  echo '<b>Nema trenera</b>';
                }
                ?></td>
               
                <td><?php 
                
                $created_at = strtotime($result['created_at']);
                $new_date = date("d/m/Y", $created_at);
                echo $new_date;
                
                
                ?> </td>

                <td>
                  <form action="delete_member.php" method="POST">
                    <input type="hidden" name="member_id" value="<?php echo $result['member_id']; ?>">
                   <button class="btn btn-delete">OBRIŠI</button>
                  </form>
                </td>
              </tr>

            <?php } ?>
            
          </tbody>
        </table>
     
      </div>

      <div id="trainer-list" class="list">
        <h2>Lista trenera</h2>
        <button class="btn btn-csv"><a class="link" href="export.php?what=trainers">Export</a></button>
        <table class="table-container">
          <thead>
            <tr>
              <th>Ime</th>
              <th>Prezime</th>
              <th>Email</th>
              <th>Telefon</th>
              <th>Broj klijenata</th>

    
              <th>Nalog otvoren</th>
              <th>Akcija</th>
            </tr>
          </thead>
          <tbody>
                        
            <?php
            
            $sql = "SELECT trainers.*, COUNT(members.trainer_id) AS member_count
            FROM trainers
            LEFT JOIN members ON trainers.trainer_id = members.trainer_id
            GROUP BY trainers.trainer_id;";
            $run = $conn -> query($sql);
            $results = $run ->fetch_all(MYSQLI_ASSOC);

            $selected_trainers = $results;

            foreach($results AS $result) : ?>
              
              <tr>
                <td><?php echo $result['first_name'];?></td>
                <td><?php echo $result['last_name'];?></td>
                <td><?php echo $result['email'];?></td>
                <td><?php echo $result['phone_number'];?></td>
                <td><?php 
                
                if($result['member_count']){
                  echo $result['member_count'];
                } else {
                  echo '<b>Nema klijenata</b>';
                }

                ?></td>
                
               
                <td><?php
                
                $created_at = strtotime($result['created_at']);
                $new_date = date('d/m/Y', $created_at);
                
                echo $new_date;

                ?></td>
                <td>
                  <form action="delete_trainer.php" method="POST">
                    <input type="hidden" name="trainer_id" value="<?php echo $result['trainer_id'];?>">
                    <button class="btn btn-delete">OBRIŠI</button>
                  </form>
                </td>
                

              </tr>
              
            <?php endforeach; ?>


          </tbody>
        </table>
      </div>
      
      <div id="register-member" class="registration">
        <div class="reg-left">
          <h2>Registracija člana</h2>
          <form class="reg-form" action="register_member.php" method="POST" enctype="multipart/form-data">
            Ime: <br><input type="text" name="first_name"/><br><br>
            Prezime: <br><input type="text" name="last_name"/><br><br>
            Email: <br><input type="email" name="email"/><br><br>
            Telefon: <br><input type="text" name="phone_number"/><br><br>
            Trening plan: <br>
            <select  name="training_plan_id">
              <option value="" disabled selected>Trening plan</option>
              <?php
              $sql = "SELECT * FROM training_plans";
              $run = $conn->query($sql);
              $results = $run->fetch_all(MYSQLI_ASSOC);
            

            
              foreach($results AS $result){
                echo  "<option value= '" . $result['training_plan_id'] . "'>" .  $result['name'] . "</option>";

              };
            
              ?>
            </select> <br>
            <!-- <br><br> -->

      
            <button class="btn btn-submit" type="submit">REGISTRUJ ČLANA</button>
          </form>


        </div>
        <div id="register-trainer" class="reg-right">
          <div>
            <h2>Refistracija trenera</h2>
            <form class="reg-form" action="register_trainer.php" method="POST" enctype="multipart/form-data">
              Ime: <br> <input type="text" name="first_name"><br><br>
              Prezime: <br> <input type="text" name="last_name"><br><br>
              Email: <br> <input type="email" name="email"><br><br>
              Telefon: <br> <input type="text" name="phone_number"><br>
           
             

            <button class="btn btn-submit" type="submit">REGISTRUJ TRENERA</button>
            </form>
          </div>
         
        </div>
        
     </div>
     <div class="assign-flex">
      <div class="assign-left">
        <h2 id="assign-trainer" class="assign">Dodijeli trenera članu teretane</h2>
        <form action="assign_trainers.php" method="POST">
          Odaberi člana:
          <select name="member">
            <option value="" disabled selected>Odaberi</option>
          <?php
            foreach($selected_members AS $member){
              echo "<option value='" . $member['member_id'] . "'>" . $member['first_name'] . " " . $member['last_name'] . "</option>";
              
            }
            
            ?>
          </select><br><br>
          Odaberi trenera:
          <select name="trainer" id="">
            <option value="" selected disabled>Odaberi</option>
            <?php
            foreach($selected_trainers AS $trainer){
              echo "<option value='" . $trainer['trainer_id'] . "'>". $trainer['first_name'] . " " . $trainer['last_name'] ."</option>";

            }
            
            ?>
          </select>
          <button class="btn btn-submit">DODIJELI TRENERA</button>
        </form>
      </div>

      <div class="display-right">
        <div class="display-form">
          <div class="one-row">
            <p><b>Ukupno članova:</b></p>
           <div class="blank-field"><p class="display-number"><?php
           
           $sql = "SELECT COUNT(*) AS members_count FROM members";

           $run = $conn -> query($sql);
           $results = $run -> fetch_assoc();
           echo $results['members_count'];
           ?></p></div>
          </div>
          <div class="one-row second">
            <p><b>Ukupno trenera:</b></p>
            <div class="blank-field"><p class="display-number"><?php
           
           $sql = "SELECT COUNT(*) AS trainers_count FROM trainers";

           $run = $conn -> query($sql);
           $results = $run -> fetch_assoc();
           echo $results['trainers_count'];
           ?></p></div>
          </div>

        </div>
        <div class="display-photo">
          <a href="#"><img src="logo/logo-org.png" alt=""></a>
        </div>
      </div>
    </div>
     <div class="slogan">
      <img src="logo/slogan.png" alt="">
     </div>

     <div class="created-by">
        <p>Marko Ivanovic, 2023.</p>
     </div>
     <a href="https://marko.citalac.com"><button class="button-21" role="button"><b>Back to Projects</b><button></a>
  </body>

  <?php
    $conn-> close();
  ?>
 
  <script>
  const alertSuccess = document.querySelector('.alert-success');
  const btn = document.querySelector('.icon-close');

  const closeAlert = function () {
    alertSuccess.classList.add('hidden');
  }

  btn.addEventListener('click', closeAlert);

  </script>
  

  <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
  Dropzone.options.dropzoneUploadTrainer = {
    url: "upload_photo_trainer.php",
    paramName: "photo_trainer",
    maxFilesize: 20, // MB
    acceptedFiles: "image/*",
    init: function () {
        this.on("success", function (file, response) {
            // Parse the JSON response
            const jsonResponse = JSON.parse(response);
            
            // Check if the file was uploaded successfully
            if (jsonResponse.success) {
                // Set the hidden input's value to the uploaded file's path
                document.getElementById('photoPathInputTrainer').value = jsonResponse.photo_path;
            } else {
                console.error(jsonResponse.error);
            }
        });
    }
};
</script>



<script>

 // Function to handle smooth scrolling to target sections
function smoothScrollTo(target) {
  const targetElement = document.querySelector(target);
  if (targetElement) {
    // Calculate the offset of the target element considering the fixed header
    const headerHeight = document.querySelector('header').offsetHeight;
    const targetOffset = targetElement.offsetTop - headerHeight;
    
    // Scroll smoothly to the target section
    window.scrollTo({
      top: targetOffset,
      behavior: 'smooth'
    });
  }
}

// Attach event listeners to navigation links for smooth scrolling
const navigationLinks = document.querySelectorAll('nav a.link');
navigationLinks.forEach(link => {
  link.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default link behavior
    const target = this.getAttribute('href');
    smoothScrollTo(target);
  });
});

</script>
    </html>
