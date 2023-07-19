// `enter code here`Call this function before datatable initililzation '
///////////////////Example///////////////////////////
$(function () {
$("input[data-bootstrap-switch]").each(function(){
     $(this).bootstrapSwitch('state', $(this).prop('checked'));
   });
///////////////////Before Below Datatable Initilization///////////////////////////
});