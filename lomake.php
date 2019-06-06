<?php
require_once "../resources/config.php";
?>

<div class="modal-header text-center">
    <h4 class="modal-title w-100 font-weight-bold">Viestin kirjoitus</h4>
</div>

<div class="" id="viesti_ilmoitus"></div>


<div class="modal-body mx-3" id="viesti_body">

    <div class=" row md-form mb-3">

        <i class="fas fa-user-alt grey-text col-md-1 py-3"></i>
        <input type="text" class="required form-control validate col-md-11" placeholder="Nimi" name="nimi" id="nimi_lomake">

    </div>

    <div class="row md-form mb-3">

        <i class="fas fa-envelope grey-text col-md-1 py-3"></i>
        <input type="email" class="required form-control validate col-md-11" placeholder="Sähköposti" name="email" id="email_lomake">

    </div>  

    <div class="row md-form">

        <i class="far fa-comment grey-text col-md-1 py-3"></i>
        <textarea rows="8" class="required form-control col-md-11" placeholder="Viesti" name="viesti" id="viesti_lomake"></textarea>

    </div>  

</div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary col-md-2" data-dismiss="modal">Sulje</button>
        <button type="submit" class="btn btn-primary col-md-2 mr-1" onclick="tallenna_viesti();" id="viesti_submitti">Lähetä</button>
    </div>