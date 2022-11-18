// Call the dataTables jQuery plugin
$(document).ready( function () {
    $(function() {
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('data')}}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nama_kendaraan', name: 'nama_kendaraan' },
            { data: 'merek', name: 'merek' },
            { data: 'tgl_beli', name: 'tgl_beli' },
            { data: 'keadaan_beli', name: 'keadaan_beli' }
            { data: 'umur_kendaraan', name: 'umur_kendaraan' }
        ]
    });
});
} );


