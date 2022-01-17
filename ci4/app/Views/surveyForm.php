<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="../assets/bootstrap-5.0.2/dist/css/bootstrap.min.css">

    <title>CI4 PoC</title>
  </head>
  <body>

    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                1. Pengkelasan menggunakan TAJUK
            </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                <!-- Add content here -->
                    <div class="container my-3">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 px-3">
                                <p>
                                    Mengasingkan (classification) borang tinjauan mengikut tajuk.
                                </p>
                                <table class="table table-light table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th style="text-align: right;">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($titles as $itemTitle):
                                        ?>
                                        <tr>
                                            <td><?=$itemTitle['id']?></td>
                                            <td><?=$itemTitle['name']?></td>
                                            <td style="text-align: right;">
                                                <button class="btn btn-outline-warning btn-sm " onClick="document.getElementById('<?php echo "editModalT".$itemTitle['id']; ?>').style.display = 'block'">Edit</button>
                                                <button class="btn btn-outline-danger btn-sm " onClick="document.getElementById('<?php echo "deleteModalT".$itemTitle['id']; ?>').style.display = 'block'">Delete</button>
                                            </td>
                                        </tr>
                                        <div id="<?php echo "deleteModalT".$itemTitle['id']; ?>" class="modal" tabindex="-1">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h3 class="modal-title">Delete</h3>
                                                        <button class="btn-close" onClick="document.getElementById('<?php echo "deleteModalT".$itemTitle['id']; ?>').style.display = 'none'"></button>
                                                    </div>
                                                    <div class="modal-body bg-warning" style="text-align:center;">
                                                        <form class="form" action="<?= base_url(); ?>/Pages/deleteTitle/<?= $itemTitle['id']; ?>" method="POST">
                                                            <p>
                                                                Are you sure? 
                                                            </p>
                                                            <input type="hidden" name="_id" value="<?php echo $itemTitle['id'];?>">
                                                            <button type="submit" class="btn btn-block bg-danger text-white"> YES!</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>	
                                        <div id="<?php echo "editModalT".$itemTitle['id']; ?>" class="modal" tabindex="-1">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info text-white">
                                                        <h3 class="modal-title">Edit</h3>
                                                        <button class="btn-close" onClick="document.getElementById('<?php echo "editModalT".$itemTitle['id']; ?>').style.display = 'none'"></button>
                                                    </div>
                                                    <div class="modal-body bg-light" style="text-align:center;">
                                                        <form class="form" action="<?= base_url(); ?>/Pages/editTitle/<?= $itemTitle['id']; ?>" method="POST">
                                                        	   <input type="text" name="titleNAME" value="<?php echo $itemTitle['name'];?>">
                                                            <input type="hidden" name="titleID" value="<?php echo $itemTitle['id'];?>">
                                                            <button type="submit" class="btn btn-block bg-primary text-white"> Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>	                                        
                                        <?php
                                            endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col">
                                <form class="form-control bg-secondary bg-gradient" action="<?php echo base_url(); ?>/Pages/addTitle" method="post">
                                    <input type="text" name="tn1" id="tn1" placeholder="Tajuk" class="form-control">
                                    <button type="submit" class="btn btn-primary form-control my-3">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                2. Membina soalan-soalan TINJAUAN
            </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                <!-- Add content here -->
                    <div class="container my-3">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 px-3">
                                <p>
                                    Membina soalan-soalan tinjauan mengikut tajuk yang dipilih.
                                </p>
                                <table class="table table-light table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>TITLE</th>
                                            <th>QUESTION</th>
                                            <th style="text-align: right;">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            // foreach($surveys as $itemSurvey):
                                            foreach($joinSurveyTitle as $itemSurvey):
                                        ?>
                                        <tr>
                                            <td><?=$itemSurvey['id']?></td>
                                            <td><span class="badge bg-info" data-bs-toggle="tooltip" data-bs-placement="right" title="<?=$itemSurvey['name']?>"><?=$itemSurvey['title']?></span></td>
                                            <td>
                                                <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="right" title="<?=$itemSurvey['answer']?>">A</span>
                                                <?=$itemSurvey['question']?>
                                            </td>
                                            <td style="text-align: right;">
                                                <button class="btn btn-outline-warning btn-sm" onClick="document.getElementById('<?php echo "editModalS".$itemSurvey['id']; ?>').style.display = 'block'">Edit</button>
                                                <button class="btn btn-outline-danger btn-sm" onClick="document.getElementById('<?php echo "deleteModalS".$itemSurvey['id']; ?>').style.display = 'block'">Delete</button>
                                            </td>
                                        </tr>
                                        <div id="<?php echo "deleteModalS".$itemSurvey['id']; ?>" class="modal" tabindex="-1">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h3 class="modal-title">Delete</h3>
                                                        <button class="btn-close" onClick="document.getElementById('<?php echo "deleteModalS".$itemSurvey['id']; ?>').style.display = 'none'"></button>
                                                    </div>
                                                    <div class="modal-body bg-warning" style="text-align:center;">
                                                        <form class="form" action="<?= base_url(); ?>/Pages/deleteSurvey/<?= $itemSurvey['id']; ?>" method="POST">
                                                            <p>
                                                                Are you sure? 
                                                            </p>
                                                            <input type="hidden" name="_id" value="<?php echo $itemSurvey['id'];?>">
                                                            <button type="submit" class="btn btn-block bg-danger text-white"> YES!</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>	
                                        <div id="<?php echo "editModalS".$itemSurvey['id']; ?>" class="modal" tabindex="-1">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info text-white">
                                                        <h3 class="modal-title">Edit</h3>
                                                        <button class="btn-close" onClick="document.getElementById('<?php echo "editModalS".$itemSurvey['id']; ?>').style.display = 'none'"></button>
                                                    </div>
                                                    <div class="modal-body bg-light" style="text-align:center;">
                                                        <form class="form bg-light" action="<?php echo base_url(); ?>/Pages/editSurvey/<?= $itemSurvey['id']; ?>" method="post">
                                                            <select name="surveyTITLE" id="surveyTitle" class="form-control ">
                                                                <?php 
                                                                    foreach($titles as $itemTitle):
                                                                        if($itemSurvey['title'] == $itemTitle['id']){
                                                                            echo '<option selected value="'.$itemTitle['id'].'">'.$itemTitle['name'].'</option>';
                                                                        } else {
                                                                            echo '<option value="'.$itemTitle['id'].'">'.$itemTitle['name'].'</option>';						                        
                                                                        }
                                                                    endforeach;
                                                                ?>                
                                                            </select>
                                                            <input type="text" name="surveyQUESTION" id="surveyQuestion" placeholder="Soalan" class="form-control" value="<?php echo $itemSurvey['question'];?>">
                                                            <textarea name="surveyANSWER" id="surveyAnswer" cols="30" rows="10" class="form-control" placeholder="Jawapan"><?php echo $itemSurvey['answer'];?></textarea>
                                                            <button type="submit" class="btn btn-primary form-control my-3">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>	                                        
                                        <?php
                                            endforeach;
                                        ?>
                                    </tbody>
                                </table>                
                            </div>
                            <div class="col px-3">
                                <form class="form-control bg-secondary bg-gradient" action="<?php echo base_url(); ?>/Pages/addSurvey" method="post">
                                    <!-- <input type="text" name="st1" id="st1" placeholder="Tajuk" class="col-10 m-3"> -->
                                    <select name="st1" id="st1" class="form-control ">
                                        <option readonly disabled>Sila pilih</option>'
                                        <?php 
                                            foreach($titles as $itemTitle):
                                                echo '<option value="'.$itemTitle['id'].'">'.$itemTitle['name'].'</option>';
                                            endforeach;
                                        ?>                
                                    </select>
                                    <input type="text" name="sq1" id="sq1" placeholder="Soalan" class="form-control">
                                    <textarea name="sa1" id="sa1" cols="30" rows="10" class="form-control" placeholder="Jawapan"></textarea>
                                    <button type="submit" class="btn btn-primary form-control my-3">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                3. Senarai borang tinjauan mengikut TAJUK
            </button>
            </h2>
            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">
                <div class="accordion-body">
                <!-- Add content here -->
                    <div class="container my-3">
                        <form action="" method="post" class="row g-3 mb-3">
                            <div class="col-auto">
                                <select name="selectTitle" id="" class="form-control">
                                    <option readonly>Sila pilih TAJUK</option>
                                    <?php 
                                        foreach($titles as $title){
                                            echo "<option value='".$title['id']."'>".$title['name']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <input type="submit" value="Show" class="form-control btn btn-primary"  name="filterSurvey">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-secondary" onClick="location.reload()">Refresh</button>
                            </div>
                        </form>
                        <?php
                            if($titles):
                                if(isset($_POST['filterSurvey'])):
                                    foreach($titles as $itemTitle):
                                        if($itemTitle['id'] == $_POST['selectTitle']):
                                            echo "<div class='pb-3'>";
                                            echo "<h3>".$itemTitle['name']."</h3>";
                                            $i = 1;
                                            if($surveys):
                                                echo "<form class='form-control' method='post' action='".base_url()."/Pages/addResult'>";
                                                foreach($surveys as $itemSurvey):
                                                    if($itemSurvey['title'] == $itemTitle['id']):
                                                        echo "<input type='hidden' name='titleNo' value='".$itemTitle['id']."'>";
                                                        echo "<input type='hidden' name='surveyNo' value='".$itemSurvey['id']."'>";
                                                        echo "<p>".$i++.". ".$itemSurvey['question']."</p>";
                                                        $listAns = preg_split("/\n/", $itemSurvey['answer']);
                                                        $a = 1;
                                                        foreach($listAns as $option => $value):
                                                            echo "<input type='hidden' name='optName' value='ansOpt-t".$itemTitle['id']."s".$itemSurvey['id']."'>";
                                                            if($value != NULL || $value != ""){
                                                                echo "<input type='radio' name='ansOpt-t".$itemTitle['id']."s".$itemSurvey['id']."' value='".$a++."'> ".$value."</input><br>";
                                                            } else {
                                                                echo "<input type='radio' name='ansOpt-t".$itemTitle['id']."s".$itemSurvey['id']."' value='".$a++."' class='form-inline'> Lain-lain:</input>"; 
                                                                echo '<input type="text" name="ansOptOther" placeholder="Nyatakan" class="form-control" ><br>';
                                                            }
                                                        endforeach;
                                                        echo "<br>";
                                                    endif;
                                                endforeach;
                                                echo "<input class='btn btn-primary form-control' type='submit' value='Submit'>";
                                                echo "</form>";
                                            endif;                    
                                            echo "</div>";
                                        endif;
                                    endforeach;                                
                                endif;
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingFour">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="true" aria-controls="panelsStayOpen-collapseFour">
                4. Keputusan TINJAUAN
            </button>
            </h2>
            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingFour">
                <div class="accordion-body">
                <!-- Add content here -->
                    <div class="container my-3">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 px-3">
                                <p>
                                    Laporan Tinjauan.
                                </p>
                            </div>
                            <div class="col">
                                <p>
                                    Analisis Tinjauan.
                                </p>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>

    </div>



<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

   
</body>
</html>    

<script src="../assets/js/jquery-3.3.1.js"></script>
<script src="../assets/bootstrap-5.0.2/dist/js/bootstrap.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
