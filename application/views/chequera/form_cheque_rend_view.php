<div class="x_panel">
    <div class="x_title bg-green">
        <span class="f16 negrilla">Registro de cheque Reembolsos y Rendiciones</span>
        <input type="hidden" id="documento" value="rendiciones">
        <input type="hidden" id="tipo" value="rendiciones">
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class=" col-md-12 col-sm-12 col-xs-12 form-group">
        <input type="hidden" id="contcheques">
        <input type="hidden" id="comprobantes_registrados" value="">

        <div class=" col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-4 col-sm-4 col-xs-8 form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" placeholder="id rendicion" id="solpago_busqueda" onkeyup="buscar_rend(event);">
                <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>

            </div>
            <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                <div class="col-md-3 col-sm-3 col-xs-3"> <input type="text" class="form-control has-feedback-left" placeholder="Cheque inicial" id="inicial_cheque" onkeyup="buscar_rend(event);">
                    <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-3 has-feedback">
                    <div class="form-group">
                        <div class='input-group date' id='myDatepickergral'>
                            <input type='text' class="form-control" readonly="readonly"  value="<?php date_default_timezone_set("Etc/GMT+4"); echo date('Y-m-d') ?>" id="fecha_todos" placeholder="fecha cheques"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <script>

                    $('#myDatepickergral').datetimepicker({
                        ignoreReadonly: true,
                        allowInputToggle: true,
                        format: 'YYYY-MM-DD'
                    });
                </script>


                <div class="col-md-4 col-sm-4 col-xs-3 form-group alin_cen">
                    <div class="control-label alin_cen">
                        <label>
                            <input type="checkbox" class="js-switch" id="agrupar" /> agrupar cheques del mismo proveedor
                        </label> 

                    </div>
                </div>
                <script>

                </script>

                <div class="col-md-2 col-sm-2 col-xs-2">
                    <button class="form-control has-feedback-left btn btn-dark" onclick="actualizar_cheques_rend()"> Actualizar</button>
                    <span class="fa fa-refresh form-control-feedback left" aria-hidden="true"></span>
                </div>
            </div>

        </div>


        <div class="col-md-12 col-sm-12 col-xs-12" id="solpago">


        </div>
    </div>



</div>
<script>
    $(document).ready(function () {
        if ($(".js-switch")[0]) {
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            elems.forEach(function (html) {
                var switchery = new Switchery(html, {
                    color: '#26B99A'
                });
            });
        }
    });
</script>