$('#default-datatable').DataTable( {
    "lengthMenu": [[10,15, 25, 50,75,100, -1], [10,15, 25, 50,75,100, "All"]],
    "paging": true,
    "deferRender": true,
    "responsive": true,
    "order": [],
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/English.json'
    },
    "pageLength": 10
   
} ); //data-switchery
