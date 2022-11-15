const flashData = $(".flash-data").data("flashdata");
if (flashData) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "success",
        title: flashData,
    });
}

//tombol-hapus
// var form = document.getElementById('formHapus')

// form.addEventListener('submit', function(e){

//     e.preventDefault()

//             Swal.fire({
//                 title: "Are you sure?",
//                 text: "You won't be able to revert this!",
//                 icon: "warning",
//                 showCancelButton: true,
//                 confirmButtonColor: "#3085d6",
//                 cancelButtonColor: "#d33",
//                 confirmButtonText: "Yes, delete it!",
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     $(function () {
//                         document.getElementById("formHapus").submit();
//                     });
//                 }
//             });

// })

$(".tombol-hapus").on("click", function (e) {

        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You will delete this data & won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $(function () {
                    document.getElementById("formHapus").submit();
                });
            }
        });

});
