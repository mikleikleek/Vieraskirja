<?php
require_once "../resources/config.php";
?>

<input type="hidden" name="id" id="id_lomake_vastaus" value="<?php echo $_POST['id']; ?>">

<div class="modal-header text-center">
    <h4 class="modal-title w-100 font-weight-bold">Vastaus viestiin</h4>
</div>

<div class="" id="vastaus_ilmoitus"></div>


<div class="modal-body mx-3" id="vastaus_body">    
    
    <div class=" row md-form mb-3">

        <i class="fas fa-user-alt grey-text col-md-1 py-3"></i>
        <input type="text" class="required form-control validate col-md-11" placeholder="Nimi" name="nimi" id="nimi_lomake_vastaus">

    </div>

    <div class="row md-form mb-3">

        <i class="fas fa-envelope grey-text col-md-1 py-3"></i>
        <input type="email" class="required form-control validate col-md-11" placeholder="Sähköposti" name="email" id="email_lomake_vastaus">

    </div>  

    <div class="row md-form">

        <i class="far fa-comment grey-text col-md-1 py-3"></i>
        <textarea rows="8" class="required form-control col-md-11" placeholder="Viesti" name="viesti" id="viesti_lomake_vastaus"></textarea>

    </div>  

</div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary col-md-2" data-dismiss="modal">Sulje</button>
        <button type="submit" class="btn btn-primary col-md-2 mr-1" onclick="tallenna_vastaus();" id="vastaus_submitti">Lähetä</button>
    </div>