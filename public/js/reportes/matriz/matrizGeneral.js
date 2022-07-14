
$(document).ready(function () {
    var table = $('#Table__Matriz').DataTable({
     
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            title: 'Convenios',
            autoFilter: true,
            sheetName: 'Exported data'


        },
        {
            extend: 'pdfHtml5',
            title: 'Convenios',
            orientation: 'landscape',
            pageSize: 'LEGAL',
            customize: function (doc) {
                doc.styles.title = {
                    color: 'black',
                    fontSize: '20',

                    alignment: 'center',
                },
                    doc.content.splice(1, 0, {
                        columns: [{
                            margin: 12,
                            alignment: 'left',
                            image: 'data:image/png;base64,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',
                            width: 50,
                            height: 50
                        },

                        ]
                    });
            }


        }


        ],

        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
        }






    });


    //Creamos una fila en el head de la tabla y lo clonamos para cada columna
    $('#Table__Matriz thead tr').clone(true).appendTo('#Table__Matriz thead');

    $('#Table__Matriz thead tr:eq(1) th').each(function (i) {
        var title = $(this).text(); //es el nombre de la columna
        $(this).html('<input type="text" placeholder="Buscar...' + title + '" />');

        $('input', this).on('keyup change', function () {
            if (table.column(i).search() !== this.value) {
                table
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        });
    });
});

