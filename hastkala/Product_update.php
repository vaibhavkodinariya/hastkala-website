<?php
session_start();
require './includes/database.php';

?>
<html>
<head>
    <link rel="icon" type="image/png" href="logo/log3.png">
    <title>Hastkala-Admin Panel</title>
    <link rel="stylesheet" href="style/material-icons.css">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="style/close.css">
    <link type="text/css" rel="stylesheet" href="style/materialize.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>    
    <script type = "text/javascript" src = "style/jquery-2.1.1.js"></script>
    <script src = "style/materialize.js"></script>
  </head>
  <body style="background: linear-gradient(90deg, rgba(16,241,83,0.8018557764902836) 35%, rgba(71,148,240,0.8970938717283788) 90%);">
  <!-- <div id="updateproduct"> -->
        <div class="row">
          <div class= "z-depth-5 col m8 s10 offset-m2 offset-s1" style="margin-top: 5%; background-color: #ffffffe9;">
            <h4 class="center" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif ;" >Update Product</h4>
            <form method="post" action="./updateprocess.php" enctype="multipart/form-data" class=" col  m6 s8 offset-m3 offset-s2">
            <?php
                $pid=$_POST["productid"];
                $stmt = $database->prepare("SELECT * FROM products WHERE ID=$pid");
                $stmt->execute();
                $productdetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach($productdetails as $product)
          {
            $images=array_values(array_diff(scandir($product['ImagesPath']),array('.','..')));
            ?> 
               <div class="row">
                  <div class=" carousel carousel-slider">
                    <?php
                      foreach($images as $i)
                      {
                        // echo($i[0]);
                        ?>
                      <div class="carousel-item img-wrap" href="#one!"><a role="button" onclick="deleteImage('<?= $product['ImagesPath'] . $i ?>')" class="close">&times;</a><img src="<?=$product['ImagesPath']."/".$i?>"></div>
                      <?php
                      }
                      ?>
                      <div class="carousel-item center" href="#four!">
                        <div class="row">
                          <div class="file-field input-field">
                            <div class="col offset-m3 btn">
                              <span>upload file</span>
                              <input  type="file" name="fileToUpload[]" multiple id="" >
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate"   name="fileName" type="text" placeholder="Upload image">
                            </div><br>
                          </div>
                        </div>
                    </div>
                    </div>
                  </div>
                  <input type="hidden" name="pid" value="<?= $product['ID'] ?>">
        
            <div class="row">
                  <div class="input-field">
                    <input type="text" required value='<?=$product['Name']?>' name="Pname" id="Productname">
                    <label for="Productname">Product Name</label>
                  </div>
            </div>
            <div class="row">
                <div class="input-field">
                  <textarea  id="textarea2" class="materialize-textarea" name="Pdetails" rows="20" cols="10" data-length="120"><?=$product['Details']?></textarea>
                  <label for="textarea2">Description</label>
                </div>
            </div>  
            <div class="row">
                  <div class="input-field">
                    <input type="text" required value='<?=$product['Color']?>' name="UpdateColor" id="UpdateColor">
                    <label for="color">color</label>
                  </div>
            </div>
            <div class="row">
                  <div class="input-field">
                    <input type="text" required value='<?=$product['Material']?>' name="UpdateMaterial" id="UpdateMaterial">
                    <label for="material">Material</label>
                  </div>
            </div>
            <div class="row">
                  <div class="input-field">
                    <input type="text" required value='<?=$product['Weight']?>' name="UpdateWeight" id="UpdateWeight">
                    <label for="weight">weight</label>
                  </div>
            </div>
            <div class="row">
                  <label><h5>Select For Gender</h5></label>
                  <p>
                    <label>
                      <input  type="radio" id="UpdateMale" value="UpdateMale" name="group1" />
                      <span>Male</span>
                    </label>&nbsp&nbsp&nbsp&nbsp 
                    <label>
                      <input  type="radio" id="UpdateFemale" value="UpdateFemale" name="group1"/>
                      <span>Female</span>
                    </label>
                    <label>
                      <input  type="radio" id="UpdateOther" value="UpdateOther" name="group1"/>
                      <span>Other</span>
                    </label>
            </div>
            <div class="row">
                  <div class="input-field">
                    <input type="text" required value='<?=$product['Composition']?>' name="UpdateComposition" id="UpdateComposition">
                    <label for="composition">Composition</label>
                  </div>
            </div>
                <?php
                          $stmt = $database->prepare("SELECT ID,FixedSize FROM sizes");
                          $stmt->execute();
                          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          ?>
            <div id="SizeOfTraditionalWear" class="hide row">
                <ul class="col m6 offset-m3 collapsible">
                  <li>
                    <div class="collapsible-header"><i class="material-icons">straighten</i><b>size of tradi wear</b></div>
                      <div class="collapsible-body">
                        
                          <div>
                                  <p>
                                      <label>
                                          <input id="Check-all" type="checkbox" onclick="CheckAll(this)" class="filled-in">
                                          <span>all</span>
                                      </label>
                                  </p>
                              <?php
                              foreach($result as $r)
                              {  
                                if($r['ID']<7)
                                {
                              ?>
                                  <p>
                                      <label>
                                          <input type="checkbox" name="Checkbox[]" value="<?=$r['ID']?>" onclick="CheckItem()" class="Check-Item filled-in">
                                          <span><?=$r['FixedSize']?></span>
                                      </label>
                                  </p>
                                  <?php
                                
                                }
                              }
                              ?>
                          </div>
                      </div>
                  </li>
              </ul>
            </div> 
                <div id="SizeOfFootwear" class="hide row">
                  <ul class="col m6 offset-m3 collapsible">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">straighten</i><b>size of foot ware</b></div>
                        <div class="collapsible-body">
                            <div>
                                <p>
                                    <label>
                                        <input id="Checkall" type="checkbox" onclick="Check(this)" class="filled-in">
                                        <span>all</span>
                                    </label>
                                </p>
                          <?php
                                foreach($result as $r)
                                {  
                                  if($r['ID'] >=7 && $r['ID'] <=12)
                                  {
                          ?>
                                <p>
                                    <label>
                                        <input type="checkbox"  name="Shoes[]" value="<?=$r['ID']?>" onclick="CheckthisItem()" class="Checkitem filled-in">
                                        <span><?=$r['FixedSize']?></span>
                                    </label>
                                </p>
                          <?php
                                  }
                                }
                            ?>
                            </div>
                        </div>
                    </li>
                </ul>
              </div>
              <div class="row">
                  <div class="input-field">
                    <input type="number" required value='<?=$product['Price']?>' name="UpdatePrice" id="UpdatePrice">
                    <label for="UpdatePrice">price</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field">
                    <input type="number" required value='<?=$product['Quantity']?>' name="UpdateAvStock" id="UpdateAvStock">
                    <label for="AvStock">Stock Available</label>
                  </div>
                </div>
              <?php
          }
              ?>
            <!-- <button class=" chip waves-effect waves-light btn col m4 offset-m5 " value="Upload Image" type="submit" name="submit">submit</button> -->
                <button class=" chip waves-effect waves-light btn col m4 s8 offset-s2 offset-m4 " type="submit" id="Update" name="update">Update</button>
            
              </form>
            </div>
        </div>        
          <script type = "text/javascript" src = "style/update.js"></script> 
      <!-- </div> -->
      <script>

          function deleteImage(path)
          {
            var p = path;
                // console.log(p);
                $('.img-wrap .close').on('click', function() {
                    $(this).closest('.img-wrap').remove();
                });
                $.ajax({
            url: 'removefile.php',
            type: 'post',
            data: {path: p},
                });
            // $.get({
            //   url: 'index.php?path=' + path,
            //   success: function ()
            //   {
            //     alert(path);

            //   }
            // });
          }
            
            deleteImage();
        $(document).ready(function(){
                    $('.carousel').carousel();
                    // $('.carousel.carousel-slider').carousel({
                    //     fullWidth: true
                    // });
                });
      </script>
  </body>
</html>