/*
Function: eliminar_categoria(categoria_id)
Params: categoria_id - id de la categoría
Action: Elimina la categoría en base al id*/

function eliminar_categoria(categoria_id) {

    if (categoria_id != undefined && categoria_id != null && categoria_id != "") {
        swal({
            type: "warning",
            title: "La categoria se eliminara",
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
        }).then(function(e) {

            if (e) {

                swal({
                    title: 'Eliminado!',
                    text: 'La categoria se ha eliminado',
                    type: 'success',
                    showConfirmButton: true
                }).then(function() {
                    $.ajax({

                        url: serverurl + "ajax/filtrosAjax.php",
                        method: "post",
                        data: {
                            categoria_id: categoria_id,
                            accion: "ELIMINAR"
                        },
                        success: function(res) {
                            console.log(res);
                            window.location.href = serverurl + "filtros";
                        }
                    });
                }).catch(function() {
                    $.ajax({

                        url: serverurl + "ajax/filtrosAjax.php",
                        method: "post",
                        data: {
                            categoria_id: categoria_id,
                            accion: "ELIMINAR"
                        },
                        success: function(res) {
                            console.log(res);
                            window.location.href = serverurl + "filtros";
                        }
                    });
                });

            }


        }).catch(function() {

            // window.location.href = serverurl + "filtros";
        });
    }
}

/*
Function: mostrar_subcategorias(categoria_id)
Params: categoria_id - id de la categoría
Action: Muestra las subcategorías en base al id de la categoría*/


function mostrar_subcategorias(categoria_id) {
    $("#activadores").hide();
    if (categoria_id != undefined && categoria_id != null && categoria_id != "") {
        $.ajax({

            url: serverurl + "ajax/articuloAjax.php",
            method: "post",
            data: {
                categoria_id: categoria_id,
                accion: "BUSCAR"
            },
            success: function(res) {
                res = JSON.parse(res);

                // console.log(res);
                $('#crearsubcategoria').attr("href", function(i, href) {
                    var _href = href.split('/');
                    console.log(_href);
                    _href = _href[0] + "/" + _href[1] + "/" + _href[2] + "/";
                    return _href + categoria_id;
                });
                $('#subcategorias').show();


                $("#tabla_subcategorias").DataTable().destroy();
                $('#tabla_subcategorias').DataTable({
                    paging: true,
                    data: res,
                    searching: true,
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'subcategoria'
                        }
                    ],
                    columnDefs: [{
                            searchable: false,
                            targets: [2, 3, 4]
                        },

                        {
                            className: "center-align",
                            "targets": "_all"
                        },
                        {
                            targets: 2,

                            render: function(data, type, row, meta) {

                                return '<a href="#!" onclick="mostrar_activadores(' + row.id + ');"><i class="small material-icons indigo-text">view_stream</i></a>';
                            }

                        }, {
                            targets: 3,

                            render: function(data, type, row, meta) {
                                return '<a href="/siscon/subcategoria/' + row.categoria_id + '/' + row.id + '"><i class="small material-icons blue-text">edit</i></a>';
                            }

                        }, {
                            targets: 4,

                            render: function(data, type, row, meta) {
                                return '<a href="#!" onclick="eliminar_subcategoria(' + row.id + ');"><i class="small material-icons red-text">delete</i></a>';
                            }

                        }
                    ],

                    language: ({
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad"
                        },
                    })
                })

                $("select").formSelect();
                $("html, body").animate({
                    scrollTop: $(document).height()
                }, 1000);
            }
        });

    }
}

/*
Function: mostrar_activadores(subcategoria_id)
Params: subcategoria_id - id de la subcategoría
Action: Muestra los activadores en base al id de la subcategoría*/

function mostrar_activadores(subcategoria_id) {
    if (subcategoria_id != undefined && subcategoria_id != null && subcategoria_id != "") {
        $.ajax({

            url: serverurl + "ajax/filtrosAjax.php",
            method: "post",
            data: {
                subcategoria_id: subcategoria_id,
                accion: "BUSCAR"
            },
            success: function(res) {
                res = JSON.parse(res);
                // console.log(res);
                var $el = $('#activadores');

                $("#activadores :input").each(function(key, element) {
                    element.checked = false;
                });


                $.each(res, function(key, value) {
                    // console.log(value["activador_id"]);
                    $("#check_" + value["activador_id"])
                        .prop("checked", true);
                });

                $("#activadores").show();

                $("#crearactivadores").attr("onclick", "crear_activadores(" + subcategoria_id + ")");
                $("html, body").animate({
                    scrollTop: $(document).height()
                }, 2000);
            }
        });

    }

}

/*
Function: crear_activadores(subcategoria_id)
Params: subcategoria_id - id de la subcategoría
Action: Crea los activadores pertenecientes al id de la subcategoría*/

function crear_activadores(subcategoria_id) {
    var arr = {"subcategoria_id":subcategoria_id,"activadores":[]};
    
    $("#activadores :input").each(function(key, element) {
        if (element.checked == true)
            arr.activadores.push({
                "estado": element.checked,
                "id": element.id.slice(6),
                
            });
    });

    if (subcategoria_id != undefined && subcategoria_id != null && subcategoria_id != ""&&arr.activadores.length>0) {
        $.ajax({

            url: serverurl + "ajax/filtrosAjax.php",
            method: "post",
            data: {
                elementos: arr,
                accion: "GUARDAR"
            },
            success: function(res) {
            //   console.log(res);
            if(res==0)
            {
                swal({
                    title: 'Guardado',
                    text: 'Los activadores se han guardado',
                    type: 'success',
                    showConfirmButton: true
                })
            }
               
            }
        });

    }
    else{
        swal({
            title: 'Error',
            text: 'Seleccione al menos un campo a mostrar',
            type: 'error',
            showConfirmButton: true
        }).then(function()
            {
                mostrar_activadores(arr.subcategoria_id);
            }
        )
    }

    
    // console.log(arr)


}