
<nav class="grey" role="navigation">
        <div class="nav-wrapper">
            <ul class="right">
                <li><a class="waves-effect" href="<?php echo SERVERURL.$pagina ?>" ><i class="material-icons left">arrow_back</i>Regresar</a></li>
            </ul>
        </div>
    </nav>

<div id="contenedor-error">

    <div id="mensaje-error"> ERROR: <?php echo $mensaje;?></div>
    <?php if(isset($show_footer)&&$show_footer):?><!--Condicion para dejar oculto el footer-->
        <footer id="footer-error" class="page-footer  blue-grey darken-4" style="">
            <div class="footer-copyright">
                <div class="container" style="color:white;">
                    © 2019 Direcci&oacute;n de Tecnologias de la Informaci&oacute;n y Comunicaciones / UNAM
                    <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
                </div>
            </div>
        </footer>
    <?php endif;?>
</div>
