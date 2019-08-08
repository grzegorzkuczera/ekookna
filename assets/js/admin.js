const $ = require('jquery');
require( 'datatables.net-bs4/js/dataTables.bootstrap4.js');
global.$ = $;
$(function() {
    const busStationList = {
        container: '#bus_stations',
        table: '',
        init: function() {

          this.table = $(this.container).DataTable({
                responsive: true,
                "ajax": {
                    "url": '',
                    "type": 'POST'
                },
                    "columns": [
                        {
                            "className":'details-control text-center align-middle',
                            "orderable":false,
                            "data":null,
                            "defaultContent": '<i class="fas fa-plus-circle fa-lg text-success "></i>'
                        },
                        { "data": "address" },
                        { "data": "created_at" }, 
                        {"data": "read"},           
                        { sortable: false,
                         "render": function ( data, type, full, meta ) {
                                return `<ul class="list-inline">
                                <li class="list-inline-item"><a class="edit" href="/admin/edit/${full.id}"><i class="far fa-edit"></i></a>
                                </li><li class="list-inline-item"><a class="delete text-danger"  href="/admin/delete/${full.id}"><i class="far fa-trash-alt"></i></li>
                                </ul>`;        
                             } 
                        }
                    ],
                    "order": [[1, 'asc']]
                
            });
        }
    }
    busStationList.init(); 
    
});