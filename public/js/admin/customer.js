$(document).ready(function(){
    customerTable();
    inactiveCustomerTable();
    checkCancelledReservation();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// FETCH ACTIVE APPLICANTS FOR TABLES
    function customerTable(){
    var table = $('#activeCustomer').DataTable({
        "language": {
            "emptyTable": "No Customer Found"
        },
        "lengthChange": true,
        "scrollCollapse": true,
        "paging": true,
        "info": true,
        "responsive": true,
        "ordering": false,
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
        "ajax":{
            "url":"/getActiveCustomer",
            "dataSrc": "",
        },
        "columns":[
            {"data":"user_id"},
            { "mData": function (data, type, row) {
                if(data.extention != null){
                    return data.firstname+ " " +data.lastname+ " " +data.extention;
                }else{
                    return data.firstname+ " " +data.lastname;
                }
            }},
            {"data":"email"},
            {"data":"phoneNumber"},
            {"data": "user_id",
                mRender: function (data, type, row) {
                return '<button type="button" data-title="View Customer?" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" onclick=viewCustomer('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-pencil-square"></i></button> <button type="button" onclick=deactivateCustomer('+data+') class="btn rounded-0 ROUNDED-0 btn-outline-danger btn-sm py-2 px-3" data-title="Deactivate Customer?"><i class="bi bi-trash3"></i></button>'
            }
            }
        ],
        order: [[1, 'asc']],
    });
    table.on('order.dt search.dt', function () {
        let i = 1;
        table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
    }

// INACTIVE APPLICANTS FOR TABLE
    function inactiveCustomerTable(){
        var table = $('#inactiveCustomer').DataTable({
            "language": {
                "emptyTable": "No Customer Found"
            },
            "lengthChange": true,
            "scrollCollapse": true,
            "paging": true,
            "info": true,
            "responsive": true,
            "ordering": false,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "ajax":{
                "url":"/getInActiveCustomer",
                "dataSrc": "",
            },
            "columns":[
                {"data":"user_id"},
                { "mData": function (data, type, row) {
                    if(data.extention != null){
                        return data.firstname+ " " +data.lastname+ " " +data.extention;
                    }else{
                        return data.firstname+ " " +data.lastname;
                    }
                }},
                {"data":"email"},
                {"data":"phoneNumber"},
                {"data": "user_id",
                    mRender: function (data, type, row) {
                    return '<button type="button" data-title="View Customer?" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" onclick=viewCustomer('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-pencil-square"></i></button> <button type="button" onclick=activateCustomer('+data+') class="btn rounded-0 ROUNDED-0 btn-outline-success btn-sm py-2 px-3" data-title="Activate Customer?"><i class="bi bi-check2-square"></i></button>'
                }
                }
            ],
            order: [[1, 'asc']],
        });
        table.on('order.dt search.dt', function () {
            let i = 1;
            table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    }

// FETCH DATA FOR UPDATE OPERATION
    function viewCustomer(id){
        $('#viewCustomerDetails').modal('show')
        $.ajax({
            url: '/viewCustomer',
            type: 'GET',
            dataType: 'json',
            data: {customerId: id},
        })
        .done(function(response) {
            $('#photo').attr("src",response.photos)
            $('#lastname').val(response.lastname)
            $('#firstname').val(response.firstname)
            $('#middlename').val(response.middlename)
            $('#extention').val(response.extention)
            $('#age').val(response.age)
            $('#birthdate').val(response.birthday)
            $('#phone').val(response.phoneNumber)
            $('#email').val(response.email)
        })
    }

// DEACTIVATE APPLICANTS ACCOUNT
    function deactivateCustomer(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to DEACTIVATE this customer?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, deactivate it'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/deactivateCustomer',
            type: 'GET',
            dataType: 'json',
            data: {customerId: id},
        });
        Swal.fire({
            title: 'Change Status',
            text: "Customer was DEACTIVATE successfully",
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
        }).then((result) => {
        if (result) {
            $('#activeCustomer').DataTable().ajax.reload();
        }
        });
        }
        });
    }

// ACTIVATE APPLICANTS ACCOUNT
    function activateCustomer(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to ACTIVATE this customer?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, activate it'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/activateCustomer',
            type: 'GET',
            dataType: 'json',
            data: {customerId: id},
        });
        Swal.fire({
            title: 'Change Status',
            text: "Customer was deactivate successfully",
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
        }).then((result) => {
        if (result) {
            $('#inactiveCustomer').DataTable().ajax.reload();
        }
        });
        }
        });
    }

// CHECK CANCELLED RESERVATION
    function checkCancelledReservation(){
        $.ajax({
            url: '/checkCancelledReservation',
            type: 'GET',
            dataType: 'json',
        })
        .done(function(response) {
            if(response === 1){
                Swal.fire({
                    position: "top-center",
                    icon: "warning",
                    title: "SOMEONE CANCELLED THEIR BOOKING",
                    footer: '<a href="/adminCancelledReservation">REDIRECT TO CANCELLED RESERVATION PAGE?</a>'
                });
            }
        })
    }
