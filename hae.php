<?php

require_once "../resources/config.php";

//luodaan database yhteydet
$lomake = new vieraskirja($mysli);
$lomake_vastaukset = new kommentit($mysli);

// tuodaan databasesta dataa muuttujaan talteen
$haku = $lomake->hae();


$yhden_sivun_maara = 10;
$lukumaara = count($haku);
$sivujen_maara = ceil($lukumaara/$yhden_sivun_maara);

if (isset($_POST['page']) && is_numeric($_POST['page']) && $_POST['page'] > 0 && $_POST['page'] <= $sivujen_maara) {
    $sivu = $_POST['page'];
}
else {
    $sivu = 1;
}

$numero_menossa = ($sivu-1)*$yhden_sivun_maara;
$hakuKymmenen = $lomake->haeKymmenen($numero_menossa, $yhden_sivun_maara);

// bootstrapin accordiota varten oma id luku
$acc_id_nro = 1;
?>

<table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr><th>ID</th><th>Nimi</th><th>Sähköposti</th><th>Viesti</th><th>Päivämäärä</th><th>IP</th><th></th></tr>
    </thead>

    <tbody>
    
    <!-- laitetaan viestit riviin -->
    <?php foreach ($hakuKymmenen as $rivi){ ?>
        
        <tr class="accordion accordion-toggle" data-toggle="collapse" aria-expanded="true" data-target="#komment<?php echo $acc_id_nro; ?>">
            <td><?php echo $rivi['id']; ?></td>
            <td><?php echo $rivi['nimi']; ?></td>
            <td><?php echo $rivi['email']; ?></td>
            <td><?php echo $rivi['viesti']; ?></td>
            <td><?php echo $rivi['paivamaara']; ?></td>
            <td><?php echo $rivi['ip']; ?></td>
            <td><button name="kommentti" type="button" class="btn btn-primary col-lg-12" onclick="vastaus_modal(<?php echo $rivi['id']; ?>);">Vastaa</button></td>
        </tr>
        
        
        <?php $hakupaketti = $lomake_vastaukset->hae($rivi['id']); ?>
        
            <tr class="collapse" id="komment<?php echo $acc_id_nro; ?>">    
                <td colspan="7" style="background-color: #eee;">
                
                <!-- laitetaan kommentit riviin viestien alle -->
                <?php foreach ($hakupaketti as $komment_rivi) { ?>
                
                    <div class="row ml-1 mr-1">  
                        
                            <div class="card pt-1 col-sm-2"><?php echo $komment_rivi['nimi']; ?></div>
                            <div class="card pt-1 col-sm-2"><?php echo $komment_rivi['email']; ?></div>
                            <div class="card pt-1 col-sm-6"><?php echo $komment_rivi['viesti']; ?></div>
                            <div class="card pt-1 col-sm-1"><?php echo $komment_rivi['paivamaara']; ?></div>
                            <div class="card pt-1 col-sm-1"><?php echo $komment_rivi['ip']; ?></div>
                    </div>         
                        
                    <?php } ?> <!-- suljetaan alempi foreach lauseke -->
                </td>
                
            </tr>   
        
    <!-- kasvatetaan accordion numeroa sekä suljetaan ylempi foreach-lauseke-->
    <?php $acc_id_nro++; } ?>
        
    
    </tbody>
    
</table>

<!-- sivutus alkaa -->
<ul class="pagination">
    
    <?php if ($sivu > 1){ 
        $edellinen_sivu = $sivu - 1;
        $edellinen_onclick = 'onclick="hae_viestit(' . $edellinen_sivu . ');"';?>
        <li class="page-item">
            <a class="page-link" <?php echo $edellinen_onclick ;?> aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
    <?php } ?>
    
  
    <?php for ($i = 1; $i <= $sivujen_maara; $i++) {
        if ($i == $sivu){
            $a = "active";
        }
        else {
            $a = "";
        }
        
        echo '<li class="' . $a . ' page-item"><a class="page-link" onclick="hae_viestit(' . $i . ');">' . $i . '</a></li>';
    
    } 
    ?>
     
    <?php if ($sivu < $sivujen_maara){ 
        $seuraava_sivu = $sivu + 1;
        $seuraava_onclick = 'onclick="hae_viestit(' . $seuraava_sivu . ');"';?>
        <li class="page-item">
            <a class="page-link" <?php echo $seuraava_onclick ;?> aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    <?php } ?>
        
</ul>
<!-- sivutus päättyy -->

<script type="text/javascript">
    $("tr").click(function() {
        var selected = $(this).hasClass("highlight");
        $(this).removeClass("highlight");
        if(!selected) {
            $(this).addClass("highlight");
        }
    });
</script>