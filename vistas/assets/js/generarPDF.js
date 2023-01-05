
var doc;
var fuentes = [['Helvetica', 'bold'], ['Helvetica', 'normal'], ['Times', 'Italic']];
var tamanios = [6.5, 7.5, 5.5];
const interlineado = 40;
var espacio_vertical;
var folio;
var novedades;
var notas;

//console.log(id_reporte);
function genPDF(id_reporte) {
	swal({
		title: "GENERANDO PDF",
		allowEscapeKey: false,
		allowOutsideClick: false,
		timer: 3000,
		onOpen: () => {

			swal.showLoading();
			try {


				doc = new jsPDF ('p', 'mm', 'letter');
				espacio_vertical = interlineado;
				// Generación de encabezado
				var datosReportes = traerDatosReportes(id_reporte);
				var texto_pdf = TextoPdf(datosReportes);
				folio = datosReportes.folio;
				Encabezado();

				$.each(texto_pdf, function (key, value) {
					// Valores de los encabezados
					var fuente = fuentes[value[0]][0];
					var fontType = fuentes[value[0]][1];
					var tamanio = tamanios[value[1]];
					doc.setFontType(fontType);
					var lineas_encabezados = doc.setFont(fuente)
						.setFontSize(tamanio)
						.splitTextToSize(value[4], 176);
					doc.text(value[2], espacio_vertical + value[3] + obtenerTamanioLinea(tamanio), lineas_encabezados, {
						align: 'left',
						maxWidth: '176'
					});

					// Valores de los contenidos
					var fontType = fuentes[0][0];
					doc.setFontType(fontType);
					var lineas_contenidos = doc.setFont(fuente)
						.setFontSize(tamanio)
						.splitTextToSize(value[5], 146);
					doc.text(value[2] + 30, espacio_vertical + value[3] + obtenerTamanioLinea(tamanio), lineas_contenidos, {
						align: 'justify',
						maxWidth: '146'
					});


					(lineas_contenidos.length >= lineas_encabezados.length) ? espacio_vertical += (lineas_contenidos.length) * obtenerTamanioLinea(tamanio) + value[3] : espacio_vertical += (lineas_encabezados.length) * obtenerTamanioLinea(tamanio) + value[3];

				});

				//FirmasPDF(datosReportes.responsable, datosReportes.puesto, datosReportes.area);
			    generarPie(datosReportes.folio, datosReportes.fecha,datosReportes.gasto_venando,datosReportes.transmitio);
///console.log(datosReportes.transmitio);
				//doc.autoPrint({variant: 'non-conform'});
			}
			catch{
				swal({
					type: "error",
					title: "Ocurrio un error en la generación del PDF",
					showConfirmButton: true,
					allowOutsideClick: false
				}).then(() => {

				});
			}
		},
		onClose: () => {
			//console.log("HOLA");
			doc.save (folio+'.pdf');

//doc.save(folio+'.pdf');
		}
	}
	).then((e) => {
		if (e) {
			
		}


	}).catch(() => {

	});
}


function Encabezado() {
	toDataURL(serverurl + 'vistas/assets/images/sacmexgrande.png', function (base64_data) {

		doc.addImage(base64_data, 'PNG', 20, 15, 80, 16);
		doc.setFont("helvetica");
		doc.setFontSize(6.5);
		doc.setFontType('bold')
		doc.text(108, 19, 'SISTEMA DE AGUAS DE LA CIUDAD DE MÉXICO');
		doc.setFontType('normal')
		doc.text(108, 22, 'DIRECCIÓN GENERAL DE AGUA POTABLE');
		doc.text(108, 25, 'DIRECCIÓN DE AGUA Y POTABILIZACIÓN');
		doc.text(108, 28, 'SUBDIRECCIÓN DEL SISTEMA LERMA');

		
		
	})



}

function TextoPdf(datosReportes) {
	
	var texto = [];
	texto.push([0, 1, 90, 0, 'OFICINA REGIONAL VILLA CARMELA', ""]);
	texto.push([0, 1, 100, 0, 'BITÁCORA DE RADIO', ""]);
	texto.push([0, 1, 20, 5, 'FECHA: ', datosReportes.fecha.toUpperCase()]);
	texto.push([0, 1, 150, -(obtenerTamanioLinea(tamanios[1])), 'FOLIO: ', datosReportes.folio]);
    //texto.push([0, 1, 150, 0, 'FOLIO: ', datosReportes.folio]);
	texto.push([0, 1, 20, 5, 'REPORTE DE PLANTA BERROS:', ""]);
	texto.push([0, 1, 40, 0, '', datosReportes.reporte_berros]);
	texto.push([0, 1, 20, 5, 'NOVEDADES: ',""]);
	texto = texto.concat(generarDatosPDFNovedades(datosReportes.id));
	texto.push([0, 1, 20, 5, 'REPORTE A INFORMACIÓN: ',""]);
	texto.push([0, 1, 30, 2, 'HORA RECIBIO: ', datosReportes.hora_recibio]);
	texto.push([0, 1, 30, 2, 'RECIBIO: ', datosReportes.recibio]);
	texto.push([0, 1, 30, 2, 'TRANSMITIO: ', datosReportes.transmitio]);
	texto.push([0, 1, 20, 5, 'REPORTE DE LLUVIA: ',""]);
	texto.push([0, 1, 30, 2, 'ALMOLOYA: ', datosReportes.lluvia_almoloya]);
	texto.push([0, 1, 30, 2, 'VILLA CARMELA: ', datosReportes.lluvia_villa_carmela]);
	texto.push([0, 1, 30, 2, 'ALZATE: ', datosReportes.lluvia_alzate]);
	texto.push([0, 1, 30, 2, 'IXTLAHUACA: ', datosReportes.lluvia_ixtlahuaca]);
	texto.push([0, 1, 20, 5, 'GASTO PROMEDIO VENADO [L/S]:', ""]);
	texto.push([0, 1, 40, 0, '', datosReportes.gasto_venado]);
	texto.push([0, 1, 20, 5, 'NOTAS: ',""]);
	texto = texto.concat(generarDatosPDFNotas(datosReportes.id));
	texto.push([0, 1, 20, 5, 'OPERADORES: ',""]);
	texto.push([0, 1, 30, 2, '1ER OPERADOR: ', datosReportes.operador_uno]);
	texto.push([0, 1, 30, 2, '2DO OPERADOR: ', datosReportes.operador_dos]);
	texto.push([0, 1, 20, 5, 'JEFE RESPONSABLE DE TURNO:', ""]);
	texto.push([0, 1, 40, 0, '', datosReportes.jefe_reponsable_turno]);
	
	
	


	
//	texto.push([0, 1, 20, 0, 'UBICACIÓN: ', datosReportes.ubicacion]);

	/*
	texto.push([0, 1, 95, 5, 'DATOS ' + categoria + ': ', ""]);
	texto = texto.concat(DatosArticulosPDF(datosVales.subcategoria, datosVales.marca_a, datosVales.modelo_a, datosVales.numero_producto, datosVales.tipo, datosVales.cap_volt, datosVales.capacidad, datosVales.tamanio, datosVales.faradios, datosVales.frecuencia, datosVales.velocidad, datosVales.articulo_id));
	// 
	texto.push([1, 1, 20, 5, 'LA SUBDIRECCIÓN DE MANTENIMIENTO DE EQUIPOS E INSTALACIONES DE LA RED HACE LA ENTREGA ' + categoria + ', CON LAS ESPECIFICACIONES YA MENCIONADAS.', ""]);
*/
	return texto;
}


//console.log(traerDatosReportes(4));
function traerDatosReportes(id_reporte) {
	var form = [];
	var reporte = [];
	form.push({ name: "reporte_id", value: id_reporte });
	form.push({ name: "accion", value: 'TRAERDATOSREPORTES' });
	$.ajax({
		async: false,
		url: serverurl + "ajax/reportesAjax.php",
		method: "post",
		data: $.param(form),
		success: function (data) {
			data = JSON.parse(data);
			reporte = data;
			//console.log(data);
		},
		error: function (e) {
		}
	});

	return reporte;
}
function generarDatosPDFNotas(id_reporte) {
	var notas = traerNotas(id_reporte);
	var texto_articulo = []
	 if (notas.length==0){
		texto_articulo.push([0, 1, 40, 0, 'NO HAY NOTAS', ""]);

}
	else {
		
		
			for(var i=0;i<notas.length;i++) {

			texto_articulo.push([0, 1, 20, 0, '',notas[i].descripcion]);

			}
		}
	return texto_articulo;
}


function traerNotas(id_reporte) {
	var form = [];
	var notas = [];
	form.push({ name: "reporte_id", value: id_reporte });
	form.push({ name: "accion", value: 'TRAERNOTAS' });
	$.ajax({
		async: false,
		url: serverurl + "ajax/reportesAjax.php",
		method: "post",
		data: $.param(form),
		success: function (data) {
			data = JSON.parse(data);
			notas = data;
			//console.log(data);
		},
		error: function (e) {
		}
	});

	return notas;
}


function generarDatosPDFNovedades(id_reporte) {
	var colores = traerNovedades(id_reporte);
	var texto_articulo = [];
//var tipo=colores.tipo_afectacion;
		console.log(colores.length);
			//var datos=colores.tipo_afectacion+' DE '+colores.hora_inicio+' A '+colores.hora_final+' HRS, EN '+colores.lugar_afectacion+' DEJANDO DE APORTAR UN GASTO DE '+colores.gasto+' L.P.S '+colores.razon+' REPORTE DE '+colores.reporto+' CENTRO DE INFORMACIÓN '+colores.recibio_centro_informacion+' A LAS '+colores.hora_centro_informacion+' SAN JOAQUIN '+colores.recibio_san_joaquin+' A LAS '+colores.hora_san_joaquin;
			//console.log(datos);
			//if(empty(colores)){
				 if (colores.length==0){
					texto_articulo.push([0, 1, 40, 0, 'SIN NOVEDAD', ""]);
	
			}
			else{
			
			for(var i=0;i<colores.length;i++) {

			texto_articulo.push([0, 1, 20, 0, '',colores[i].tipo_afectacion+' DE '+colores[i].hora_inicio+' A '+colores[i].hora_final+' HRS, EN '+colores[i].lugar_afectacion+' DEJANDO DE APORTAR UN GASTO DE '+colores[i].gasto+' L.P.S '+colores[i].razon+' REPORTE DE '+colores[i].reporto+' CENTRO DE INFORMACIÓN '+colores[i].recibio_centro_informacion+' A LAS '+colores[i].hora_centro_informacion+' SAN JOAQUIN '+colores[i].recibio_san_joaquin+' A LAS '+colores[i].hora_san_joaquin]);
		//console.log(i);
			//(key == 0) ? color = value.tipo_afectacion : color = color.concat(', ', value.tipo_afcetacion);
			
		}
		console.log(texto_articulo);

	}
			//texto_articulo.push([0, 1, 20, 0, 'COLOR: ', color]);
	//	}
	return texto_articulo;
}

function traerNovedades(id_reporte) {
	var form = [];
	var novedades = [];
	form.push({ name: "reporte_id", value: id_reporte });
	form.push({ name: "accion", value: 'TRAERNOVEDADES' });
	$.ajax({
		async: false,
		url: serverurl + "ajax/reportesAjax.php",
		method: "post",
		data: $.param(form),
		success: function (data) {
			data = JSON.parse(data);
			novedades = data;
			console.log(data);
		},
		error: function (e) {
		}
	});

	return novedades;
}

/*
function traerNovedades(id_reporte) {

	var novedades = [];
	$.ajax({
		url: serverurl + "ajax/reportesAjax.php",
		method: "post",
		data: {
			"reporte_id": id_reporte,
			"accion": "TRAERNOVEDADES"
		},
		success: (res) => {
			
			novedades = res;

		console.log(novedades);

		},
	});

	return novedades;

}
*/

function obtenerTamanioLinea(tamanio) {
	return (tamanio * .353 * 1.2);
}

function FirmasPDF(responsable, puesto, area) {
	var tamanio = tamanios[0];
	doc.setFontType("bold").setFont("Helvetica").setFontSize(tamanio);
	doc.setLineWidth(0.3);
	espacio_vertical += 50;
	doc.line(30, espacio_vertical, 90, espacio_vertical);
	doc.line(126, espacio_vertical, 186, espacio_vertical);
	espacio_vertical += obtenerTamanioLinea(tamanio);

	doc.text(60, espacio_vertical, "ENTREGA", {
		align: 'center'
	});
	doc.text(156, espacio_vertical, "RECIBE", {
		align: 'center'
	});
	espacio_vertical += obtenerTamanioLinea(tamanio);
	//Personas
	var tamanio = tamanios[2];
	doc.setFontType("bold").setFont("Helvetica").setFontSize(tamanio);
	doc.text(60, espacio_vertical, "LIC. JULIO CÉSAR GUILLERMO SALVADOR", {
		align: 'center'
	});
	doc.text(156, espacio_vertical, responsable, {
		align: 'center'
	});
	espacio_vertical += obtenerTamanioLinea(tamanio);
	//CARGO
	var tamanio = tamanios[2];
	doc.setFontType("bold").setFont("Helvetica").setFontSize(tamanio);
	doc.text(60, espacio_vertical, "SUBDIRECTOR DE MANTENIMIENTO DE EQUIPOS E INSTALACIONES DE LA RED", {
		align: 'center'
	});

}

function generarPie(folio, fecha,gasto,transmitio) {
	//var imagen = 'data:image/jpeg;base64,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';

	var tamanio = 5.5;
	doc.setFont("helvetica");
	doc.setFontSize(tamanio);
	doc.setFontType('normal')
	doc.text(30, 255, 'CALLE ZARAGOZA #8');
	doc.text(30, 255 + (obtenerTamanioLinea(tamanio)), 'AMOMOLULCO, MPIO DE LERMA, 52005, ESTADO DE MÉXICO');
	//doc.text(30, 255 + (obtenerTamanioLinea(tamanio) * 2), 'TEL. 55 51 30 44 44, EXT. 1437 / 1452');

	doc.text(doc.internal.pageSize.width - 82, 255 , 'FECHA Y HORA DE GENERACIÓN');
	moment().locale('es');
	doc.text(doc.internal.pageSize.width - 82, 255 + (obtenerTamanioLinea(tamanio)), moment().format());
	
	// toDataURL(serverurl+'/vistas/assets/images/cbimage.jpg', function (base64_data) {


	// 	console.log(base64_data)
	// 	console.log( doc.internal.pageSize.width)
	// 	doc.addImage(base64_data, 'JPG', doc.internal.pageSize.width/2, 249, 46, 15);

	// })
	toDataURL('http://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Folio:' + folio.toUpperCase() + '%0AFecha:' + fecha.toUpperCase() + '%0ATransmitio:' + transmitio +'&choe=UTF-8', function (base64_data) {
	
	//toDataURL('http://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Folio:' + folio.toUpperCase() + '%0AFecha:' + fecha.toUpperCase() +'&choe=UTF-8', function (base64_data) {


		//console.log(base64_data)
		doc.addImage(base64_data, 'JPG', doc.internal.pageSize.width - 50, doc.internal.pageSize.height - interlineado, (150 / 10) * 1.8, (150 / 10) * 1.8);


	})





}


function toDataURL(url, callback) {
	var xhr = new XMLHttpRequest();
	xhr.onload = function () {
		var reader = new FileReader();
		reader.onloadend = function () {
			callback(reader.result);
		}
		reader.readAsDataURL(xhr.response);
	};
	xhr.open('GET', url);
	xhr.responseType = 'blob';
	xhr.send();
}