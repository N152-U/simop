var date = new Date();
var defs_picker = {
  autoClose: true,
  firstDay: 1,
  format: 'yyyy-mm-dd',
  disableDays: true,
  maxDate: date,
  showClearBtn: false,
  defaultDate: date,
  setDefaultDate: false,
  i18n: {
    cancel: 'Cancelar',
    clear: 'Limpiar',
    done: 'Ok',
    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
    weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
    weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
    weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
  },
  twelveHour: false, // twelve hours, use AM/PM
  autoclose: false,  //Close the timepicker automatically after select time
  onDraw() {

  }

}

$(document).ready(function () {
  $('.datepicker').datepicker(defs_picker);
});
