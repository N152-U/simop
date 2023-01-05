

<div id="contenedor-error">

<div id="mensaje-error"> ERROR: La página solicitada no existe o no se encuentra disponible <a href="<?php echo SERVERURL?>">(Ir a inicio)</a></div>
<?php if(isset($show_footer)&&$show_footer):?><!--Condicion para dejar oculto el footer-->
    <footer id="footer-error" class="page-footer  blue-grey darken-4">
        <div class="footer-copyright">
        <div class="row"> 
            <div class="col s8 m8 l8">
            © 2020 SACMEX / Subdirección de desarrollo de programas
            </div>

            <div class="col s4 m4 l4">
            Contacto: Edgar Morales Palafox (Subdirector de desarrollo de programas) <br>
            Email:
            edgar.morales@sacmex.cdmx.gob.mx
            </div>
        </div> 
        <!-- <a class="grey-text text-lighten-4 right" href="#!">More Links</a> -->
   
        </div>
    </footer>
<?php endif;?>
</div>
