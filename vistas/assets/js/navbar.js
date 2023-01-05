const wsocket=({
    w : null,
    self:this,
    updateBadge:()=>
    {
       
        return Promise.resolve($.ajax({
            url: serverurl + "ajax/novedadesAjax.php",
            method: "post",
            data: {
                "accion": "CONSULTATOTALNOVEDADES"
            },
            success: function (res) {
                $("#cantidad_mensajes").html(res);
               return res;
            }}));
         /*  return count; */
    },
    init:()=>{
        this.w=$(window);
        // set some global vars
        
        w.onbeforeunload = function() {
            w.websocket.onclose = function () {};
            w.websocket.close()
        };
        
        // set some vars
        w.name = user_sid;
        w.wsUri = `ws://${ws_server}`;
        w.websocket = new WebSocket(w.wsUri);
        console.log(w.websocket);

        w.websocket.onopen = function(ev) {
            wsocket.updateBadge().then((count)=>
            {
                M.toast({html: `Novedades del dia de hoy: ${count}`,  classes: 'notification-black'});
            });
               
            var msg = {
            name : w.name,
            sid : user_sid
            };
            w.websocket.send(JSON.stringify(msg));
  
        }

        w.websocket.onmessage = function(ev) {

            
            var msg    = JSON.parse(ev.data); //PHP sends Json data
            var type   = msg.type;
            var umsg   = msg.message; //message text
            var uname  = msg.name; //user name
            var ucolor = msg.color; //color
            var sid    = msg.sid; //session id
            console.log("mensajes recibidos",ev.data);	
            console.log(umsg);
            console.log("tipo:",type);
            if(type=="usermsg" && umsg!= null && umsg!=undefined ){
                M.toast({html: `${umsg}`, completeCallback: function(){/*Notificacion perdida, aumenta la cuenta de notificaciones en badges alert('Your toast was dismissed');*/ 
                wsocket.updateBadge();
                },
                timeRemaining :0,
                classes: ucolor
                });
            }
            $('#message').val(''); //reset text
        };
    },
    sendMessage:(mymessage, color)=>{
       
        var to_users = new Array();
        $('#send_to option').filter(function (key, element) {
            if(element.selected)to_users.push(element.value);
         });
      
       /*  to_users.push("dVduZS81UzhzLzRUN1ZFVUxYdHNuUT09" ); */
        
        if(mymessage == ""){ //emtpy message?
          alert("Enter Some message Please!");
          return;
        }
        
        //prepare json data
        var msg = {
            message: mymessage,
            name: '',
            color : color,
            sid : user_sid,
            to_users: []
          };
        if(to_users.length>0 && to_users[0]!="all")
        {
            console.log("usuarios a los que se enviara",to_users);
           msg.message=mymessage;
           msg.sid =user_sid;
           msg.to_users =to_users;
        }else{
            msg.message=mymessage;
            msg.sid =user_sid;
            delete msg["to_users"];
        }
        console.log("mensaje",msg);
        
        //convert and send data to server
        w.websocket.send(JSON.stringify(msg));  
    },


 
});
$(document).ready(function () {

    $.ajax({
        url: serverurl + "ajax/permisosAjax.php",
        method: "post",
        data: { "accion": "CONSULTAPERMISOS", "permisos": "" },
        success: (res) => {
            res = JSON.parse(res);
            //console.log(res);
          for(i = 0; i < res.length; i++){
                if (Array("LEERUSUARIO", "CREARUSUARIO", "EDITARUSUARIO", "ELIMINARUSUARIO").includes(res[i].permiso, 0)) {
                    $("#administracion").show();
                    $("#gestion_usuarios").show();
                    continue;
                }
                if (Array("LEERROL", "CREARROL", "EDITARROL", "ELIMINARROL").includes(res[i].permiso, 0)) {
                    $("#administracion").show();
                    $("#gestion_roles").show();
                    continue;
                }
                if (Array("CAPTURA_LUMBRERA0").includes(res[i].permiso, 0)) {
                    $("#capturas").show();
                    $("#lumbrera").show();
                    continue;
                }
                
                if (Array("LEERNOTA").includes(res[i].permiso, 0)) {
                    $("#reportes_radio").show();
                    $("#notas").show();
                    continue;
                }
                if (Array("COMPARATIVOSCADA").includes(res[i].permiso, 0)) {
                    $("#el_comparativo_scada").show();
                    continue;
                }
                if(Array("RECIBIRNOTIFICACIONES").includes(res[i].permiso, 0))
                {
                    $("#notificaciones").show();
                    wsocket.init();
                    continue;
                }
                if (Array("LEERNOVEDAD").includes(res[i].permiso, 0)) {
                   
                    $("#reportes_radio").show();
                    $("#novedades").show();
                    continue;
                }
                if (Array("LEERREPORTE", "CREARREPORTE", "EDITARREPORTE").includes(res[i].permiso, 0)) {
                    $("#reportes_radio").show();
                    $("#reportes").show();
                    continue;
                }
                if (Array("HISTORICOSISTEMAS").includes(res[i].permiso, 0)) {
                    $("#el_hist_sist").show();
                    continue;
                }
                if (Array("TABLERO").includes(res[i].permiso, 0)) {
                    $("#el_tablero").show();
                    continue;
                }
                if (Array("INFORMESISTEMAS").includes(res[i].permiso, 0)) {
                    $("#informe_sistemas").show();
                    continue;
                }
                 if (Array('HISTORICOPUNTOVENTURYII', 'HISTORICOPUNTOVENTURYIII', 'HISTORICOPUNTOALZATE', 'HISTORICOPUNTOATARASQUILLO', 'HISTORICOPUNTOVENADO', 'HISTORICOPUNTODOLORES', 'HISTORICOPUNTOBORRACHO').includes(res[i].permiso, 0)) {
                    $("#historicos").show();
                    $("#histPozo").show();
                    continue;
                }
                 if (Array('CREARSUBESTACIONIXTLAHUACA').includes(res[i].permiso, 0)) {
                    $("#capturas").show();
                    $("#subestacion").show();
                    continue;
                }
                if(Array('LEERRIEGO','CREARANIORIEGO','CREARREGISTRORIEGO').includes(res[i].permiso, 0)){
                    $("#controlRiego").show();
                    $("#registroRiego").show();
                    $("#graficaRiego").show();
                    $("#registroAnioRiego").show();
                }
              
            
                if (Array('HISTORICOSUBESTACIONIXTLAHUACA').includes(res[i].permiso, 0)) {
                    $("#historicos").show();
                    $("#histSub").show();
                    continue;
                }
                if (Array('CAPTURAPUNTOVENTURYII', 'CAPTURAPUNTOVENTURYIII', 'CAPTURAPUNTOALZATE', 'CAPTURAPUNTOATARASQUILLO', 'CAPTURAPUNTOVENADO', 'CAPTURAPUNTODOLORES', 'CAPTURAPUNTOCAIDADELBORRACHO').includes(res[i].permiso, 0)) {
                    $("#capturas").show();
                    $("#punto").show();

                   
                    continue;
                }
                 if (Array(
                    'CAPTURATANQUEAEROCLUB1',
                    'CAPTURATANQUEAEROCLUB2',
                    'CAPTURATANQUEAEROCLUB3',
                    'CAPTURATANQUECARTERO',
                    'CAPTURATANQUEPALOALTO',
                    'CAPTURATANQUEZARAGOZA',
                    'CAPTURATANQUEDOLORES',
                    'CAPTURATANQUESTALUCIA1',
                    'CAPTURATANQUESTALUCIA2',
                    'CAPTURATANQUESTALUCIA3',
                    'CAPTURATANQUESTALUCIA4',
                    'CAPTURATANQUESTALUCIA5',
                    'CAPTURATANQUEVILLAVERDUN',
                    'CAPTURATANQUEAGUILAS2',
                    'CAPTURATANQUEAGUILAS3',
                    'CAPTURATANQUEAGUILAS4',
                    'CAPTURATANQUEAGUILAS5',
                    'CAPTURATANQUEAGUILAS6', 
                    'CAPTURATANQUEMIMOSA',
                    'CAPTURATANQUELIENZO',
                    'CAPTURATANQUEJUDIO',
                    'CAPTURATANQUESANFRANCISCO',
                    'CAPTURATANQUEPADIERNA',
                    'CAPTURATANQUEPICACHO',
                    'CAPTURATANQUEMADEDEROSII',
                    'CAPTURATANQUEMADEDEROSIII',
                    'CAPTURATANQUEMAPLE',
                    'CAPTURATANQUEZAPOTE',
                    'CAPTURATANQUEZAPOTE',
                    'CAPTURATANQUEFABRIQUITA',
                    'CAPTURATANQUECURVA',
                    'CAPTURATANQUEROMPEDOR',
                    'CAPTURATANQUEMERCEDGOMEZ',
                    'CAPTURATANQUEYAQUI',
                    'CAPTURATANQUECALVARIO',
                    'CAPTURATANQUECONTADERO1',
                    'CAPTURATANQUECONTADERO2',
                    'CAPTURATANQUELIMBO',
                    'CAPTURATANQUELAERA',
                    'CAPTURATANQUEAO8').includes(res[i].permiso, 0)) {
                    $("#capturas").show();
                
                    $("#tanque").show();
                    continue;
                }
                if (Array(
                    'HISTORICOTANQUEAEROCLUB1',
                    'HISTORICOTANQUEAEROCLUB2',
                    'HISTORICOTANQUEAEROCLUB3',
                    'HISTORICOTANQUECARTERO',
                    'HISTORICOTANQUEPALOALTO',
                    'HISTORICOTANQUEZARAGOZA',
                    'HISTORICOTANQUEDOLORES',
                    'HISTORICOTANQUESTALUCIA1',
                    'HISTORICOTANQUESTALUCIA2',
                    'HISTORICOTANQUESTALUCIA3',
                    'HISTORICOTANQUESTALUCIA4',
                    'HISTORICOTANQUESTALUCIA5',
                    'HISTORICOTANQUEVILLAVERDUN',
                    'HISTORICOTANQUEAGUILAS2',
                    'HISTORICOTANQUEAGUILAS3',
                    'HISTORICOTANQUEAGUILAS4',
                    'HISTORICOTANQUEAGUILAS5',
                    'HISTORICOTANQUEAGUILAS6',
                    'HISTORICOTANQUEMIMOSA',
                    'HISTORICOTANQUELIENZO',
                    'HISTORICOTANQUEJUDIO',
                    'HISTORICOTANQUESANFRANCISCO',
                    'HISTORICOTANQUEPADIERNA',
                    'HISTORICOTANQUEPICACHO',
                    'HISTORICOTANQUEMADEDEROSII',
                    'HISTORICOTANQUEMADEDEROSIII',
                    'HISTORICOTANQUEMAPLE',
                    'HISTORICOTANQUEZAPOTE',
                    'HISTORICOTANQUEFABRIQUITA',
                    'HISTORICOTANQUECURVA',
                    'HISTORICOTANQUEROMPEDOR',
                    'HISTORICOTANQUEMERCEDGOMEZ',
                    'HISTORICOTANQUEYAQUI',
                    'HISTORICOTANQUECALVARIO',
                    'HISTORICOTANQUECONTADERO1',
                    'HISTORICOTANQUECONTADERO2',
                    'HISTORICOTANQUELIMBO',
                    'HISTORICOTANQUELAERA',
                    'HISTORICOTANQUEAO8').includes(res[i].permiso, 0)) {
                    $("#historicos").show();
                    $("#histTanque").show();
                    continue;
                }
            }

        }
    });
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.tooltipped').tooltip();
    $('#mostrarMenu').click(function () {
        //console.log("HOLA");
        //console.log($('#iconoMostrarMenu').text('menu'));

        $("#sidenav-left").toggle(0, function () {
            var oculto = $(this).is(":hidden");
            if (oculto) {
                console.log("oculto");
                $('main').addClass('ocultar-menu');
                $('footer').addClass('ocultar-menu');
                $('#mostrarMenu').addClass('left-menu-oculto');
                $('#iconoMostrarMenu').text('arrow_forward_ios')
            } else {
                console.log("no oculto");
                $('main').removeClass('ocultar-menu');
                $('footer').removeClass('ocultar-menu');
                $('#mostrarMenu').removeClass('left-menu-oculto');
                $('#iconoMostrarMenu').text('arrow_back_ios')
            }
        });
    });
    $('#mostrarMenuMovil').click(function () {
        //console.log("HOLA");
        //console.log($('#iconoMostrarMenu').text('menu'));

        var oculto = $('#sidenav-left').is(":hidden");
        if (oculto) {
            $('#sidenav-left').show();
            $('main').removeClass('ocultar-menu');
            $('footer').removeClass('ocultar-menu');
            $('#mostrarMenu').removeClass('left-menu-oculto');
            $('#iconoMostrarMenu').text('arrow_back_ios');
        }
    });

    


    // $('.sidenav')
    // .sidenav()
    // .on('click tap', 'li a', () => {
    //     $('.sidenav').sidenav('close');
    // });
});
